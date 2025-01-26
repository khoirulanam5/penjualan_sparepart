<?php defined("BASEPATH") OR exit("No direct script access allowed");
class Ongkir_toko extends CI_Controller {	
  public function __construct(){
     parent::__construct();
     cekLogin();
 }
 public function index(){
  $this->db->select( "*" );
  $this->db->from( "ongkos_kirim" );
  $datas = $this->db->get()->result();

  $data = array(
    "page" => "produk/ongkos_v",
    "menu" => "Ongkos Kirim",
     "datas" => $datas
 );
  $this->load->view("index",$data);
}
public function update() {
    $this->db->where("id_ongkos",$this->input->post("id_ongkos"));
    $data = $this->input->post();
    array_shift($data);
    unset($data['tables_length']);
    $this->db->update("ongkos_kirim",$data);
    $this->session->set_flashdata("message", "swal({title: 'Berhasil',text: 'Update data berhasil',icon:'success'});");
    redirect("transaksi/ongkir_toko/");
}   

public function simpan() {
    $data = $this->input->post();
    unset($data['tables_length']);
    $ins = $this->db->insert( "ongkos_kirim", $data );
    $this->session->set_flashdata("message", "swal({title: 'Berhasil',text: 'Tambah data berhasil',icon:'success'});");
    redirect("transaksi/ongkir_toko/");
}

public function delete() {
    $data = json_decode( $this->input->post( "row" ) );
    $this->db->where("id_ongkos",$data[0]);
    $delt = $this->db->delete("ongkos_kirim");
    echo ( $delt > 0 ) ? "1" : "0";

}
}
