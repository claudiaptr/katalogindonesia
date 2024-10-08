<?php

use App\Models\Model_Auth;
use App\Models\CartModel; // Don't forget to include CartModel

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
        <div class="row bg-secondary py-1 px-xl-5 align-items-center">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    <a class="text-body mr-3" href="">About</a>
                    <a class="text-body mr-3" href="">Contact</a>
                    <a class="text-body mr-3" href="">Help</a>
                    <a class="text-body mr-3" href="">FAQs</a>
                </div>
            </div>

            <!-- Language Selector -->
            <div class="col-lg-6 text-right">
                <div class="ml-auto">
                    <div id="google_translate_element"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <style>
        #google_translate_element {
            display: inline-block; /* Pastikan elemen tidak mengganggu layout */
        }
    </style>

    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-20">
        <div class="row">
            <!-- Main Navbar -->
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
                    <!-- Logo Section -->
                    <div class="col-lg-2 d-none d-lg-block">
                        <img width="150px" src="<?= base_url(); ?>user/img/logokatalog.png" alt="Logo">
                    </div>

                    <!-- Menu Items -->
                    <div class="navbar-nav mr-auto py-0">
                        <a href="<?= base_url(); ?>" class="nav-item nav-link <?= $menu == 'dashboard' ? 'active' : '' ?> h5">Home</a>
                        <a href="<?= base_url('user/shop'); ?>" class="nav-item nav-link <?= $menu == 'shop' ? 'active' : '' ?> h5">Barang</a>
                        <a href="<?= base_url('user/jasa'); ?>" class="nav-item nav-link <?= $menu == 'jasa' ? 'active' : '' ?> h5">Jasa</a>
                        <a href="<?= base_url('contact'); ?>" class="nav-item nav-link h5">Contact</a>
                    </div>

                    <!-- Search Bar -->
                    <div class="col-lg-5 col-5 text-left">
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

                    <div class="d-flex align-items-center">
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <div class="d-flex align-items-center">
                                <a href="#" class="btn px-0">
                                    <i class="fas fa-heart text-primary"></i>
                                </a>
                                <a href="<?= base_url(); ?>cart" class="btn px-0 ml-3">
                                    <i class="fas fa-shopping-cart text-primary"></i>
                                    <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">
                                        <?php if (session()->get('id')) : ?>
                                            <?= $total_cart; ?>
                                        <?php else : ?>
                                            0
                                        <?php endif ?>
                                    </span>
                                </a>
                                <div class="btn-group">
                                    <?php if (session()->get('username')) : ?>
                                        <button type="button" class="btn user-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-user text-primary"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                            <a href="<?= base_url(); ?>myaccount" class="dropdown-item">My Account</a>
                                            <a href="<?= base_url(); ?>logout" class="dropdown-item">Log Out</a>
                                        </div>
                                    <?php else : ?>
                                        <button type="button" class="btn user-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-user text-primary"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                            <a href="<?= base_url(); ?>auth/login" class="dropdown-item">Masuk</a>
                                            <a href="<?= base_url(); ?>auth/register" class="dropdown-item">Daftar</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
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
                    &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed by
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
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="<?= base_url(); ?>user/lib/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>user/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>user/lib/easing/easing.min.js"></script>
    <script src="<?= base_url(); ?>user/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?= base_url(); ?>user/js/main.js"></script>
    <script type="text/javascript" src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
</body>

</html>
