Total Penjualan : <?= rp($total_penjualan) ?><br>
Total Keuntungan: <?= rp($keuntungan) ?>
<table border="1" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th style="border: 1px solid #000; padding: 8px;">Nama Barang</th>
            <th style="border: 1px solid #000; padding: 8px;">Gambar</th>
            <th style="border: 1px solid #000; padding: 8px;">Diskripsi</th>
            <th style="border: 1px solid #000; padding: 8px;">Jumlah</th>
            <th style="border: 1px solid #000; padding: 8px;">Harga Satuan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($barang as $key => $value) {
            $img = file_exists(FCPATH.'images/'.$value->images) ? $value->images : 'noimages.jpg';
            ?>
            <tr>
                <td style="border: 1px solid #000; padding: 8px;"><?= $value->nama_produk ?></td>
                <td style="border: 1px solid #000; padding: 8px;"><img src="<?= base_url().'images/'.$img ?>" width="70px" alt=""></td>
                <td style="border: 1px solid #000; padding: 8px;"><?= $value->diskripsi ?></td>
                <td style="border: 1px solid #000; padding: 8px;"><?= $value->jumlah ?></td>
                <td style="border: 1px solid #000; padding: 8px;"><?= rp($value->harga_jualpro) ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
