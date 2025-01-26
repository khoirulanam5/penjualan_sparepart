<?php defined("BASEPATH") or exit("No direct script access allowed");
class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
    }

    public function index()
    {
        $datas = $this->db->get_where('tb_kategori', array('nama_kategori' => 'sparepart'))->result();
        $data = array(
            "page" => "produk/kategori_v",
            "menu" => "Kategori Sparepart",
            "datas" => $datas
        );
        $this->load->view("index", $data);
    }

    public function update()
    {
        $this->db->where("id_kategori", $this->input->post("id_kategori"));

        $data = $this->input->post();
        array_shift($data);

        if ($this->db->update("tb_kategori", $data)) {
            $this->session->set_flashdata("message", "swal({title: 'Berhasil',text: 'Update data berhasil',icon:'success'});");
        } else {
            $this->session->set_flashdata("message", "swal({title: 'Gagal',text: 'Update data gagal',icon:'success'});");
        }
        redirect("produk/kategori");
    }

    public function simpan()
    {
        $data = $this->input->post();
        array_shift($data);
    
        if ($this->db->insert("tb_kategori", $data)) {
            $this->session->set_flashdata("message", "swal({title: 'Berhasil',text: 'Tambah data berhasil',icon:'success'});");
        } else {
            $this->session->set_flashdata("message", "swal({title: 'Gagal',text: 'Tambah data gagal',icon:'error'});");
        }
        redirect("produk/kategori");
    }
    

    public function delete($id) {
        // Menghapus data pelanggan berdasarkan id_pelanggan
        $this->db->where("id_kategori", $id);
        $delt = $this->db->delete("tb_kategori");
    
        // Memeriksa apakah query delete berhasil
        if ($delt) {
            echo "1"; // Berhasil
        } else {
            // Jika gagal, menampilkan pesan error dari database
            echo "Error: " . $this->db->error();
        }
    }
}
