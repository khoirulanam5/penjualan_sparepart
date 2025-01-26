<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FPGrowth_model extends CI_Model {
    
    private $min_support;
    private $transactions = [];
    private $frequent_itemsets = [];
    private $item_counts = [];
    private $transaction_ids = [];

    public function __construct() {
        parent::__construct();
    }

    public function setMinSupport($min_support) {
        $this->min_support = $min_support;
    }

    public function loadTransactions() {
    $this->transactions = [];
    $this->transaction_ids = [];

    $this->db->select('no_transaksi, GROUP_CONCAT(produk.nama_produk) as items');
    $this->db->from('penjualan_off');
    $this->db->join('produk', 'penjualan_off.id_produk = produk.id_produk');
    $this->db->group_by('no_transaksi');
    $query = $this->db->get();
    $results = $query->result();

    foreach ($results as $row) {
        $this->transaction_ids[] = $row->no_transaksi;
        $this->transactions[] = explode(',', $row->items);
    }
}


    private function generateFrequentItemsets() {
        $this->frequent_itemsets = [];
        $this->item_counts = [];

        foreach ($this->transactions as $transaction) {
            foreach (array_unique($transaction) as $item) {
                if (isset($this->item_counts[$item])) {
                    $this->item_counts[$item]++;
                } else {
                    $this->item_counts[$item] = 1;
                }
            }
        }

        foreach ($this->item_counts as $item => $count) {
            if ($count >= $this->min_support) {
                $this->frequent_itemsets[$item] = $count;
            }
        }
    }

    public function getFrequentItemsets() {
        $this->generateFrequentItemsets();
        return $this->frequent_itemsets;
    }

    public function generateAssociationRules($min_support, $confidence) {
        $rules = [];
        foreach ($this->frequent_itemsets as $item => $support_count) {
            foreach ($this->transactions as $transaction) {
                if (in_array($item, $transaction)) {
                    // Hitung support X∩Y
                    $support_x_and_y = $support_count / count($this->transactions);

                    // Hitung support X
                    $support_x = $this->item_counts[$item] / count($this->transactions);

                    // Hitung confidence
                    $rule_confidence = count($this->frequent_itemsets) / count($this->transactions);

                    // Jika confidence memenuhi syarat, tambahkan aturan
                    if ($rule_confidence <= $confidence) {
                        $rules[$item] = [
                            'rule' => $item,
                            'support' => $support_x_and_y,
                            'confidence' => $rule_confidence
                        ];
                    }
                }
            }
        }
        return $rules;
    }

    public function calculateBenchmarkLiftRatio($rules) {
        $benchmark_lift_ratios = [];
        foreach ($rules as $rule) {
            $benchmark = $this->item_counts[$rule['rule']] / count($this->transactions); // Benchmark (Support of consequent)
            $lift_ratio = $rule['confidence'] / $benchmark; // Lift ratio

            $benchmark_lift_ratios[$rule['rule']] = [
                'rule' => $rule['rule'],
                'count' => $this->item_counts[$rule['rule']],
                'support' => $rule['support'],
                'confidence' => $rule['confidence'],
                'frequensi_item_consequent' => $this->item_counts[$rule['rule']],
                'benchmark' => $rule['confidence'] / count($this->transactions),
                'lift_ratio' => $lift_ratio
            ];
        }
        return $benchmark_lift_ratios;
    }

    public function calculateSpecificationWithTransactions($rules, $benchmark_lift_ratios) {
        $specifications = [];

        foreach ($benchmark_lift_ratios as $rule_name => $benchmark) {
            $rule = $rules[$rule_name];
            $relevant_transactions = [];

            // Iterasi dan filter transaksi yang relevan
            foreach ($this->transactions as $index => $transaction) {
                // Hanya ambil transaksi yang relevan
                if (in_array($rule_name, $transaction)) {
                    $transaction_items = implode(', ', $transaction);
                    $transaction_id = $this->transaction_ids[$index];
                    $relevant_transactions[] = [
                        'id' => $transaction_id,
                        'items' => $transaction_items
                    ];

                    // Hapus item yang relevan dari transaksi
                    $key = array_search($rule_name, $transaction);
                    if ($key !== false) {
                        unset($transaction[$key]);
                    }

                    // Update transaksi di $this->transactions setelah item dihapus
                    $this->transactions[$index] = $transaction;
                }
            }

            // Jika tidak ada transaksi yang relevan, skip
            if (empty($relevant_transactions)) {
                continue;
            }

            // Penjelasan cara menghitung
            $support_count = isset($this->item_counts[$rule_name]) ? $this->item_counts[$rule_name] : 0;
            $total_transactions = count($this->transactions);
            $support_x_and_y = $rule['support'];
            $support_x = $support_count / $total_transactions;
            $confidence = $support_x_and_y / $support_count;
            $benchmark_value = $benchmark['benchmark'];
            $lift_ratio = $benchmark['lift_ratio'];

            // Format spesifikasi
            $specification = "Daftar transaksi:\n";
            foreach ($relevant_transactions as $transaction) {
                $specification .= "No Transaksi '{$transaction['id']}' Barang yang di beli: {$transaction['items']}\n";
            }
            $specification .= "\nCara Menghitung:\n";
            $specification .= "- Support (X∩Y) = {$support_count} / {$total_transactions} = {$support_x_and_y} (keterangan: hasil dari minimal support dibagi total transaksi)\n";
            $specification .= "- Confidence = {$support_x_and_y} / {$support_count} = {$confidence} (keterangan: hasil dari support dibagi minimal support)\n";
            $specification .= "- Benchmark = {$benchmark_value} (keterangan: hasil dari confidence dibagi total transaksi)\n";
            $specification .= "- Lift Ratio = {$confidence} / {$benchmark_value} = {$lift_ratio} (keterangan: hasil dari confidence dibagi benchmark)";

            $specifications[] = [
                'rule' => $benchmark['rule'],
                'specification' => $specification,
                'lift_ratio' => $benchmark['lift_ratio']
            ];
        }
        return $specifications;
    }

    public function getItemNames() {
        return array_keys($this->item_counts);
    }

    public function getItemCount() {
        return array_values($this->item_counts);
    }
}
