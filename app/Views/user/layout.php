<?php

use App\Models\Model_Auth;
use App\Models\CartModel;  // Don't forget to include CartModel

if (session()->has('id')) {
  $userId = session()->get('id');

  // Load model pengguna
  $userModel = new Model_Auth();

  // Ambil data pengguna yang login
  $data = $userModel->getLogin($userId);

  // Initialize CartModel to get cart items
  $cartModel = new CartModel();

  // Get total cart items for the user
  $total_cart = $cartModel->totalItemsByUser($userId);

  // Ensure $total_cart is set
  $total_cart = isset($total_cart) ? $total_cart : 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Katalog Indonesia</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="Free HTML Templates" name="keywords">
  <meta content="Free HTML Templates" name="description">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="<?= base_url(); ?>user/lib/animate/animate.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>user/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="<?= base_url(); ?>user/css/style.css" rel="stylesheet">
</head>

<body>
  <!-- Topbar Start -->
  <div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
      <div class="col-lg-6 d-none d-lg-block">
        <div class="d-inline-flex align-items-center h-100">
          <a class="text-body mr-3" href="">About</a>
          <a class="text-body mr-3" href="">Contact</a>
          <a class="text-body mr-3" href="">Help</a>
          <a class="text-body mr-3" href="">FAQs</a>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- Topbar End -->


  <!-- Navbar Start -->
  <div class="container-fluid bg-dark mb-50">
    <div class="row px-xl-5">
      <!-- Logo Section -->
      <div class="col-lg-3 d-none d-lg-block">
        <div class="">
          <img class="img-fluid" width="300px" src="<?= base_url(); ?>user/img/logokatalog.png" alt="Logo">
        </div>
      </div>

      <!-- Main Navbar -->
      <div class="col-lg-9">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
          <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <!-- Menu Items -->
            <div class="navbar-nav mr-auto py-0">
              <a href="<?= base_url(); ?>" class="nav-item nav-link <?= $menu == 'dashboard' ? 'active' : '' ?>">Home</a>
              <a href="<?= base_url('user/shop'); ?>" class="nav-item nav-link <?= $menu == 'shop' ? 'active' : '' ?>">Barang</a>
              <a href="<?= base_url('user/jasa'); ?>" class="nav-item nav-link <?= $menu == 'jasa' ? 'active' : '' ?>">Jasa</a>
            </div>

            <div id="google_translate_element"></div>


            <!-- Search Bar -->
            <div class="col-lg-4 col-4 text-left">
              <form action="">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for products">
                  <div class="input-group-append">
                    <span class="input-group-text bg-transparent text-primary">
                      <i class="fa fa-search"></i>
                    </span>
                  </div>
                </div>
              </form>
            </div>

            <!-- Favorite Button -->
            <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
              <a href="" class="btn px-0">
                <i class="fas fa-heart text-primary"></i>
              </a>
            </div>

            <!-- User Account Section -->
            <div class="col-lg-4 col-6 text-right">
              <?php if (session()->get('username')) : ?>
                <div class="btn-group">
                  <button type="button" class="btn user-btn" data-toggle="dropdown">
                    <i class="fas fa-user"></i> <?= session()->get('username'); ?>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                    <a href="<?= base_url(); ?>myaccount" class="dropdown-item">My Account</a>
                    <a href="<?= base_url(); ?>logout" class="dropdown-item">Log Out</a>
                  </div>
                </div>
              <?php else : ?>
                <div class="btn-group">
                  <button type="button" class="btn custom-login-btn" onclick="window.location='<?= base_url(); ?>auth/login'">Masuk</button>
                  <button type="button" class="btn custom-register-btn" onclick="window.location='<?= base_url(); ?>auth/register'">Daftar</button>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </nav>
      </div>
      <!-- Main Navbar End -->
    </div>
  </div>
  <!-- Navbar End -->


  <!-- Main Content -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <!-- Add your dynamic content here -->
        <?= $this->renderSection('content'); ?>
      </div>
    </div>
  </div>
  <!-- Main Content End -->


  <!-- Footer Start -->
  <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
    <div class="row px-xl-5 pt-5">

      <div class="col-lg-8 col-md-12">
        <div class="row">
          <div class="col-md-4 mb-5">
            <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
            <div class="d-flex flex-column justify-content-start">
              <a class="text-secondary mb-2" href="/"><i class="fa fa-angle-right mr-2"></i>Home</a>
              <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
              <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
              <a class="text-secondary mb-2" href="/cart"><i class="fa fa-angle-right mr-2"></i>Cart</a>
              <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
      <div class="col-md-6 px-xl-0">
        <p class="mb-md-0 text-center text-md-left text-secondary">
          &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed
          by
          <a class="text-primary" href="https://htmlcodex.com">CL</a>
        </p>
      </div>
      <div class="col-md-6 px-xl-0 text-center text-md-right">
        <img class="img-fluid" src="<?= base_url(); ?>user/img/payments.png" alt="">
      </div>
    </div>
  </div>
  <!-- Footer End -->


  <!-- Back to Top -->
  <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url(); ?>user/lib/easing/easing.min.js"></script>
  <script src="<?= base_url(); ?>user/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>

  <!-- Contact Javascript File -->
  <script src="<?= base_url(); ?>user/mail/jqBootstrapValidation.min.js"></script>
  <script src="<?= base_url(); ?>user/mail/contact.js"></script>

  <!-- Template Javascript -->
  <script src="<?= base_url(); ?>user/js/main.js"></script>
  <?= $this->renderSection('scripts'); ?>
  <script>
    const flashData = $('.flash_data').data('flashdata')
    const errorflashData = $('.error_flash').data('flashdata')
    console.log(errorflashData);
    if (flashData) {
      swal("Success!", flashData, "success")
    }

    if (errorflashData) {
      swal("Terjadi Kesalahan", errorflashData, "error")
    }

  </script>

<script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement(
                {pageLanguage: 'en'},
                'google_translate_element'
            );
        }
    </script>

    <script type="text/javascript" 
            src=
"https://translate.google.com/translate_a/element.js?
cb=googleTranslateElementInit">
    </script>
</body>

</html>