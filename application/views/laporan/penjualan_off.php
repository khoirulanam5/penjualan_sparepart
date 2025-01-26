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
                        
                        <!-- Daftar Penjualan -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Penjualan</h3>
                            </div>
                            <div class="card-body">
                            <a href="<?= base_url('transaksi/penjualan_off/cetak_laporan'); ?>" class="btn btn-sm btn-primary" target="_blank">Cetak Laporan</a>
                            <hr>
                                <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">No Transaksi</th>
                                        <th style="width: 10%;">No Polisi</th>
                                        <th style="width: 25%;">Nama Sparepart</th>
                                        <th style="width: 15%;">Harga/Pcs</th>
                                        <th style="width: 15%;">Jumlah Beli</th>
                                        <th style="width: 10%;">Total Harga</th>
                                        <th style="width: 20%;">Tanggal Jual</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        <?php foreach ($penjualan_off as $p): ?>
                                        <tr>
                                            <td><?php echo $p->no_transaksi; ?></td>
                                            <td><?php echo $p->no_plat; ?></td>
                                            <td><?php echo $p->nama_produk; ?></td>
                                            <td><?php echo $p->harga_jualpro; ?></td>
                                            <td><?php echo $p->jumlah; ?></td>
                                            <td><?php echo $p->total_harga; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($p->tanggal)); ?></td> <!-- Ubah format tanggal -->
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
