<style>
    .form-check-input {
        background-color: #bbbec7 !important;
    }
</style>
<script src="<?= base_url('src/js/') ?>hm_sweetalert.min.js"></script>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="nav-item">
                        <a href="#iprofile" class="nav-link active" aria-controls="home" role="tab" data-bs-toggle="tab"
                            aria-expanded="true">
                            <span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Scan Me</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="iprofile">
                        <?php if ($this->session->flashdata('message')): ?>
                            <script>
                                <?= $this->session->flashdata('message'); ?>
                            </script>
                            <?php $this->session->unset_userdata('message'); ?>
                        <?php endif; ?>
                        <div class="row">
                        <div class="col-md-3">
                            <div style="width:300px;height:300px;background:#ddd;text-align:center">
                                <small>Scan Qr code untuk melakukan pembayaran</small>
                                <img src="<?= base_url('images/') ?>qr_dana.jpg" class="mx-auto" width="100%" alt="">
                                <b style="background-color: black; color: white; display: block; padding: 5px;">
                                    BRI 0611-0103-1630-502<br>A.N AWWAL ZAHDANUAJI
                                </b>
                                <b style="background-color: black; color: white; display: block; padding: 5px;">
                                    DANA 0812-2767-2525<br>A.N AWWAL ZAHDANUAJI
                                </b>
                            </div>
                        </div>
                            <div class="col-md-4 ms-auto">
                                <h4 class="card-title mt-4 text-center">Info Pengiriman</h4>
                                <div class="input-group mb-3"></div>
                                <div id="select_op"></div>
                                <div id="alamat">
                                    <table width="100%" style="margin-left:20px;margin-top:20px">
                                        <!-- Info Pengiriman -->
                                        <tr>
                                            <td width="130px">Foto Profil</td>
                                            <td>:</td>
                                            <td>
                                                <img width="70px" src="<?= base_url('images/') . (!empty($almt->images) ? $almt->images : "portrait-solid.svg"); ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nama Pemesan</td>
                                            <td>:</td>
                                            <td><?= $almt->nama_pelanggan ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td><?= $almt->desa . " RT-" . $almt->rt . "/RW-" . $almt->rw . ' Kec.' . $almt->kecamatan ?></td>
                                        </tr>
                                        <tr>
                                            <td>Hp</td>
                                            <td>:</td>
                                            <td><?= $almt->no_hp ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td><?= $almt->email ?></td>
                                        </tr>
                                    </table>

                                    <!-- Ongkos Kirim -->
                                    <table class="text-center" style="margin-top:20px;">
                                        <tr>
                                            <td colspan="3">
                                                <div class="row mx-auto col-md-12">
                                                    <div class="col-md-2">
                                                        <i class="fas fa-people-carry text-warning" style="font-size:xxx-large"></i>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kota Tujuan:</td>
                                            <td>:</td>
                                            <td><?= $ongkir->lokasi_tujuan ?></td>
                                        </tr>
                                        <tr>
                                            <td>Ongkos Kirim:</td>
                                            <td>:</td>
                                            <td><?= rp($ongkir->biaya) ?></td>
                                        </tr>
                                        <!-- <tr>
                                            <td>Harga:</td>
                                            <td>:</td>
                                            <td><?= rp($ongkir->biaya) ?></td>
                                        </tr> -->
                                        <tr>
                                            <td>Total Harga:</td>
                                            <td>:</td>
                                            <td><?= rp($total_bayar) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-5 mx-auto" style="margin-top:20px">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab" onclick="kurirtoko()">
                                            <span>Upload Pembayaran</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home" role="tabpanel">
                                        <div class="p-3">
                                            <?php echo form_open_multipart('public/home/pengriman'); ?>
                                            <div class="input-group mb-3" style="width:300px">
                                                <input type="hidden" value="<?= base64_encode($detail_jual) ?>" name="datas">
                                                <input type="file" class="form-control btn-sm" required="required" name="userfile" accept=".jpg">
                                                <input class="btn btn-dark btn-sm" type="submit" value="Bayar">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <h5 class="card-title">Rincian Pesanan</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Images</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga /pcs</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            echo $this->session->flashdata("pesan");
                            if (empty($keranjang)) {
                                redirect("public/home");
                            }

                            if (!empty($keranjang[0]->id_produk)) {
                                foreach ($keranjang as $key => $val) {
                                    $imgcek = file_exists(FCPATH . 'images/' . $val->images) ? $val->images : 'noimages.jpg';
                                    echo '<tr>
                                        <td><img src="' . base_url("images/") . $imgcek . '" alt="Product Image" width="80"></td>
                                        <td>' . $val->nama_produk . '</td>
                                        <td>' . $val->jumlah . '</td>
                                        <td>' . rp($val->harga_jualpro) . '</td>
                                        <td class="font-500">' . rp($val->jumlah * $val->harga_jualpro) . '</td>
                                    </tr>';
                                }
                            }
                            ?>
                            <tr class="">
                                <td colspan="4" class="font-500" align="right">
                                    <div class="btn-sm">(* Total Harga + Ongkir)</div> Total Pembayaran
                                </td>
                                <td class="font-500">
                                    <span>
                                        <div><?= rp($total_bayar) ?></div>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function kota(id) {
        $.ajax({
            url: "<?= base_url('public/home/ongkir/')?>"+id,
            type: "GET",
            data: { data: id },
            success: function (a) {
                var isi = JSON.parse(a);
                console.log(isi);
                $("#select_op").html("<div><center><h3>Ongkir ke " + isi[0].lokasi_tujuan + " : " + formatRupiah(isi[0].biaya) + "</h3></center></div>");
            }
        });

    }
    function formatRupiah(angka, prefix) {
        var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
    function kurirlain() {
        $('.onkir_toko').hide();
    }
    function kurirtoko() {
        $('.onkir_toko').show();
        $(".onkir_lain").html('');
        $(".total_bayar_lain").html('');

    }
    function cek_ongkir(id) {
        $(".apiraja").remove();
        let kode = id.value;
        let tujuan = $("#id_city").val().toString();
        let berat = $("#berat").val();

        $.ajax({
            url: "<?= base_url() ?>transaksi/penjualan/cek_harga",
            type: 'post',
            data: { origin: '209', destination: tujuan, berat: berat, kurir: kode },
            success: function (a) {
                var data = JSON.parse(a),
                    result = data.rajaongkir.results;
                $.each(result, function (c, d) {
                    console.log(d);
                    d.costs.map((data) => {
                        $("#cekharga").append("<tr class='apiraja'><td><input class='form-check-input' type='radio' name='ongkir' onclick='onkirlain(" + data.cost[0].value + ")' value='" + data.cost[0].value + "'>&nbsp;<label class='form-check-label' for='exampleRadios1'>" + d.code.toUpperCase() + "-" + data.service + "</label></td><td>" + formatRupiah(data.cost[0].value, 'Rp. ') + " </td><td>" + data.cost[0].etd + "</td></tr>");
                    });
                });

                // console.log(result);
            }

        });
    }
    function onkirlain(ongkir) {
        var bayar = "<?= $total_bayar ?>",
            ongkir_toko = "<?= $ongkir->biaya ?>";
        $(".onkir_lain").html(formatRupiah(ongkir, 'Rp. '));
        $(".total_bayar_lain").html(formatRupiah(parseInt(bayar) - parseInt(ongkir_toko) + ongkir, 'Rp. '));
    }
</script>