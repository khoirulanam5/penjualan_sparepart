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

    // public function simpan() {
    //     // Validasi input pelanggan
    //     $this->form_validation->set_rules('nama_pelanggan', 'Nama', 'required');
    //     $this->form_validation->set_rules('desa', 'Desa', 'required');
    //     $this->form_validation->set_rules('kodepos', 'Kode Pos', 'required');
    //     $this->form_validation->set_rules('rt', 'RT', 'required');
    //     $this->form_validation->set_rules('rw', 'RW', 'required');
    //     $this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required');
    //     $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
    //     $this->form_validation->set_rules('no_hp', 'No Hp', 'required');
    //     $this->form_validation->set_rules('email', 'Email', 'required');
        
    //     // Validasi input pengguna
    //     $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_users.username]');
    //     $this->form_validation->set_rules('password', 'Password', 'required');
    
    //     if ($this->form_validation->run() == false) {
    //         $this->session->set_flashdata("message", "swal({title: 'Gagal',text: 'Gagal menyimpan data',icon:'error'});");
    //         redirect("register");
    //     } else {
    //         // Data pelanggan
    //         $data_pelanggan = array(
    //             "id_pelanggan" => $this->input->post('id_pelanggan'),
    //             "nama_pelanggan" => $this->input->post('nama_pelanggan'),
    //             "desa" => $this->input->post('desa'),
    //             "kodepos" => $this->input->post('kodepos'),
    //             "rt" => $this->input->post('rt'),
    //             "rw" => $this->input->post('rw'),
    //             "kabupaten" => $this->input->post('kabupaten'),
    //             "kecamatan" => $this->input->post('kecamatan'),
    //             "no_hp" => $this->input->post('no_hp'),
    //             "email" => $this->input->post('email')
    //         );
    
    //         // Data pengguna
    //         $data_pengguna = array(
    //             "username" => $this->input->post('username'),
    //             "password" => $this->input->post('password'),
    //             "level" => "pelanggan",
    //             "status" => 1
    //         );
    
    //         // Mulai transaksi
    //         $this->db->trans_start();
    
    //         // Insert ke tb_users
    //         $this->db->insert("tb_users", $data_pengguna);
    
    //         // Insert ke pelanggan
    //         $this->db->insert("pelanggan", $data_pelanggan);
    
    //         // Selesaikan transaksi
    //         $this->db->trans_complete();
    
    //         if ($this->db->trans_status() === false) {
    //             // Jika gagal
    //             $this->session->set_flashdata("message", "swal({title: 'Gagal',text: 'Gagal menyimpan data',icon:'error'});");
    //             redirect("register");
    //         } else {
    //             // Jika sukses
    //             $this->session->set_flashdata("message", "swal({title: 'Berhasil',text: 'Registrasi Berhasil, Silahkan Login!!',icon:'success'});");
    //             redirect("login");
    //         }
    //     }
    // }    

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