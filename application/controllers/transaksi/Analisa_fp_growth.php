<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Analisa_fp_growth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('FPGrowth_model');
    }

    public function index()
    {
        if ($this->input->post()) {
            // Ambil nilai min_support dan confidence dari input pengguna
            $min_support = $this->input->post('min_support');
            $confidence = $this->input->post('confidence');

            // Set nilai minimum support
            $this->FPGrowth_model->setMinSupport($min_support);

            // Muat transaksi dari database
            $this->FPGrowth_model->loadTransactions();

            // Dapatkan itemsets yang sering muncul
            $frequent_itemsets = $this->FPGrowth_model->getFrequentItemsets();

            // Urutkan itemsets berdasarkan jumlah dukungan (support) dalam urutan menurun
            arsort($frequent_itemsets);

            // Hasilkan aturan asosiasi berdasarkan min_support dan confidence
            $rules = $this->FPGrowth_model->generateAssociationRules($min_support, $confidence);

            // Hitung rasio benchmark dan lift
            $benchmark_lift_ratio = $this->FPGrowth_model->calculateBenchmarkLiftRatio($rules);

            // Hitung spesifikasi yang mencakup transaksi terkait dan lift ratio
            $specifications = $this->FPGrowth_model->calculateSpecificationWithTransactions($rules, $benchmark_lift_ratio);

            // Siapkan data untuk dikirim ke view
            $data = [
                'frequent_itemsets' => $frequent_itemsets,
                'min_support' => $min_support,
                'confidence' => $confidence,
                'rules' => $rules,
                'benchmark_lift_ratio' => $benchmark_lift_ratio,
                'specifications' => $specifications, // Data spesifikasi dan lift ratio
                'page' => 'penjualan/analisa_fp_growth',
                'menu' => 'Analisa FP-Growth'
            ];
        } else {
            // Data kosong untuk tampilan awal
            $data = [
                'frequent_itemsets' => [],
                'min_support' => null,
                'confidence' => null,
                'rules' => [],
                'benchmark_lift_ratio' => [],
                'specifications' => [], // Data spesifikasi kosong
                'page' => 'penjualan/analisa_fp_growth',
                'menu' => 'Analisa FP-Growth'
            ];
        }

        // Muat tampilan dengan data yang sesuai
        $this->load->view('index', $data);
    }
}
