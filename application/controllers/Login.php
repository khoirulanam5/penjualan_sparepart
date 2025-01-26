<?php defined("BASEPATH") OR exit("No direct script access allowed");

class Login extends CI_Controller {	
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data = array(
			"title" => "Halaman Login",
			"page" => "Login_v",
			"menu" => "Login"
		);
		$this->load->view("Login_v", $data);
	}

	public function cek() {
		$username = $this->input->post("username");
		$password = $this->input->post("password");

		// Menghapus penggunaan hashing pada password
		$cek = $this->db->get_where("tb_users", array("username" => $username, "password" => $password))->row();
		if (!empty($cek)) {
			$ses = array(
				"username" => $cek->username,
				"level" => $cek->level,
				"status" => $cek->status
			);
			$this->session->set_userdata($ses);

			if ($this->session->userdata('level') == "frontdesk") {
				$this->session->set_flashdata("message", "swal({title: 'BERHASIL',text: 'Login berhasil',icon:'success'});");
				redirect("user/pelanggan");
			} elseif ($this->session->userdata('level') == "kepala_bengkel") {
				$this->session->set_flashdata("message", "swal({title: 'BERHASIL',text: 'Login berhasil',icon:'success'});");
				redirect("user/pegawai");
			} elseif ($this->session->userdata('level') == "kasir") {
				$this->session->set_flashdata("message", "swal({title: 'BERHASIL',text: 'Login berhasil',icon:'success'});");
				redirect("transaksi/penjualan");
			} elseif ($this->session->userdata('level') == "counter") {
				$this->session->set_flashdata("message", "swal({title: 'BERHASIL',text: 'Login berhasil',icon:'success'});");
				redirect("produk/produk");
			} else {
				$this->session->set_flashdata("message", "swal({title: 'BERHASIL',text: 'Login berhasil',icon:'success'});");
				redirect("public/home");
			}
		} else {
			$this->session->set_flashdata("gagal", "Password / Email Salah!!!");
			redirect("login");
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect("public/home");
	}
}
