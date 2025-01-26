<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_off extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->model('Penjualan_model');
        $this->load->library('pagination');
    }

    public function index() {
        // Konfigurasi pagination
        $config = array();
        $config['base_url'] = site_url('transaksi/penjualan_off/index');
        $config['total_rows'] = $this->Penjualan_model->get_count();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['attributes'] = array('class' => 'page-link');
    
        // Konfigurasi Bootstrap untuk pagination
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
    
        $this->pagination->initialize($config);
    
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    
        // Ambil data penjualan sesuai dengan pagination
        $data['penjualan'] = $this->Penjualan_model->get_penjualan($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
    
        $data['produk'] = $this->Produk_model->get_all_produk();
        $data['page'] = "penjualan/penjualan_off";
        $data['menu'] = "Penjualan";
    
        $this->load->view("index", $data);
    }    

    public function generateNoTransaksi() {
        $unik = "TR" . date('Ym'); // Membuat prefix dengan format TRYYYYMM
        $result = $this->db->query("SELECT MAX(no_transaksi) AS LAST_NO FROM penjualan_off WHERE no_transaksi LIKE '".$unik."%'")->row();

        if ($result && $result->LAST_NO) {
            $urutan = (int) substr($result->LAST_NO, 8, 5);
            $urutan++;
        } else {
            $urutan = 1;
        }

        $kode = $unik . sprintf("%05s", $urutan);
        return $kode;
    }

    public function create() {
        $this->form_validation->set_rules('no_plat', 'Nomer Plat', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("message", "swal({title:'Gagal', text:'Simpan data gagal', icon:'error'});");
            redirect('transaksi/penjualan_off');
        } else {
            $no_transaksi = $this->generateNoTransaksi();
            $no_plat = $this->input->post('no_plat');
            $produk_ids = $this->input->post('id_produk');
            $jumlahs = $this->input->post('jumlah');
    
            foreach ($produk_ids as $index => $id_produk) {
                $jumlah = $jumlahs[$index];
                $produk = $this->Produk_model->get_produk_by_id($id_produk);
                $total_harga = $produk->harga_jualpro * $jumlah;
    
                $data = array(
                    'no_transaksi' => $no_transaksi,
                    'no_plat' => $no_plat,
                    'id_produk' => $id_produk,
                    'harga_jualpro' => $produk->harga_jualpro,
                    'jumlah' => $jumlah,
                    'total_harga' => $total_harga,
                    'tanggal' => date('Y-m-d')
                );
                $insert = $this->db->insert('penjualan_off', $data);
                if ($insert) {
                    $this->Produk_model->update_stok($id_produk, $jumlah);
                }
            }
            $this->session->set_flashdata("message", "swal({title: 'Berhasil', text: 'Simpan data berhasil', icon: 'success'});");
            redirect('transaksi/penjualan_off');
        }
    }    

    public function cetak_nota($no_transaksi) {
        $this->load->model('Penjualan_model');
        $data['penjualan'] = $this->Penjualan_model->get_penjualan_by_no_transaksi($no_transaksi);
        $this->load->view('penjualan/cetak_nota', $data);
    }


    public function cetak_laporan() {
        $this->load->model('Penjualan_model');
        $data['penjualan'] = $this->Penjualan_model->get_all_penjualan();
        $this->load->view('penjualan/cetak_laporan', $data);
    }
}
