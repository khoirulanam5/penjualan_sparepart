<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        h2, h3 {
            text-align: center;
        }
        .summary {
            font-weight: bold;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <h2>Laporan Penjualan Lengkap</h2>
    <p><strong>Tanggal:</strong> <?= date('d-m-Y') ?></p>
    
    <table>
        <thead>
            <tr>
                <th>No. Transaksi</th>
                <th>No. Polisi</th>
                <th>Nama Sparepart</th>
                <th>Harga/Pcs</th>
                <th>Jumlah Beli</th>
                <th>Total Harga</th>
                <th>Tanggal Jual</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $grand_total = 0;
            foreach ($penjualan as $item): 
                $grand_total += $item->total_harga;
                $nama_produk = explode(', ', $item->nama_produk);
                $harga_produk = explode(', ', $item->harga_produk);
                $jumlah_produk = explode(', ', $item->jumlah_produk);
                $max_length = max(count($nama_produk), count($harga_produk), count($jumlah_produk));
            ?>
            <tr>
                <td rowspan="<?= $max_length; ?>"><?= $item->no_transaksi ?></td>
                <td rowspan="<?= $max_length; ?>"><?= $item->no_plat ?></td>
                <td><?= $nama_produk[0] ?? '-' ?></td>
                <td><?= isset($harga_produk[0]) ? number_format($harga_produk[0], 0, ',', '.') : '-' ?></td>
                <td><?= $jumlah_produk[0] ?? '-' ?></td>
                <td rowspan="<?= $max_length; ?>"><?= number_format($item->total_harga, 0, ',', '.') ?></td>
                <td rowspan="<?= $max_length; ?>"><?= date('d-m-Y', strtotime($item->tanggal)) ?></td>
            </tr>
            <?php for ($i = 1; $i < $max_length; $i++): ?>
            <tr>
                <td><?= $nama_produk[$i] ?? '-' ?></td>
                <td><?= isset($harga_produk[$i]) ? number_format($harga_produk[$i], 0, ',', '.') : '-' ?></td>
                <td><?= $jumlah_produk[$i] ?? '-' ?></td>
            </tr>
            <?php endfor; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <div class="summary">
        <p>Total Keseluruhan: Rp. <?= number_format($grand_total, 0, ',', '.') ?></p>
    </div>
    
    <script>
        window.print();
    </script>

</body>
</html>
