<?= $this->extend('user/layout'); ?>
<?= $this->section('content'); ?>

<!-- Carousel Start -->
<div class="container-fluid mb-3">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php foreach ($iklan_carausel as $index => $item) : ?>
                        <li data-target="#header-carousel" data-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>"></li>
                    <?php endforeach; ?>
                </ol>
                <div class="carousel-inner">
                    <?php foreach ($iklan_carausel as $index => $item) : ?>
                        <div class="carousel-item position-relative <?= $index === 0 ? 'active' : '' ?>" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="<?= base_url(); ?>img/<?= $item['foto_iklan']; ?>" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown"><?= $item['judul_iklan']; ?></h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn"><?= $item['isi_iklan']; ?></p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <?php if ($iklan_tetap_1) : ?>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="<?= base_url('img/' . $iklan_tetap_1['foto_iklan']); ?>" alt="<?= $iklan_tetap_1['judul_iklan']; ?>">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase"><?= $iklan_tetap_1['judul_iklan']; ?></h6>
                        <h3 class="text-white mb-3"><?= $iklan_tetap_1['isi_iklan']; ?></h3>
                    </div>
                </div>
            <?php endif ?>
            <?php if ($iklan_tetap_2) : ?>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="<?= base_url('img/' . $iklan_tetap_2['foto_iklan']); ?>" alt="<?= $iklan_tetap_2['judul_iklan']; ?>">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase"><?= $iklan_tetap_2['judul_iklan']; ?></h6>
                        <h3 class="text-white mb-3"><?= $iklan_tetap_2['isi_iklan']; ?></h3>

                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
<!-- Carousel End -->


<!-- Featured Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->


<!-- Categories Start -->
<!-- <div class="container-fluid pt-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categories</span></h2>
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="">
                <div class="cat-item d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?= base_url(); ?>user/img/cat-1.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Category Name</h6>
                        <small class="text-body">100 Products</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?= base_url(); ?>user/img/cat-2.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Category Name</h6>
                        <small class="text-body">100 Products</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?= base_url(); ?>user/img/cat-3.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Category Name</h6>
                        <small class="text-body">100 Products</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?= base_url(); ?>user/img/cat-4.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Category Name</h6>
                        <small class="text-body">100 Products</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?= base_url(); ?>user/img/cat-4.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Category Name</h6>
                        <small class="text-body">100 Products</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?= base_url(); ?>user/img/cat-3.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Category Name</h6>
                        <small class="text-body">100 Products</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?= base_url(); ?>user/img/cat-2.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Category Name</h6>
                        <small class="text-body">100 Products</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?= base_url(); ?>user/img/cat-1.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Category Name</h6>
                        <small class="text-body">100 Products</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?= base_url(); ?>user/img/cat-2.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Category Name</h6>
                        <small class="text-body">100 Products</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?= base_url(); ?>user/img/cat-1.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Category Name</h6>
                        <small class="text-body">100 Products</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?= base_url(); ?>user/img/cat-4.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Category Name</h6>
                        <small class="text-body">100 Products</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="">
                <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid" src="<?= base_url(); ?>user/img/cat-3.jpg" alt="">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>Category Name</h6>
                        <small class="text-body">100 Products</small>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div> -->
<!-- Categories End -->


<!-- Produk start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Produk Unggulan</span></h2>
    <div class="row px-xl-5">
        <?php foreach ($barang as $bk) : ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <a href="<?= base_url(); ?>user/detail/<?= $bk['id']; ?>" class="d-block text-decoration-none">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="" style="object-fit: scale-down !important; width: 280px; height: 280px;" src="<?= base_url(); ?>barang/<?= $bk['foto_barang']; ?>" alt="">
                        </div>
                        <div class="text-center py-4 ">
                            <p class="h6 text-decoration-none text-truncate"><?= $bk['judul_barang']; ?></p>
                            <div class="justify-content-center mt-2">
                                <h5 class="mb-0 ">Rp. <?= $bk['harga_barang']; ?></h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- Produk end -->




<!-- Offer Start -->
<div class="container-fluid pt-5 pb-3">
    <div class="row px-xl-5">
        <div class="col-md-6">
            <?php if ($iklan_tetap_3) : ?>
                <div class="product-offer mb-30" style="height: 300px;">

                    <img class="img-fluid" src="<?= base_url('img/' . $iklan_tetap_3['foto_iklan']); ?>" alt="<?= $iklan_tetap_3['judul_iklan']; ?>">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase"><?= $iklan_tetap_3['judul_iklan']; ?></h6>
                        <h3 class="text-white mb-3"><?= $iklan_tetap_3['isi_iklan']; ?></h3>
                    </div>
                </div>
            <?php endif ?>
        </div>
        <div class="col-md-6">
            <?php if ($iklan_tetap_4) : ?>
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="<?= base_url('img/' . $iklan_tetap_4['foto_iklan']); ?>" alt="<?= $iklan_tetap_4['judul_iklan']; ?>">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase"><?= $iklan_tetap_4['judul_iklan']; ?></h6>
                        <h3 class="text-white mb-3"><?= $iklan_tetap_4['isi_iklan']; ?></h3>

                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
<!-- Offer End -->


<!-- Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recent Products</span></h2>
    <div class="row px-xl-5">

        <?php foreach ($barang_baru as $bb) : ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="" style="object-fit: scale-down !important; width: 280px; height: 280px;" src="<?= base_url(); ?>barang/<?= $bb['foto_barang']; ?>" alt="">
                        <div class="product-action">
                            <button class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></button>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href=""><?= $bb['judul_barang']; ?></a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5><?= $bb['harga_barang']; ?></h5>
                            <h6 class="text-muted ml-2"><del>$123.00</del></h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small>(99)</small>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>
<!-- Products End -->


<!-- Vendor Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                <div class="bg-light p-4">
                    <img src="<?= base_url(); ?>user/img/vendor-1.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="<?= base_url(); ?>user/img/vendor-2.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="<?= base_url(); ?>user/img/vendor-3.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="<?= base_url(); ?>user/img/vendor-4.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="<?= base_url(); ?>user/img/vendor-5.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="<?= base_url(); ?>user/img/vendor-6.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="<?= base_url(); ?>user/img/vendor-7.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="<?= base_url(); ?>user/img/vendor-8.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Vendor End -->
<?= $this->endSection(); ?>