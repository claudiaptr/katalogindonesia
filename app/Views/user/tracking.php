<?= $this->extend('user/layout'); ?>
<?= $this->section('content'); ?>




<!-- Featured Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <a href="<?= base_url(); ?>#" class=" text-decoration-none animate__animated animate__fadeIn">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Belum Bayar</h5>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <a href="#" class="text-decoration-none animate__animated animate__fadeIn">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">DiKemas</h5>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <a href="#" class="text-decoration-none animate__animated animate__fadeIn">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Dikirim</h5>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <a href="#" class="text-decoration-none animate__animated animate__fadeIn">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Beri Penilaian</h5>
                </div>
            </a>
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










<!-- Vendor Start -->
<!-- <div class="container-fluid py-5">
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
</div> -->
<!-- Vendor End -->
<?= $this->endSection(); ?>