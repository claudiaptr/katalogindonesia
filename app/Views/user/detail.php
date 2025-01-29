  <?= $this->extend('user/layout'); ?>
  <?= $this->section('content'); ?>
  <!-- Shop Detail Start -->
  <div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
        <div id="product-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner bg-light">

                <div class="carousel-item active">
                    <img class="w-100 h-100" src="<?= base_url(); ?>barang/<?= $barang['foto_barang']; ?>" alt="Image">
                </div>
                <?php if (!empty($foto_barang)): ?>
                    <?php foreach ($foto_barang as $fb): ?>
                        <div class="carousel-item">
                            <!-- Cek jika foto_barang_lain ada, jika tidak tampilkan gambar placeholder -->
                            <img class="w-100 h-100" 
                                src="<?= base_url(); ?>fotobarang/<?= isset($fb['foto_barang_lain']) && $fb['foto_barang_lain'] ? $fb['foto_barang_lain'] : 'default-placeholder.jpg'; ?>" 
                                alt="Image">
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Jika tidak ada foto lain, tampilkan foto placeholder -->
                    <div class="carousel-item">
                        <img class="w-100 h-100" src="<?= base_url(); ?>fotobarang/default-placeholder.jpg" alt="Image">
                    </div>
                <?php endif; ?>
            </div>
        </div>

        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3><?= $barang['judul_barang']; ?></h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <?php
                        // Total rating berdasarkan data dari controller
                        $rating_value = isset($rating) ? $rating : 0;

                        // Menampilkan bintang penuh, setengah, dan kosong
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= floor($rating_value)) {
                                // Bintang penuh
                                echo '<small class="fas fa-star"></small>';
                            } elseif ($i == ceil($rating_value) && $rating_value - floor($rating_value) > 0) {
                                // Bintang setengah
                                echo '<small class="fas fa-star-half-alt"></small>';
                            } else {
                                // Bintang kosong
                                echo '<small class="far fa-star"></small>';
                            }
                        }
                        ?>
                    </div>
                    <small class="pt-1">(<?= $totalReview; ?> Reviews)</small>
                </div>

                <style>
                    /* Gaya untuk tombol kotak */
                    .btn-outline-primary {
                        border: 1px solid rgba(0, 0, 0, .09);
                        background-color: white;
                        color: rgba(0, 0, 0, .8);
                        font-weight: 100;
                        padding: 10px 20px;
                        cursor: pointer;
                        margin-right: 10px;
                    }

                    /* Gaya radio button yang dipilih (aktif) */
                    .btn-outline-primary.active {
                        background-color: #007bff;
                        color: white;
                    }

                    /* Menyembunyikan elemen radio button asli */
                    .pilihan-variasi {
                        display: none;
                    }

                    /* Container untuk radio button agar tampil horizontal */
                    .variasi-buttons {
                        display: flex;
                        flex-wrap: nowrap;
                        gap: 10px;
                    }

                    /* Diskon label styling */
                    .diskon-label {
                        position: absolute;
                        top: 10px;
                        right: 10px;
                        background-color: red;
                        color: white;
                        padding: 5px 10px;
                        font-size: 16px;
                        font-weight: bold;
                        border-radius: 5px;
                    }

                    .harga-coret {
                        text-decoration: line-through;
                        color: #888;
                        margin-right: 10px;
                    }
                </style>


            <form id="variasiForm" method="POST" action="<?= base_url(); ?>add_chart">
                <input type="hidden" id="harga_barang_awal" name="harga_barang_awal" value="<?= $barang['harga_barang']; ?>">
                <input type="hidden" id="jumlah_barang" name="jumlah_barang" value="<?= $barang['jumlah_barang']; ?>">
                <input type="hidden" id="harga_barang" name="harga_barang" value="<?= $barang['harga_barang']; ?>">

                <input type="hidden" name="judul_barang" value="<?= $barang['judul_barang']; ?>">
                <input type="hidden" name="id" value="<?= $barang['id']; ?>">
                <input type="hidden" name="id_barang" value="<?= $barang['id']; ?>">
                <input type="hidden" name="foto_barang" value="<?= $barang['foto_barang']; ?>">
                <input type="hidden" name="id_user" value="<?= session()->get('id'); ?>">

                <div style="display: flex; align-items: center; position: relative;">
                    <?php if (isset($barang['diskon']) && $barang['diskon'] > 0): ?>
                        <div class="diskon-label">
                            <?= $barang['diskon']; ?>% OFF
                        </div>
                    <?php endif; ?>
                    
                    <h3 id="harga_barang_text" class="font-weight-semi-bold mb-4" style="margin-right: 10px;">
                        <?php if (isset($barang['diskon']) && $barang['diskon'] > 0): ?>
                            <span class="harga-coret">Rp. <?= number_format($barang['harga_barang'], 0, ',', '.'); ?></span>
                            Rp. <?= number_format($barang['harga_barang'] * (1 - $barang['diskon'] / 100), 0, ',', '.'); ?>
                        <?php else: ?>
                            Rp. <?= number_format($barang['harga_barang'], 0, ',', '.'); ?>
                        <?php endif; ?>
                    </h3>
                </div>

                <div style="display: flex; align-items: center;">
                    <h7 id="jumlah_barang_text" class="font-weight-semi-bold mb-4" style="margin-right: 10px;">Stok: <?= $barang['jumlah_barang']; ?></h7>
                </div>

                <!-- Bagian Variasi -->
                <?php if (!empty($variasi)): ?>
                    <input type="hidden" name="has_variasi" value="1"> <!-- Menandakan bahwa produk memiliki variasi -->
                    <strong class="mt-4 d-block">Variasi: </strong>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <?php foreach ($variasi as $vsi) : ?>
                            <div class="d-flex mb-3">
                                <div class="variasi-buttons">
                                    <input type="radio" value="<?= $vsi['variasi_nama']; ?>" class="pilihan-variasi" name="variasi" id="radio-<?= $vsi['variasi_nama']; ?>">
                                    <label for="radio-<?= $vsi['variasi_nama']; ?>" class="btn btn-outline-primary"><?= $vsi['variasi_nama']; ?></label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>


                <!-- Quantity Input -->
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary border-0 text-center" value="1" name="jumlah">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Add To Cart Button -->
                    <button type="submit" name="action" value="cart" formaction="<?= base_url(); ?>add_chart" class="btn btn-primary px-3">
                        <i class="fa fa-shopping-cart mr-1"></i> Add To Cart
                    </button>

                    <!-- Add To Wishlist Button -->
                    <button type="submit" name="action" value="wishlist" formaction="<?= base_url('user/add_to_wishlist/' . $barang['id']); ?>" class="btn btn-warning px-3 ml-2">
                        <i class="fa fa-heart mr-1"></i> Add To Wishlist
                    </button>
                </div>
            </form>

            </div>

            <div class="d-flex pt-2">
                <strong class="text-dark mr-2">Share on:</strong>
                <div class="d-inline-flex">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-pinterest"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>


