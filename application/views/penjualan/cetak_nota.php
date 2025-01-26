<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cetak Nota</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
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
    </style>
</head>
<body>

    <h2>Nota Penjualan</h2>
    <h3>No. Transaksi: <?= $penjualan[0]->no_transaksi ?></h3>
    
    <p><strong>No. Polisi:</strong> <?= $penjualan[0]->no_plat ?></p>
    <p><strong>Tanggal Jual:</strong> <?= date('d-m-Y', strtotime($penjualan[0]->tanggal)) ?></p>
    
    <table>
        <thead>
            <tr>
                <th>Nama Sparepart</th>
                <th>Harga/Pcs</th>
                <th>Jumlah Beli</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($penjualan as $item): ?>
            <tr>
                <td><?= $item->nama_produk ?></td>
                <td><?= number_format($item->harga_jualpro, 0, ',', '.') ?></td>
                <td><?= $item->jumlah ?></td>
                <td><?= number_format($item->total_harga, 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <h3>Total Pembayaran: Rp. <?= number_format(array_sum(array_column($penjualan, 'total_harga')), 0, ',', '.') ?></h3>
    
    <script>
        window.print();
    </script>

</body>
</html>
