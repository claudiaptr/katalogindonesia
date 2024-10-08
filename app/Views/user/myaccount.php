<?= $this->extend('user/layout'); ?>
<?= $this->section('content'); ?>
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
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4 d-flex align-items-end">
                <div class="">
                    <img class="img-fluid" width="50px" src="<?= base_url(); ?>user/img/katalog1.png" alt="">
                </div>
                <div class="">
                    <a href="" class="text-decoration-none">
                        <span class="h3 text-uppercase text-primary bg-dark px-2">Katalog</span>
                        <span class="h3 text-uppercase text-dark bg-primary px-2 ml-n1">Indonesia</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-4 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products" aria-label="Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <div class="btn-group">
                    <button type="button" class="btn user-btn" data-toggle="dropdown">
                        <i class="fas fa-user"></i> <?= htmlspecialchars(session()->get('username')); ?>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                        <a href="<?= base_url(); ?>myaccount" class="dropdown-item" type="button">My Account</a>
                        <a href="<?= base_url(); ?>logout" class="dropdown-item" type="button">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        <a href="<?= base_url(); ?>myaccount" class="nav-item nav-link active">My Account</a>
                        <a href="<?= base_url(); ?>user/shop" class="nav-item nav-link">Shop</a>
                        <a href="<?= base_url(); ?>cart" class="nav-item nav-link">Shopping Cart</a>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="<?= base_url(); ?>" class="nav-item nav-link">Home</a>
                            <a href="<?= base_url(); ?>user/contact" class="nav-item nav-link">Contact</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- My Account Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="text-center my-4">My Account</h2>
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0">Account Details</h4>
                            </div>
                            <div class="card-body">
                                <form action="<?= base_url('myaccount/update'); ?>" method="POST">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" id="username" name="username" class="form-control" value="<?= htmlspecialchars($data['username']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">New Password (leave blank to keep current)</label>
                                        <input type="password" id="password" name="password" class="form-control">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Update Account</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- My Account End -->

    <?= $this->endSection(); ?>

