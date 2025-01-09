<?= $this->extend('user/layout'); ?>
<?= $this->section('content'); ?>


<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="<?= base_url(); ?>">Home</a>
                <a class="breadcrumb-item text-dark" href="<?= base_url('user/shop'); ?>">Shop</a>
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

            <!-- Location Filters -->
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Filter by Location</span>
            </h5>
            <div class="location-filters mb-4">
                <form method="get" action="<?php echo current_url(); ?>">
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
                    <button type="submit" class="btn btn-primary">Terapkan</button>
                </form>
            </div>

        </div>
        <!-- Sidebar End -->

            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <?php if (!empty($barang)): ?>
                        <?php foreach ($barang as $bk): ?>
                            <div class="col-md-3 mb-4">
                                <div class="product-item bg-light text-center p-3">
                                    <a href="<?= base_url('user/detail/' . $bk['id']); ?>" class="text-decoration-none">
                                        <img src="<?= base_url('barang/' . $bk['foto_barang']); ?>" alt="<?= $bk['judul_barang']; ?>" class="img-fluid" style="width: 100%; height: 200px; object-fit: cover;">
                                        <h6 class="text-truncate"><?= $bk['judul_barang']; ?></h6>
                                        <p class="mb-0">Rp. <?= number_format($bk['harga_barang'], 0, ',', '.'); ?></p>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Tidak ada produk yang ditemukan untuk kategori ini.</p>
                    <?php endif; ?>
                </div>
                </div>

            </div>    
        </div>
    </div>    
                            
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
    // Fetch provinsi
    fetch('https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json')
        .then(response => response.json())
        .then(provinces => {
            const options = provinces.map(element => `<option value="${element.id}" data-id="${element.id}">${element.name}</option>`);
            populateSelect('provinsi', options);
        })
        .catch(error => console.error('Error fetching provinces:', error));

    // Event listener untuk provinsi
    document.getElementById('provinsi').addEventListener('change', (e) => {
        const provinsiName = e.target.value;
        const provinsiId = e.target.options[e.target.selectedIndex].getAttribute('data-id');
        if (!provinsiName) return;

        fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${provinsiId}.json`)
            .then(response => response.json())
            .then(regencies => {
                const options = regencies.map(element => `<option value="${element.id}" data-id="${element.id}">${element.name}</option>`);
                populateSelect('kabupaten', options);
                populateSelect('kecamatan', []); // Kosongkan dropdown kecamatan
                populateSelect('kelurahan', []); // Kosongkan dropdown kelurahan
            })
            .catch(error => console.error('Error fetching regencies:', error));
    });

    // Event listener untuk kabupaten
    document.getElementById('kabupaten').addEventListener('change', (e) => {
        const kabupatenName = e.target.value;
        const kabupatenId = e.target.options[e.target.selectedIndex].getAttribute('data-id');
        if (!kabupatenName) return;

        fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${kabupatenId}.json`)
            .then(response => response.json())
            .then(districts => {
                const options = districts.map(element => `<option value="${element.id}" data-id="${element.id}">${element.name}</option>`);
                populateSelect('kecamatan', options);
                populateSelect('kelurahan', []); // Kosongkan dropdown kelurahan
            })
            .catch(error => console.error('Error fetching districts:', error));
    });

    // Event listener untuk kecamatan
    document.getElementById('kecamatan').addEventListener('change', (e) => {
        const kecamatanName = e.target.value;
        const kecamatanId = e.target.options[e.target.selectedIndex].getAttribute('data-id');
        if (!kecamatanName) return;

        fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${kecamatanId}.json`)
            .then(response => response.json())
            .then(villages => {
                const options = villages.map(element => `<option value="${element.name}" data-id="${element.id}">${element.name}</option>`);
                populateSelect('kelurahan', options);
            })
            .catch(error => console.error('Error fetching villages:', error));
    });

    // Kirim data filter ke server
    document.getElementById('applyFilter').addEventListener('click', function(e) {
        e.preventDefault(); // Mencegah form submit
        const provinsi = document.getElementById('provinsi').value;
        const kabupaten = document.getElementById('kabupaten').value;
        const kecamatan = document.getElementById('kecamatan').value;
        const kelurahan = document.getElementById('kelurahan').value;

        // Validasi input: pastikan pengguna memilih wilayah
        if (!provinsi && !kabupaten && !kecamatan && !kelurahan) {
            alert('Silakan pilih minimal satu wilayah untuk filter.');
            return;
        }

        // Kirim data ke server
        fetch('/barang/filterBarangByWilayah', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    provinsi: provinsi,
                    kabupaten: kabupaten,
                    kecamatan: kecamatan,
                    kelurahan: kelurahan,
                }),
            })
            .then((response) => response.json())
            .then((result) => {
                const barangContainer = document.getElementById('barang-container');
                barangContainer.innerHTML = ''; // Kosongkan kontainer sebelum update
                if (result.status === 'success') {
                    result.data.forEach((item) => {
                        const barangHTML = `
                        <div class="barang-item">
                            <h3>${item.judul_barang}</h3>
                            <img src="${item.foto_barang}" alt="${item.judul_barang}" onerror="this.src='default-image.png';">
                            <p>${item.deskripsi_barang}</p>
                            <p>Harga: ${item.harga_barang}</p>
                        </div>
                    `;
                        barangContainer.innerHTML += barangHTML;
                    });
                } else {
                    barangContainer.innerHTML = `<p>${result.message}</p>`;
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                const barangContainer = document.getElementById('barang-container');
                barangContainer.innerHTML = '<p>Terjadi kesalahan saat mengambil data. Silakan coba lagi nanti.</p>';
            });
    });

    document.querySelectorAll('.subcategory-link').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault(); // Mencegah reload halaman default
            const subCategoryName = e.target.textContent.trim();

            // Redirect ke halaman sesuai subkategori
            const url = `/user/shop/${encodeURIComponent(subCategoryName)}`;
            window.location.href = url;
        });
    });
</script>
<?= $this->endSection(); ?>