<?php defined("BASEPATH") OR exit("No direct script access allowed");

class Register extends CI_Controller {	
	public function __construct(){
		parent::__construct();
        $this->load->library('form_validation');
	}

	public function index(){
		$data = array(
			"title" => "Halaman Register",
			"page" => "Register_v",
			"menu" => "Register"
		);
		$this->load->view("register_v", $data);
	}   

        public function tambah() {
            $cek = $this->db->get_where("tb_users", array("username" => $this->input->post("username")))->row();
            $cek2 = $this->db->get_where("pelanggan", array("id_pelanggan" => $this->input->post("username")))->row();
            if (!empty($cek) || !empty($cek2)) {
                $this->session->set_flashdata("message", "swal({title: 'Gagal',text: 'Username sudah digunakan',icon:'error'});");
                redirect("register");
            }
            $data = array(
                "id_pelanggan" => $this->input->post("username"),
                "nama_pelanggan" => $this->input->post("nama_pelanggan"),
                "desa" => $this->input->post("desa"),
                "kodepos" => $this->input->post("kodepos"),
                "rt" => $this->input->post("rt"),
                "rw" => $this->input->post("rw"),
                "kabupaten" => $this->input->post("kabupaten"),
                "kecamatan" => $this->input->post("kecamatan"),
                "no_hp" => $this->input->post("no_hp"),
                "email" => $this->input->post("email"),
            );
            $this->db->insert("pelanggan", $data);
    
            $login = array(
                "username" => $this->input->post("username"),
                "password" => $this->input->post("password"),
                "level" => 'pelanggan',
                "status" => 1
            );
            $this->db->insert("tb_users", $login);
            $this->session->set_flashdata("message", "swal({title: 'Berhasil',text: 'Pendaftaran berhasil silahkan login',icon:'success'});");
            redirect("login");
        }
}