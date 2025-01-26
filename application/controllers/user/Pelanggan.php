<?php defined("BASEPATH") OR exit("No direct script access allowed");
	class Pelanggan extends CI_Controller {	
		public function __construct(){
			parent::__construct();
      cekLogin();
		}
		public function index(){
      $this->db->select( "*" );
        $this->db->from( "pelanggan" );
        $datas = $this->db->get()->result();

			$data = array(
			"page" => "user/pelanggan_v",
            "menu" => "Data Pelanggan",
			"datas" => $datas
		);
			$this->load->view("index",$data);
		}
    public function update() {
        $this->db->where("id_pelanggan",$this->input->post("id_pelanggan"));
        $data  = array(
            // id_pelanggan
            "nama_pelanggan"=>$this->input->post('nama_pelanggan'),
            "desa"=>$this->input->post('desa'),
            "kodepos"=>$this->input->post('kodepos'),
            "rt"=>$this->input->post('rt'),
            "rw"=>$this->input->post('rw'),
            "kabupaten"=>$this->input->post('kabupaten'),
            "kecamatan"=>$this->input->post('kecamatan'),
            "no_hp"=>$this->input->post('no_hp'),
            "email"=>$this->input->post('email')
        );
        $this->db->update("pelanggan",$data);
        $this->session->set_flashdata("message", "swal({title: 'Berhasil',text: 'Update data berhasil',icon:'success'});");
        redirect("user/pelanggan/");
    }   

    public function simpan() {
        $data  = array(
            "id_pelanggan"=>$this->input->post('id_pelanggan'),
            "nama_pelanggan"=>$this->input->post('nama_pelanggan'),
            "desa"=>$this->input->post('desa'),
            "kodepos"=>$this->input->post('kodepos'),
            "rt"=>$this->input->post('rt'),
            "rw"=>$this->input->post('rw'),
            "kabupaten"=>$this->input->post('kabupaten'),
            "kecamatan"=>$this->input->post('kecamatan'),
            "no_hp"=>$this->input->post('no_hp'),
            "email"=>$this->input->post('email')
        );
        $ins = $this->db->insert( "pelanggan", $data );
        $this->session->set_flashdata("message", "swal({title: 'Berhasil',text: 'Tambah data berhasil',icon:'success'});");
        redirect("user/pelanggan/");
    }

    public function delete($id) {
        // Menghapus data pelanggan berdasarkan id_pelanggan
        $this->db->where("id_pelanggan", $id);
        $delt = $this->db->delete("pelanggan");
    
        // Memeriksa apakah query delete berhasil
        if ($delt) {
            echo "1"; // Berhasil
        } else {
            // Jika gagal, menampilkan pesan error dari database
            echo "Error: " . $this->db->error();
        }
    }    
}
