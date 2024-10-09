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
        <div class="col-lg-3 col-md-4 bg-light p-4">
            <!-- Categories Section -->
            <h5 class="text-uppercase mb-4">CATEGORIES</h5>
            <div class="categories">
                <?php foreach ($kategori as $kt) : ?>
                    <div class="category-item mb-2">
                        <a href="#" class="category-link"><?= $kt['kategori_nama'] ?></a>
                        <div class="subcategories">
                            <?php foreach ($kt['sub_kategori'] as $sk) : ?>
                                <a href="#" class="subcategory-link"><?= $sk['nama_sub_kategori'] ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <hr class="my-4">

            <!-- Location Filters -->
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Filter by Location</span>
            </h5>
            <div class="location-filters mb-4">
                <div class="form-group">
                    <select id="provinsi" name="provinsi" class="form-control" required>
                        <option value="">Pilih Provinsi</option>
                    </select>
                </div>
                <div class="form-group">
                    <select id="kabupaten" name="kabupaten" class="form-control" required>
                        <option value="">Pilih Kabupaten</option>
                    </select>
                </div>
                <div class="form-group">
                    <select id="kecamatan" name="kecamatan" class="form-control" required>
                        <option value="">Pilih Kecamatan</option>
                    </select>
                </div>
                <div class="form-group">
                    <select id="kelurahan" name="kelurahan" class="form-control" required>
                        <option value="">Pilih Kelurahan/Desa</option>
                    </select>
                </div>
            </div>

            <hr class="my-4">

            <!-- Filter by Price -->
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Batas Harga</span>
            </h5>
            <div class="bg-light p-3 mb-3">
                <form method="GET" action="/your-filter-action">
                    <div class="form-group d-flex justify-content-between align-items-center">
                        <input type="number" name="price_min" class="form-control mr-2" placeholder="Rp MIN" min="0">
                        <span>—</span>
                        <input type="number" name="price_max" class="form-control ml-2" placeholder="Rp MAKS" min="0">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-3">TERAPKAN</button>
                </form>
            </div>
            <!-- Filter by Price End -->
        </div>
        <!-- Sidebar End -->

        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <!-- Product Listing -->
                    <div id="barang-container" class="row">
                        <?php foreach ($barang as $bk) : ?>
                            <div class="col-md-3 mb-4">
                                <div class="product-item bg-light text-center p-3">
                                    <a href="<?= base_url('user/detail/' . $bk['id']); ?>" class="text-decoration-none">
                                        <img src="<?= base_url('barang/' . $bk['foto_barang']); ?>" 
                                             alt="<?= $bk['judul_barang']; ?>" 
                                             class="img-fluid" 
                                             onerror="this.src='path/to/default-image.png';" 
                                             style="width: 100%; height: 200px; object-fit: cover;">
                                        <div class="text-center py-2">
                                            <h6 class="text-truncate"><?= $bk['judul_barang']; ?></h6>
                                            <p class="mb-0">Rp. <?= number_format($bk['harga_barang'], 0, ',', '.'); ?></p>
                                            <small><?= $bk['id']; ?></small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="col-12">
                        <nav>
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
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
    const populateSelect = (selectId, options) => {
        const selectElement = document.getElementById(selectId);
        selectElement.innerHTML = '<option value="">Pilih</option>' + options.join('');
    };

    // Mengisi dropdown provinsi
    fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json`)
        .then(response => response.json())
        .then(provinces => {
            const options = provinces.map(element => `<option value="${element.id}">${element.name}</option>`);
            populateSelect('provinsi', options);
        })
        .catch(error => console.error('Error fetching provinces:', error));

    // Event listener untuk provinsi
    document.getElementById('provinsi').addEventListener('change', (e) => {
        const provinsiId = e.target.value;
        if (!provinsiId) return;

        fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${provinsiId}.json`)
            .then(response => response.json())
            .then(regencies => {
                const options = regencies.map(element => `<option value="${element.id}">${element.name}</option>`);
                populateSelect('kabupaten', options);
                populateSelect('kecamatan', []);
                populateSelect('kelurahan', []);
            })
            .catch(error => console.error('Error fetching regencies:', error));
    });

    // Event listener untuk kabupaten
    document.getElementById('kabupaten').addEventListener('change', (e) => {
        const kabupatenId = e.target.value;
        if (!kabupatenId) return;

        fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${kabupatenId}.json`)
            .then(response => response.json())
            .then(districts => {
                const options = districts.map(element => `<option value="${element.id}">${element.name}</option>`);
                populateSelect('kecamatan', options);
                populateSelect('kelurahan', []);
            })
            .catch(error => console.error('Error fetching districts:', error));
    });

    // Event listener untuk kecamatan
    document.getElementById('kecamatan').addEventListener('change', (e) => {
        const kecamatanId = e.target.value;
        if (!kecamatanId) return;

        fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${kecamatanId}.json`)
            .then(response => response.json())
            .then(villages => {
                const options = villages.map(element => `<option value="${element.id}">${element.name}</option>`);
                populateSelect('kelurahan', options);
            })
            .catch(error => console.error('Error fetching villages:', error));
    });
</script>
<?= $this->endSection(); ?>
