<?= $this->extend('user/layout'); ?>
<?= $this->section('content'); ?>
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Shop List</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="price-all">
                        <label class="custom-control-label" for="price-all">All Price</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-1">
                        <label class="custom-control-label" for="price-1">$0 - $100</label>
                        <span class="badge border font-weight-normal">150</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-2">
                        <label class="custom-control-label" for="price-2">$100 - $200</label>
                        <span class="badge border font-weight-normal">295</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-3">
                        <label class="custom-control-label" for="price-3">$200 - $300</label>
                        <span class="badge border font-weight-normal">246</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-4">
                        <label class="custom-control-label" for="price-4">$300 - $400</label>
                        <span class="badge border font-weight-normal">145</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="price-5">
                        <label class="custom-control-label" for="price-5">$400 - $500</label>
                        <span class="badge border font-weight-normal">168</span>
                    </div>
                </form>
            </div>
            <!-- Price End -->

            <!-- Color Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by color</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="color-all">
                        <label class="custom-control-label" for="price-all">All Color</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-1">
                        <label class="custom-control-label" for="color-1">Black</label>
                        <span class="badge border font-weight-normal">150</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-2">
                        <label class="custom-control-label" for="color-2">White</label>
                        <span class="badge border font-weight-normal">295</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-3">
                        <label class="custom-control-label" for="color-3">Red</label>
                        <span class="badge border font-weight-normal">246</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-4">
                        <label class="custom-control-label" for="color-4">Blue</label>
                        <span class="badge border font-weight-normal">145</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="color-5">
                        <label class="custom-control-label" for="color-5">Green</label>
                        <span class="badge border font-weight-normal">168</span>
                    </div>
                </form>
            </div>
            <!-- Color End -->

            <!-- Size Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by size</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="size-all">
                        <label class="custom-control-label" for="size-all">All Size</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="size-1">
                        <label class="custom-control-label" for="size-1">XS</label>
                        <span class="badge border font-weight-normal">150</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="size-2">
                        <label class="custom-control-label" for="size-2">S</label>
                        <span class="badge border font-weight-normal">295</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="size-3">
                        <label class="custom-control-label" for="size-3">M</label>
                        <span class="badge border font-weight-normal">246</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="size-4">
                        <label class="custom-control-label" for="size-4">L</label>
                        <span class="badge border font-weight-normal">145</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="size-5">
                        <label class="custom-control-label" for="size-5">XL</label>
                        <span class="badge border font-weight-normal">168</span>
                    </div>
                </form>
            </div>
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                            <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                <select id="provinsi" name="provinsi" class="form-control">
                                    <option value="">Pilih Provinsi</option>
                                    <option value="Jakarta">jakarta</option>
                                    <option value="Bali">Bali</option>
                                </select>
                            </div>
                            <div class="btn-group ml-2">
                                <select id="kabupaten" name="kabupaten" class="form-control">
                                    <option>Pilih kabupaten</option>
                                    <option value="Denpasar">Denpasar</option>
                                    <option value="Bali">Bali</option>
                                </select>
                            </div>
                            <div class="btn-group ml-2">
                                <select id="kecamatan" name="kecamatan" class="form-control">
                                    <option>Pilih kecamatan</option>
                                    <option value="Denpasar Barat">Denpasar Barat</option>
                                    <option value="Bali">Bali</option>
                                </select>
                            </div>
                            <div class="btn-group ml-2">
                                <select id="kelurahan" name="kelurahan" class="form-control">
                                    <option>Pilih kelurahan</option>
                                    <option value="Peguyangan">Peguyangan</option>
                                    <option value="Bali">Bali</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="barang-container" class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <?php foreach ($barang as $bk) : ?>
                        <div class="barang-item">
                            <div class="product-item bg-light mb-4">
                                <a href="<?= base_url(); ?>user/detail/<?= $bk['id']; ?>" class="d-block text-decoration-none">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="" style="object-fit: scale-down !important; width: 280px; height: 280px;" src="<?= base_url(); ?>barang/<?= $bk['foto_barang']; ?>" alt="">
                                    </div>
                                    <div class="text-center py-4 ">
                                        <p class="h6 text-decoration-none text-truncate"><?= $bk['judul_barang']; ?></p>
                                        <div class="justify-content-center mt-2">
                                            <h5 class="mb-0 ">Rp. <?= number_format($bk['harga_barang'], 0, ',', '.'); ?></h5>
                                        </div>
                                        <small style="color: darkgray;"><?= $bk['kabupaten']; ?></small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="col-12">
                    <nav>
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</span></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
   $(document).ready(function() {
    function loadBarang() {
        var provinsi = $('#provinsi').val() || null;
        var kabupaten = $('#kabupaten').val() || null;
        var kecamatan = $('#kecamatan').val() || null;
        var kelurahan = $('#kelurahan').val()|| null;
        $.ajax({
            url: '<?= base_url('user/filter'); ?>',
            type: 'POST',
            data: {
                provinsi: provinsi,
                kabupaten: kabupaten,
                kecamatan: kecamatan,
                kelurahan: kelurahan
            },
            success: function(response) {
                var html = '';
                if (response.length > 0) {
                    response.forEach(function(bk) {
                        html += '<div class="product-item bg-light mb-4">';
                        html += '    <a href="<?= base_url(); ?>user/detail/' + bk.id + '" class="d-block text-decoration-none">';
                        html += '        <div class="product-img position-relative overflow-hidden">';
                        html += '            <img class="" style="object-fit: scale-down !important; width: 280px; height: 280px;" src="<?= base_url(); ?>barang/' + bk.foto_barang + '" alt="">';
                        html += '        </div>';
                        html += '        <div class="text-center py-4 ">';
                        html += '            <p class="h6 text-decoration-none text-truncate">' + bk.judul_barang + '</p>';
                        html += '            <div class="justify-content-center mt-2">';
                        html += '                <h5 class="mb-0 ">Rp. ' + parseInt(bk.harga_barang).toLocaleString('id-ID') + '</h5>';
                        html += '            </div>';
                        html += '            <small style="color: darkgray;">' + bk.kabupaten + '</small>';
                        html += '        </div>';
                        html += '    </a>';
                        html += '</div>';
                    });
                } else {
                    html = '<p>Tidak ada barang yang ditemukan.</p>';
                }
                $('#barang-container').html(html);
            }
        });
    }

    $('#provinsi, #kabupaten, #kecamatan, #kelurahan').on('change', function() {
        loadBarang();
    });

    
});
</script>
<?= $this->endSection(); ?>