<div class="row px-xl-5">
    <div class="col">
        <div class="bg-light p-30">
            
            <p><strong>Nama Toko:</strong> <?= esc($pemilik_barang['nama_toko']) ?></p>
            <p><strong>Alamat Toko:</strong> 
                <?= esc($barang['alamat_user']) ?>,
                <?= esc($barang['alamat_toko']['kelurahan']) ?>, 
                <?= esc($barang['alamat_toko']['kecamatan']) ?>, 
                <?= esc($barang['alamat_toko']['kabupaten']) ?>, 
                <?= esc($barang['alamat_toko']['provinsi']) ?>
            </p>

            <div class="nav nav-tabs mb-4">
                <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews (<?= $totalReview; ?>)</a>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <h4 class="mb-3">Product Description</h4>
                    <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"><?= $barang['deskripsi_barang']; ?></div>
                </div>
                <div class="tab-pane fade" id="tab-pane-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4"><?= $totalReview; ?> review for "<?= $barang['judul_barang']; ?>"</h4>

                            <!-- Container for reviews -->

                            <div id="reviews-container">
                                <?php foreach ($dataRating as $key => $value): ?>

                                    <div class="review-item">
                                        <div class="media mb-4">
                                            <div class="media-body">
                                                <h6><?= $value->nama; ?><small> - <i><?= date('d M Y', strtotime($value->created_at)); ?></i></small></h6>
                                                <div class="text-primary mb-2">
                                                    <?php
                                                    $rating_value = isset($value->rating) ? $value->rating : 0;
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        if ($i <= floor($rating_value)) {
                                                            echo '<small class="fas fa-star"></small>';
                                                        } elseif ($i == ceil($rating_value) && $rating_value - floor($rating_value) > 0) {
                                                            echo '<small class="fas fa-star-half-alt"></small>';
                                                        } else {
                                                            echo '<small class="far fa-star"></small>';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <p><?= $value->comment; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                            <?php if (empty($dataRating)): ?>
                                <p>No reviews yet. Be the first to review this product!</p>
                            <?php else: ?>
                                <!-- Pagination Controls -->
                                <div id="pagination-controls" class="d-flex justify-content-center mt-4">
                                    <button class="btn btn-primary" onclick="changePage('prev')">Previous</button>
                                    <span id="current-page">1</span> / <span id="total-pages"><?= ceil(count($dataRating) / 5); ?></span>
                                    <button class="btn btn-primary" onclick="changePage('next')">Next</button>
                                </div>
                            <?php endif ?>
                        </div>

                        <div class="col-md-6">
                            <h4 class="mb-4">Leave a review</h4>
                            <small>Your email address will not be published. Required fields are marked *</small>
                            <div class="d-flex my-3">
                                <p class="mb-0 mr-2">Your Rating * :</p>
                                <div class="text-primary rating-stars">
                                    <i class="far fa-star" data-value="1"></i>
                                    <i class="far fa-star" data-value="2"></i>
                                    <i class="far fa-star" data-value="3"></i>
                                    <i class="far fa-star" data-value="4"></i>
                                    <i class="far fa-star" data-value="5"></i>
                                </div>
                            </div>

                            <!-- Hidden input to store the rating value -->

                            <form action="<?= base_url('user/review/' . $barang['id']); ?>" method="POST">
                                <input type="hidden" name="rating" id="rating-value" value="0">
                                <div class="form-group">
                                    <label for="message">Your Review *</label>
                                    <textarea id="message" cols="30" rows="5" class="form-control" name="comment"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Your Name *</label>
                                    <input type="text" class="form-control" id="nama" name="nama">
                                </div>
                                <div class="form-group">
                                    <label for="email">Your Email *</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group mb-0">
                                    <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Shop Detail End -->

  <?= $this->endSection(); ?>

  <?= $this->section('scripts'); ?>

                          <script>
                            let currentPage = 1;
                            const reviewsPerPage = 5;
                            const totalReviews = <?= count($dataRating); ?>;
                            const totalPages = Math.ceil(totalReviews / reviewsPerPage);
                            const reviewsContainer = document.getElementById('reviews-container');
                            const currentPageElement = document.getElementById('current-page');
                            const totalPagesElement = document.getElementById('total-pages');

                            function showReviews() {
                                const start = (currentPage - 1) * reviewsPerPage;
                                const end = currentPage * reviewsPerPage;
                                const reviews = <?= json_encode($dataRating); ?>;

                                reviewsContainer.innerHTML = '';

                                reviews.slice(start, end).forEach(review => {
                                    const reviewHTML = `
                                <div class="review-item">
                                    <div class="media mb-4">
                                        <div class="media-body">
                                            <h6>${review.nama} <small> - <i>${new Date(review.created_at).toLocaleDateString()}</i></small></h6>
                                            <div class="text-primary mb-2">
                                                ${getStars(review.rating)}
                                            </div>
                                            <p>${review.comment}</p>
                                        </div>
                                    </div>
                                </div>
                                `;
                                    reviewsContainer.innerHTML += reviewHTML;
                                });

                                // Update pagination controls
                                currentPageElement.textContent = currentPage;
                            }

                            // Function to generate star rating HTML
                            function getStars(rating) {
                                let starsHTML = '';
                                for (let i = 1; i <= 5; i++) {
                                    if (i <= Math.floor(rating)) {
                                        starsHTML += '<small class="fas fa-star"></small>';
                                    } else if (i === Math.ceil(rating) && rating - Math.floor(rating) > 0) {
                                        starsHTML += '<small class="fas fa-star-half-alt"></small>';
                                    } else {
                                        starsHTML += '<small class="far fa-star"></small>';
                                    }
                                }
                                return starsHTML;
                            }

                            // Function to change page
                            function changePage(direction) {
                                if (direction === 'prev' && currentPage > 1) {
                                    currentPage--;
                                } else if (direction === 'next' && currentPage < totalPages) {
                                    currentPage++;
                                }

                                // Show reviews for the current page
                                showReviews();
                            }

                            // Initialize page
                            showReviews();
                        </script>
                <script>
                    $(document).ready(function() {
                    $('input[type=radio]').change(function() {
                        var formData = $('#variasiForm').serialize();
                        console.log(formData); // Ambil data form dalam bentuk serialized
                        $.ajax({
                            type: 'POST',
                            url: '<?= base_url('user/harga_barang'); ?>', // Ganti dengan URL ke fungsi controller
                            data: formData,
                            dataType: 'json',
                            success: function(response) {
                                $('#harga_barang').val(response.harga);
                                // Update hidden input dengan harga baru
                                $('#harga_barang_text').text(new Intl.NumberFormat('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                }).format(response.harga).replace('IDR', '').trim());
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    });
                });
                </script> 
                 <script>  
                    document.querySelectorAll('.pilihan-variasi').forEach(radio => {
                        radio.addEventListener('change', function() {
                            // Mendapatkan nilai dan nama dari pilihan yang dipilih
                            const value = this.getAttribute('data-value');
                            const name = this.getAttribute('data-variasi');

                            // Menemukan semua radio button dalam grup variasi yang sama (dengan name yang sama)
                            const groupRadios = document.querySelectorAll(`[name="variasi"]`);

                            // Menghapus class aktif dari semua label dalam grup ini
                            groupRadios.forEach(radio => {
                                const label = radio.nextElementSibling; // Menemukan label terkait dengan radio button
                                label.classList.remove('active'); // Menghapus kelas aktif
                            });

                            // Menambahkan class aktif pada label radio button yang dipilih
                            this.nextElementSibling.classList.add('active'); // Menambahkan kelas aktif pada label yang dipilih

                            // Mengatur nilai pilihan yang dipilih ke dalam input tersembunyi
                            const hiddenInput = document.querySelector(`input[name="${name}"]`);
                            if (hiddenInput) {
                                hiddenInput.value = value;
                            }
                        });
                    });
                </script>

                        <script>
                            // JavaScript for handling the rating system
                            const stars = document.querySelectorAll('.rating-stars i');
                            const ratingValue = document.getElementById('rating-value');

                            stars.forEach(star => {
                                star.addEventListener('click', function() {
                                    const rating = this.getAttribute('data-value');
                                    ratingValue.value = rating;

                                    // Update the appearance of the stars based on the clicked value
                                    stars.forEach(s => {
                                        if (s.getAttribute('data-value') <= rating) {
                                            s.classList.remove('far'); // Non-filled star
                                            s.classList.add('fas'); // Filled star
                                        } else {
                                            s.classList.remove('fas');
                                            s.classList.add('far');
                                        }
                                    });
                                });
                            });
                        </script>

  <?= $this->endSection(); ?>