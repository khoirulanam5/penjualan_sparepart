<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_off extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->model('Penjualan_model');
    }

    public function index() {
        $data['penjualan_off'] = $this->Penjualan_model->penjualan_off_cetak();
        $data['page'] = "laporan/penjualan_off";
        $data['menu'] = "Penjualan";
    
        $this->load->view("index", $data);
    }

    public function cetak_laporan() {
        $this->load->model('Penjualan_model');
        $data['penjualan'] = $this->Penjualan_model->get_all_penjualan();
        $this->load->view('penjualan/cetak_laporan', $data);
    }
}
