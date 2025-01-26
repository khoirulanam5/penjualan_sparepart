<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Penjualan</title>
    <script src="<?= base_url() ?>src/js/hm_sweetalert.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- AdminLTE CSS (Pastikan URL ini benar) -->
    <link rel="stylesheet" href="path/to/adminlte.min.css">
</head>
<body>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Penjualan</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Form Penjualan -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Formulir Pembelian</h3>
                            </div>
                            <div class="card-body">
                                <?php if ($this->session->flashdata('message')): ?>
                                    <script>
                                        <?= $this->session->flashdata('message'); ?>
                                    </script>
                                    <?php $this->session->unset_userdata('message'); ?>
                                <?php endif; ?>
                                <?php echo validation_errors(); ?>
                                <form method="post" action="<?= base_url('transaksi/penjualan_off/create'); ?>">
                                    <div class="form-group">
                                        <label for="no_plat">No Polisi</label>
                                        <input type="text" name="no_plat" id="no_plat" class="form-control" placeholder="Masukan Nomer Polisi" required>
                                    </div>

                                    <div id="product-container">
                                        <div class="form-group product-row">
                                            <label for="id_produk">Nama Sparepart</label>
                                            <select name="id_produk[]" class="form-control product-select" required>
                                                <option value="" data-harga="0">--- Pilih Sparepart ---</option>
                                                <?php foreach ($produk as $p): ?>
                                                    <option value="<?php echo $p->id_produk; ?>" data-harga="<?php echo $p->harga_jualpro; ?>"><?php echo $p->nama_produk; ?></option>
                                                <?php endforeach; ?>
                                            </select>

                                            <label for="harga_jualpro">Harga/Pcs</label>
                                            <input type="text" name="harga_jualpro[]" class="form-control harga-input" readonly>

                                            <label for="jumlah">Jumlah</label>
                                            <input type="text" name="jumlah[]" class="form-control jumlah-input" required>

                                            <label for="total_harga">Total Harga</label>
                                            <input type="text" name="total_harga[]" class="form-control total-harga-input" readonly>
                                            <br>
                                            <button type="button" class="btn btn-sm btn-secondary remove-row">Hapus</button>
                                        </div>
                                    </div>
                                    
                                    <button type="button" id="add-row" class="btn btn-sm btn-primary">Tambah Produk</button>
                                    <input class="btn btn-sm btn-success" type="submit" value="Beli">
                                </form>

                            </div>
                        </div>
                        
                        <!-- Daftar Penjualan -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Penjualan</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" id="tables">
                                <thead>
                                    <tr>
                                        <th style="width: 7%;">No.</th>
                                        <th style="width: 10%;">No Transaksi</th>
                                        <th style="width: 10%;">No Polisi</th>
                                        <th style="width: 20%;">Nama Sparepart</th>
                                        <th style="width: 15%;">Harga/Pcs</th>
                                        <th style="width: 10%;">Jumlah Beli</th>
                                        <th style="width: 10%;">Total Harga</th>
                                        <th style="width: 20%;">Tanggal Jual</th>
                                        <th style="width: 13%;">Nota</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        <?php 
                                        $no = 1;
                                        foreach ($penjualan as $p): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?php echo $p->no_transaksi; ?></td>
                                            <td><?php echo $p->no_plat; ?></td>
                                            <td><?php echo $p->nama_produk; ?></td>
                                            <td><?php echo $p->harga_jualpro; ?></td>
                                            <td><?php echo $p->jumlah; ?></td>
                                            <td><?php echo $p->total_harga; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($p->tanggal)); ?></td> <!-- Ubah format tanggal -->
                                            <td><a href="<?= base_url('transaksi/penjualan_off/cetak_nota/'.$p->no_transaksi); ?>" class="btn btn-sm btn-info" target="_blank">Nota</a></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <br>
                                <div class="pagination-links">
                                    <?= $pagination; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- jQuery -->
    <script src="<?= base_url() ?>src/js/jquery.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- AdminLTE JS (Pastikan URL ini benar) -->
    <script src="path/to/adminlte.min.js"></script>
    <!-- Inisialisasi DataTables -->
    <script>
        $(document).ready(function() {
        // Fungsi untuk menghitung total harga
        function calculateTotalPrice(row) {
            var harga = parseFloat(row.find('.harga-input').val()) || 0;
            var jumlah = parseFloat(row.find('.jumlah-input').val()) || 0;
            var totalHarga = harga * jumlah;
            row.find('.total-harga-input').val(totalHarga);

            // console.log('Harga:', harga);
            // console.log('Jumlah:', jumlah);
            // console.log('Total Harga:', totalHarga);
        }

        // Update harga ketika produk dipilih
        $(document).on('change', '.product-select', function() {
            var row = $(this).closest('.product-row');
            var harga = $(this).find(':selected').data('harga');
            row.find('.harga-input').val(harga);
            calculateTotalPrice(row);
        });

        // Update total harga ketika jumlah diubah
        $(document).on('input', '.jumlah-input', function() {
            var row = $(this).closest('.product-row');
            var jumlahValue = $(this).val();
            calculateTotalPrice(row);
        });

        // Tambah baris produk baru
        $('#add-row').click(function() {
            var newRow = $('.product-row:first').clone();
            newRow.find('input').val('');
            $('#product-container').append(newRow);
        });

        // Hapus baris produk
        $(document).on('click', '.remove-row', function() {
            if ($('.product-row').length > 1) {
                $(this).closest('.product-row').remove();
            }
        });

        // Inisialisasi DataTables jika ada tabel
        if ($('#tables').length) {
            $('#tables').DataTable();
        }
    });
    </script>
</body>
</html>
