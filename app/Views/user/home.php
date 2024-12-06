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

<!-- Produk start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Produk Unggulan</span>
    </h2>
    <div class="row px-xl-5">
        <?php foreach ($barang as $bk) : ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <a href="<?= base_url(); ?>user/detail/<?= $bk['id']; ?>" class="d-block text-decoration-none">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="" style="width: 100%; height: 250px; object-fit: cover" 
                                 src="<?= base_url(); ?>barang/<?= $bk['foto_barang']; ?>" alt="">

                            <!-- Jika ada diskon, tampilkan label diskon di gambar -->
                            <?php if (isset($bk['diskon']) && $bk['diskon'] > 0): ?>
                                <div class="diskon-label position-absolute" 
                                     style="top: 10px; right: 10px; background-color: red; color: white; padding: 5px 10px; font-size: 16px; font-weight: bold; border-radius: 5px;">
                                    <?= $bk['diskon']; ?>% OFF
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="text-center py-4">
                            <p class="h6 text-decoration-none text-truncate"><?= $bk['judul_barang']; ?></p>
                            <div class="justify-content-center mt-2">
                                <div>
                                    <!-- Menampilkan harga sebelum diskon (dicoret) dan harga setelah diskon -->
                                    <?php if (isset($bk['diskon']) && $bk['diskon'] > 0): ?>
                                        <span class="harga-coret" style="text-decoration: line-through; color: #888; margin-right: 10px;">
                                            Rp. <?= number_format($bk['harga_barang'], 0, ',', '.'); ?>
                                        </span>
                                        <h5 class="mb-0">Rp. <?= number_format($bk['harga_barang'] * (1 - $bk['diskon'] / 100), 0, ',', '.'); ?></h5>
                                    <?php else: ?>
                                        <h5 class="mb-0">Rp. <?= number_format($bk['harga_barang'], 0, ',', '.'); ?></h5>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- Menampilkan stok produk -->
                            <div class="mt-2">
                                <small>Stok: <?= $bk['jumlah_barang']; ?></small>
                            </div>

                        </div>

                        <div class="text-center py-2">
                            <!-- Bagian rating bintang -->
                            <div class="rating">
                                <?php
                                // Ambil rating dari array, jika tidak ada, set 0
                                $rating_value = isset($ratingBarang[$bk['id']]) ? $ratingBarang[$bk['id']] : 0;

                                // Loop untuk menampilkan 5 bintang
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= floor($rating_value)) {
                                        // Bintang penuh jika nilainya sesuai rating (bintang terang)
                                        echo '<i class="fa fa-star text-warning"></i>';
                                    } elseif ($i == ceil($rating_value) && $rating_value - floor($rating_value) > 0) {
                                        // Bintang setengah jika ada desimal di rating
                                        echo '<i class="fa fa-star-half-alt text-warning"></i>';
                                    } else {
                                        // Bintang tidak terang untuk sisanya
                                        echo '<i class="fa fa-star" style="color: #ccc"></i>';
                                    }
                                }
                                ?>
                                <span>(<?= $jumlahRatingBarang[$bk['id']]; ?>) Reviews</span>

                                <!-- Alamat ditampilkan di bawah rating dan pojok kanan -->
                            <div class="mt-2 text-right" style="font-size: 12px; color: #888; padding: 15px">
                                <?php if (isset($bk['alamat']) && !empty($bk['alamat'])): ?>
                                    <?= $bk['alamat']['kelurahan']; ?> 
                                <?php else: ?>
                                    Alamat tidak tersedia
                                <?php endif; ?>
                            </div>

                            </div>
                            <br>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- Produk end -->

<!-- Pagination Start -->
<div class="pagination-container">
    <!-- Previous Button -->
    <div class="pagination-arrow" 
         <?= ($currentPage == 1) ? 'style="pointer-events: none; opacity: 0.5;"' : '' ?>>
         <a href="<?= ($currentPage > 1) ? site_url('/user/home?page=' . ($currentPage - 1)) : '#' ?>">
        <svg width="18" height="18">
            <use xlink:href="#left" />
        </svg>
        <span class="arrow-text">Previous</span>
    </div>

    <!-- Loop to display page numbers -->
     <br>
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <div class="pagination-number <?= ($currentPage == $i) ? 'pagination-active' : '' ?>">
            <a href="<?= site_url('/user/home?page=' . $i) ?>"><?= $i ?></a>
        </div>
    <?php endfor; ?>

    <!-- Next Button -->
    <div class="pagination-arrow" 
         <?= ($currentPage == $totalPages) ? 'style="pointer-events: none; opacity: 0.5;"' : '' ?>>
         <a href="<?= ($currentPage < $totalPages) ? site_url('/user/home?page=' . ($currentPage + 1)) : '#' ?>">
        <svg width="18" height="18">
            <use xlink:href="#right" />
        </svg>
        <span class="arrow-text">Next</span>
    </div>
</div>
<!-- Pagination End -->



<style>
.pagination-container {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 20px;
    flex-wrap: nowrap; /* Ubah menjadi nowrap untuk memastikan elemen tidak membungkus */
}

.pagination-number {
    --size: 40px; /* Ukuran tombol pagination */
    --margin: 8px; /* Margin antar tombol */
    margin: 0 var(--margin);
    padding: 0 12px;
    height: var(--size);
    width: var(--size);
    border-radius: 50%;
    background-color: #202020;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 16px;
    transition: all 0.3s ease;
}

.pagination-number:hover {
    background-color: #444;
    transform: translateY(-3px);
}

.pagination-number:active {
    background-color: #666;
    transform: translateY(1px);
}

.pagination-active {
    background-color: #FF6347; /* Mengganti warna untuk halaman aktif */
    color: white;
}

.arrow-text {
    display: block;
    font-size: 14px;
    font-weight: bold;
    color: #202020;
    margin-top: 5px;
}

.pagination-number a {
    color: inherit;
    text-decoration: none;
    font-weight: bold;
}

.pagination-arrow {
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    padding: 10px;
    margin: 0 8px; /* Sesuaikan margin agar seimbang */
    transition: all 0.3s ease;
    white-space: nowrap; /* Pastikan teks tetap dalam satu baris */
}



.pagination-arrow svg {
    width: 20px;
    height: 20px;
    fill: #202020;
}

.pagination-arrow[style*="pointer-events: none"] {
    opacity: 0.5;
    pointer-events: none;
}

@media (max-width: 768px) {
    .pagination-number {
        --size: 36px; /* Mengurangi ukuran untuk tampilan mobile */
        font-size: 14px;
    }

    .pagination-container {
        flex-direction: column;
    }

    .pagination-arrow {
        margin: 10px 0;
    }
}

</style>


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