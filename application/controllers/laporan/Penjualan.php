<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Penjualan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        cekLogin();
        $this->load->model("M_join","joins");
    }

    public function index() {
        $this->joins->detailjualpenjualan();
        $this->db->where("status_bayar >",'0');
        $this->db->order_by('b.no_transaksi','desc');
        $tb = $this->db->get()->result();
        $data = array(
            'page' => 'laporan/penjualan_v',
            'menu' => 'Laporan Penjualan Online',
            'datas' => (isset($tb) ? $tb:"")
        );
        $this->load->view( 'index', $data );
    }
    public function periode()
    {
        $awal    = $this->input->get('tanggal1');
        $ahir    = $this->input->get('tanggal2');
        $periode = $this->input->get('periode');
        
        $this->joins->detailjualpenjualan();
        $this->db->where("status_bayar >",'0');
        $this->db->where('status_kirim', 2);
        if($periode == 'harian'){
            $this->db->where('tgl_jual>=', $awal);
            $this->db->where('tgl_jual <=', $ahir);
        }elseif($periode == 'bulanan'){
            if (substr($awal,0,4) != substr($ahir,0,4) ) {
                echo "Report Bulanan Hanya untuk Tahun yang sama. Silahkan Ulangi";
                exit;
            }
            $this->db->where("month(tgl_jual) BETWEEN month('$awal') and month('$ahir')");
        }elseif($periode == 'tahunan'){
            $this->db->where("year(tgl_jual) BETWEEN year('$awal') and year('$ahir')");
        }
        $this->db->order_by('b.no_transaksi','desc');
        $items = $this->db->get()->result();
        $datas["items"] = $items;

        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Laporan Berdasar Periode.pdf";
        $this->pdf->previewpdf("laporan/periode_v",$datas);
    }
    public function total()
    {
       $total = $this->db->get_where('detail_jual',array('status_bayar'=>1))->result();
       $tt = 0;
       $selisih = 0;
       foreach ($total as $key => $value) {
        $transaksi = json_decode($value->data_produk);
        $tt +=  $transaksi->total_bayar;
        foreach ($transaksi->keranjang as $key => $value2) {
            $selisih += ($value2->jumlah * ($value2->harga_jualpro - $value2->harga_belipro));
            $barang[$value2->id_detail_produk] =$value2 ;
        }
       }
       $data['barang'] = $barang;
       $data['keuntungan'] = $selisih;
       $data['total_penjualan'] = $tt;
       
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Laporan Rekap.pdf";
        $this->pdf->previewpdf("laporan/rekap_lap",$data);
    }
}
