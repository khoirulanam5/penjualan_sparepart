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
            max-width: 400px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.4); /* Slightly less transparent */
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px); /* Blur effect */
        }

        .card, .card-header, .card-body {
            background: transparent;
            border: none;
        }

        .card-header img {
            max-width: 100%;
            margin-bottom: 10px;
        }

        .input-group .form-control, .input-group .input-group-text {
            background: rgba(255, 255, 255, 0.7); /* Less transparent for input fields */
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
    <div class="card-header text-center">
      <img src="<?= base_url() ?>src/img/sparepart.png" alt="Login Logo" width="150px"><br>
      <small>Alamat: Jl. Jepara - Bangsri, Krasak, Bangsri, Kec. Bangsri</small>
      <div><small>Kab. Jepara, Jawa Tengah 59453</small></div>
    </div>
    <div class="card-body">
      <div class="text-danger text-center">
      <form action="<?= base_url() ?>login/cek" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" autocomplete="off" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" autocomplete="off" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
          <div>
            <a class="btn btn-primary" href="<?= base_url('register'); ?>">Daftar</a>
          </div>
        </div>
      </form>
      <p class="mb-1">
        <a href="forgot-password.html"></a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center"></a>
      </p>
    </div>
  </div>
</div>
</body>
</html>