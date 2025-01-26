<center><h3>Laporan <?= ucwords($this->input->get('periode')) ?></h3></center>
<div class="row col-md-12">
    <center>
        <table style='text-align:center; border-collapse: collapse; width: 100%;'>
            <thead>
                <tr style="background:#e1e6ec">
                    <th style="border: 1px solid #000; padding: 8px;">No Transaksi</th>
                    <th style="border: 1px solid #000; padding: 8px;">Status Bayar</th>
                    <th style="border: 1px solid #000; padding: 8px;">Tgl Jual</th>
                    <th style="border: 1px solid #000; padding: 8px;">Id Pegawai</th>
                    <th style="border: 1px solid #000; padding: 8px;">Id Pengiriman</th>
                    <th style="border: 1px solid #000; padding: 8px;">Status Kirim</th>
                    <th style="border: 1px solid #000; padding: 8px;">Nama Penerima</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $key => $value) { ?>
                    <tr>
                        <td style="border: 1px solid #000; padding: 8px;"><?= $value->no_transaksi ?></td>
                        <td style="border: 1px solid #000; padding: 8px;"><?= ($value->status_bayar == 1) ? "Lunas" : "Belum Bayar" ?></td>
                        <td style="border: 1px solid #000; padding: 8px;"><?= $value->tgl_jual ?></td>
                        <td style="border: 1px solid #000; padding: 8px;"><?= $value->id_pegawai ?></td>
                        <td style="border: 1px solid #000; padding: 8px;"><?= $value->id_pengiriman ?></td>
                        <td style="border: 1px solid #000; padding: 8px;"><?= ($value->status_kirim == 2) ? 'Sudah Diterima Pembeli' : 'Belum Diterima' ?></td>
                        <td style="border: 1px solid #000; padding: 8px;"><?= $value->nama_penerima ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </center>
</div>
