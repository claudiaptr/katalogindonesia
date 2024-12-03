<?php

use App\Models\Pernarikan;
use App\Models\Transaksi;

$id = session()->get('id');
$transaksi = new Transaksi(); // Inisialisasi model
$jumlah_blm_transakasi = $transaksi->where('verifikasi', 1)->countAllResults();

$penarikan = new Pernarikan();
$jumlah_blm_penarikan = $penarikan->where('verifikasi_penarikan', 1)->countAllResults()

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>asset/plugins/fontawesome-free/css/all.min.css">
    <?= $this->renderSection('link') ?>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url(); ?>asset/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url(); ?>asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url(); ?>asset/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>asset/dists/css/adminlte.min.css">
    <!-- sweat alart -->
    <link rel="stylesheet" href="<?= base_url(); ?>asset/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">


    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url(); ?>asset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url(); ?>asset/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url(); ?>asset/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <link href="<?= base_url(); ?>sales/style.css" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url(); ?>asset/dists/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="<?= base_url(); ?>asset/dists/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="<?= base_url(); ?>asset/dists/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="<?= base_url(); ?>asset/dists/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="<?= base_url(); ?>asset/dists/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">KATALOG INDONESIA</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url(); ?>asset/dists/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= session()->get('username'); ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <a href="<?= base_url(); ?> admin/dashboard" class="nav-link <?= $menu == 'dashboard' ? 'active' : ''  ?>">
                                <i class="nav-icon  fas fa-th-large"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>admin/data_pengguna" class="nav-link <?= $menu == 'ketegori' ? 'active' : ''  ?>">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Data Pengguna
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>admin/daftar-penjual" class="nav-link <?= $menu == 'ketegori' ? 'active' : ''  ?>">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Pendaftaran Penjual
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                        <li class="nav-item <?= $menu == 'iklan' ? 'menu-open' : ''  ?>">
                            <a href="#" class="nav-link  <?= $menu == 'iklan' ? 'active' : ''  ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Iklan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>admin/view_iklan_carausel" class="nav-link <?= $sub_menu == 'iklan_carausel' ? 'active' : ''  ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Iklan Carausel</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>admin/view_iklan_tetap" class="nav-link <?= $sub_menu == 'iklan_tetap' ? 'active' : ''  ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Iklan Tetap</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>admin/view_kategori" class="nav-link <?= $menu == 'ketegori' ? 'active' : ''  ?>">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Kategori
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>admin/view_sub_kategori" class="nav-link <?= $menu == 'sub_ketegori' ? 'active' : ''  ?>">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Sub Kategori
                                </p>
                            </a>
                        </li>
                        <li class="nav-item <?= $menu == 'verifikasi' ? 'menu-open' : ''  ?>">
                            <a href="#" class="nav-link  <?= $menu == 'verifikasi' ? 'active' : ''  ?>">
                                <i class="nav-icon fas fa-check"></i>
                                <p>
                                    Verifikasi Barang
                                    <i class="right fas fa-angle-left"></i>
                                    <?php if ($jumlah_verifikasi > 0) : ?>
                                        <span class="badge badge-info right"><?= $jumlah_verifikasi; ?></span>
                                    <?php endif ?>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>admin/sudah_verifikasi" class="nav-link <?= $sub_menu == 'sudah_verifikasi' ? 'active' : ''  ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sudah Verifikasi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>admin/belum_verifikasi" class="nav-link <?= $sub_menu == 'belum_verifikasi' ? 'active' : ''  ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <?php if ($jumlah_verifikasi > 0) : ?>
                                            <span class="badge badge-info right"><?= $jumlah_verifikasi; ?></span>
                                        <?php endif ?>
                                        <p>Belum Verifikasi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>admin/tolak_verifikasi" class="nav-link <?= $sub_menu == 'tolak_verifikasi' ? 'active' : ''  ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tolak Verifikasi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item <?= $menu == 'pembayaran' ? 'menu-open' : ''  ?>">
                            <a href="#" class="nav-link  <?= $menu == 'pembayaran' ? 'active' : ''  ?>">
                                <i class="nav-icon fas fa-dollar-sign"></i>
                                <p>
                                    Pembayaran
                                    <i class="right fas fa-angle-left"></i>
                                    <?php if ($jumlah_blm_transakasi > 0) : ?>
                                        <span class="badge badge-info right"><?= $jumlah_blm_transakasi; ?></span>
                                    <?php endif ?>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>admin/verifikasi_sdh_pembayaran" class="nav-link <?= $sub_menu == 'sudah_verifikasi_pembayaran' ? 'active' : ''  ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sudah Verifikasi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>admin/verifikasi_blm_pembayaran" class="nav-link <?= $sub_menu == 'belum_verifikasi_pembayaran' ? 'active' : ''  ?>">
                                        <?php if ($jumlah_blm_transakasi > 0) : ?>
                                            <span class="badge badge-info right"><?= $jumlah_blm_transakasi; ?></span>
                                        <?php endif ?>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Belum Verifikasi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>admin/verifikasi_tlk_pembayaran" class="nav-link <?= $sub_menu == 'tolak_verifikasi_pembayaran' ? 'active' : ''  ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tolak Verifikasi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>admin/view_transfer" class="nav-link <?= $menu == 'transfer' ? 'active' : ''  ?>">
                                <i class="nav-icon fas fa-money-bill"></i>
                                <p>
                                    Transfer
                                </p>
                            </a>
                        </li>
                        <li class="nav-item <?= $menu == 'penarikan' ? 'menu-open' : ''  ?>">
                            <a href="#" class="nav-link  <?= $menu == 'penarikan' ? 'active' : ''  ?>">
                                <i class="nav-icon fas fa-dollar-sign"></i>
                                <p>
                                    Penarikan
                                    <i class="right fas fa-angle-left"></i>
                                    <?php if ($jumlah_blm_penarikan > 0) : ?>
                                        <span class="badge badge-info right"><?= $jumlah_blm_penarikan; ?></span>
                                    <?php endif ?>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                               
                             
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>admin/verifikasi_blm_penarikan" class="nav-link <?= $sub_menu == 'belum_verifikasi_penarikan' ? 'active' : ''  ?>">
                                        <?php if ($jumlah_blm_penarikan > 0) : ?>
                                            <span class="badge badge-info right"><?= $jumlah_blm_penarikan; ?></span>
                                        <?php endif ?>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Penarikan</p>
                                    </a>
                                </li>
                               
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?> logout" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Log out
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="flash_data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>
            <?= $this->renderSection('content'); ?>
        </div>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2022 <a href="https://adminlte.io">Katalog Indoonesia</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url(); ?>asset/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url(); ?>asset/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= base_url(); ?>asset/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?= base_url(); ?>asset/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="<?= base_url(); ?>asset/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?= base_url(); ?>asset/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= base_url(); ?>asset/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url(); ?>asset/plugins/moment/moment.min.js"></script>
    <script src="<?= base_url(); ?>asset/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url(); ?>asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="<?= base_url(); ?>asset/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url(); ?>asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>asset/dists/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url(); ?>asset/dists/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?= base_url(); ?>asset/dists/js/pages/dashboard.js"></script>
    <script src="<?= base_url(); ?>asset/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>asset/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?= base_url(); ?>asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>asset/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>asset/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url(); ?>asset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>asset/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url(); ?>asset/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url(); ?>asset/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url(); ?>asset/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url(); ?>asset/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url(); ?>asset/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="<?= base_url(); ?>asset/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        const flashData = $('.flash_data').data('flashdata')
        if (flashData) {
            Swal.fire({
                title: flashData,
                icon: "success"
            });
        }


        $('.delete').on('submit', function(e) {
            e.preventDefault();
            const hero = this;
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    hero.submit();
                }
            });
        })
        $('.verifikasi').on('submit', function(e) {
            e.preventDefault();
            const hero = this;
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, verifikaasi it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    hero.submit();
                }
            });
        })
        $('.tolak').on('submit', function(e) {
            e.preventDefault();
            const hero = this;
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, tolak it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    hero.submit();
                }
            });
        })
    </script>
    <?= $this->renderSection('scripts') ?>

</body>

</html>