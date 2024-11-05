<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>asset/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url(); ?>asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>asset/dists/css/adminlte.min.css">
  <link href="<?= base_url(); ?>asset/dists/css/login.css" rel="stylesheet">
</head>

<body class="hold-transition login-page">
  <div class="login-box">

      <div class="card-body login-card-body">
        
        <?php $errors = session()->getFlashdata('errors') ?>
        <?php if (!empty($errors)) : ?>
          <div class="alert alert-danger" role="alert">
            <ul>
              <?php foreach ($errors as $error) : ?>
                <li><?= esc($error) ?></li>
              <?php endforeach ?>
            </ul>
          </div>
        <?php endif ?>

        <?php if (session()->getFlashdata('pesan')) : ?>
          <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
          </div>
        <?php endif ?>

        <?php if (session()->getFlashdata('error')) : ?>
          <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('error'); ?>
          </div>
        <?php endif ?>

        <div class="login-logo">
      <a>
        <img src="<?= base_url('img/logokatalog.png'); ?>" alt="Logo" style="height: 50px;">
      </a>
        </div>

        <?php echo form_open('auth/cek_login') ?>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope icon-custom-color"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock icon-custom-color"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <button type="submit" class="btn btn-signin btn-block">Sign In</button>
          </div>
        </div>
        <?php echo form_close() ?>

        <div class="social-auth-links text-center mb-3">
          <p>- OR -</p>
          <a href="<?= $link; ?>" class="btn btn-danger btn-block">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
          </a>
        </div>

        <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="register" class="text-center">Register a new membership</a>
        </p>
      </div>
  </div>

  <!-- jQuery -->
  <script src="<?= base_url(); ?>asset/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url(); ?>asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url(); ?>asset/dists/js/adminlte.min.js"></script>
</body>

</html>
