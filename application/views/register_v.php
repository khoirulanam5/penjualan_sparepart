<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title; ?></title>
        <link rel="shortcut icon" type="image/icon" href="<?= base_url('/src/img/sparepart.png'); ?>"/>
        <link rel="stylesheet" href="<?= base_url('src/css/styles.css'); ?>">
        <?php $this->load->view("Css"); ?>
        <script src="<?=base_url('src/js/')?>hm_sweetalert.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <style>
        body {
            background-image: url('<?= base_url('src/img/bglogin.jpg'); ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-box {
            width: 100%;
            max-width: 600px; /* Lebarkan login-box */
            padding: 30px;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        .card, .card-header, .card-body {
            background: transparent;
            border: none;
        }

        .input-group .form-control, .input-group .input-group-text {
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(0, 0, 0, 0.2);
            color: #000;
        }

        .btn-primary {
            width: 100%;
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Atur form menjadi dua kolom */
        .form-row {
            display: flex;
            gap: 10px;
        }
        
        .form-row .form-group {
            flex: 1;
        }
    </style>
</head>
<body class="hold-transition login-page">
<!-- Cek jika ada flashdata bernama 'message' -->
<?php if ($this->session->flashdata('message')): ?>
    <script>
        // Cetak flashdata sebagai script JS
        <?= $this->session->flashdata('message'); ?>
    </script>
    <?php 
    // Hapus flashdata setelah ditampilkan
    $this->session->unset_userdata('message'); 
    ?>
<?php endif; ?>

<div class="login-box" id="loginForm">
  <div class="card card-outline">
    <div class="card-body">
        <form action="<?= base_url('register/tambah') ?>" method="post" style="margin: 20px;">
            <div class="row col-md-12 input-group mb-3">
                <div class="col-md-6">
                    <span class="input-group-text btn-sm" id="basic-addon1">Nama</span>
                    <input type="text" class="form-control btn-sm" name="nama_pelanggan" placeholder="Nama" aria-label="nama_pelangan" aria-describedby="basic-addon1">
                </div>
                <div class="col-md-6">
                    <span class="input-group-text btn-sm" id="basic-addon1">Username</span>
                    <input type="text" class="form-control btn-sm" name="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text btn-sm" id="basic-addon1">Password</span>
                <input type="password" class="form-control btn-sm" name="password" placeholder="Password" aria-label="password" aria-describedby="basic-addon1">
            </div>
            <p class="btn-xs">*Daftar kota tujuan pengiriman.</p>
            <div class="input-group mb-3">
                <span class="input-group-text btn-sm" id="basic-addon1">Kabupaten</span>
                <select name="kabupaten" id="kabupaten" class="form-control btn-sm" onchange="kecamatan_select(this.value)">
                    <option value="">--Pilih Kabupaten--</option>
                    <?php
                    $kota = $this->db->select("lokasi_tujuan")->from("ongkos_kirim")->get()->result();
                    $kecamatan = array();
                    foreach ($kota as $k => $val) {
                        if ($val->lokasi_tujuan != '-') {
                            $kec = file_get_contents(FCPATH.'/sources/'.$val->lokasi_tujuan.'.json');
                            $kecamatan[$val->lokasi_tujuan] = json_decode($kec)->value;
                            echo '<option value="' . $val->lokasi_tujuan . '">' . $val->lokasi_tujuan . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
        
            <div class="input-group mb-3">
                <span class="input-group-text btn-sm" id="basic-addon1">Kecamatan</span>
                <select name="kecamatan" id="kecamatan" class="form-control btn-sm">
                    <option value="">--Pilih Kecamatan--</option>
                </select>

                <script>
                    var datas = JSON.parse('<?=json_encode($kecamatan)?>');
                    function kecamatan_select(kec) {
                        $.each(datas,function(a,b){
                            if(a == kec){
                                $(".pil").remove();
                                b.map((data)=>{
                                    $("#kecamatan").prepend('<option class="pil" value="'+data.name+'">'+data.name+'</option>');
                                })
                                
                            }
                        })
                    }
                </script>
            </div>
            <div class="row col-md-12 input-group mb-3">
                <div class="col-md-6">
                    <span class="input-group-text btn-sm" id="basic-addon1">Desa</span>
                    <input type="text" class="form-control btn-sm" name="desa" placeholder="Desa" aria-label="desa" aria-describedby="basic-addon1">
                </div>
                <div class="col-md-6">
                    <span class="input-group-text btn-sm" id="basic-addon1">Kode Pos</span>
                    <input type="text" class="form-control btn-sm" name="kodepos" placeholder="Kode Pos" aria-label="kodepos" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="row col-md-12 input-group mb-3">
                <div class="col-md-6">
                    <span class="input-group-text btn-sm" id="basic-addon1">Rw</span>
                    <input type="text" class="form-control btn-sm" name="rw" placeholder="Rw" aria-label="rw" style="flex:none !important">
                </div>
                <div class="col-md-6">
                    <span class="input-group-text btn-sm" id="basic-addon1">Rt</span>
                    <input type="text" class="form-control btn-sm" name="rt" placeholder="Rt" aria-label="Rt" style="flex:none !important">
                </div>
            </div>
            <div class="row col-md-12 input-group mb-3">
                <div class="col-md-6">
                    <span class="input-group-text btn-sm" id="basic-addon1">No Hp</span>
                    <input type="number" class="form-control btn-sm" name="no_hp" placeholder="No Hp" aria-label="no_hp" aria-describedby="basic-addon1">
                </div>
                <div class="col-md-6">
                    <span class="input-group-text btn-sm" id="basic-addon1">Email</span>
                    <input type="email" class="form-control btn-sm" name="email" placeholder="Email" aria-label="email" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="submit" class="form-control btn-sm btn-warning" name="daftar" value="Daftar">
            </div>
        </form>
    </div>
  </div>
</div>
</body>
</html>
