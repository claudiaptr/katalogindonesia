<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Pendaftaran Penjual</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>asset/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url(); ?>asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>asset/dists/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href=""><b>Daftar </b>Penjual</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <?php $errors = session()->getFlashdata('errors') ?>
                <?php if (!empty($errors)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            <?php foreach ($errors as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>

                <?php
                if (session()->getFlashdata('pesan')) {
                    echo '<div class="alert alert-success" role="alert">';
                    echo session()->getFlashdata('pesan');
                    echo '</div>';
                }
                ?>

                <form action="<?= base_url(); ?>/store/penjual" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <!-- Nama Toko -->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nama Toko" name="nama_toko" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-store"></span>
                            </div>
                        </div>
                    </div>

                    <!-- No HP -->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="No HP" name="no_hp" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal Daftar (Auto-filled) -->
                    <input type="hidden" name="tanggal_daftar" value="<?= date('Y-m-d'); ?>">

                    <!-- Provinsi -->
                    <div class="input-group mb-3">
                        <select id="provinsi" name="provinsi" class="form-control" required>
                            <option value="">Pilih Provinsi</option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-map-pin"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Kabupaten -->
                    <div class="input-group mb-3">
                        <select id="kabupaten" name="kabupaten" class="form-control" required>
                            <option value="">Pilih Kabupaten</option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-map-pin"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Kecamatan -->
                    <div class="input-group mb-3">
                        <select id="kecamatan" name="kecamatan" class="form-control" required>
                            <option value="">Pilih Kecamatan</option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-map-pin"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Kelurahan/Desa -->
                    <div class="input-group mb-3">
                        <select id="kelurahan" name="kelurahan" class="form-control" required>
                            <option value="">Pilih Kelurahan/Desa</option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-map-pin"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat Domisili -->
                    <div class="input-group mb-3">
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat Lengkap Toko">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-map-pin"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Foto Kartu Identitas -->
                    <div class="input-group mb-3">
                        <input type="file" name="foto_profil" class="form-control" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-id-card"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="row">
                        <div class="col-8"></div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?= base_url(); ?>asset/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>asset/dists/js/adminlte.min.js"></script>

    <!-- Script Wilayah Indonesia -->
    <script>
        // Mengisi dropdown provinsi
        fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json`)
            .then(response => response.json())
            .then(provinces => {
                let options = '<option value="">Pilih Provinsi</option>';
                provinces.forEach(element => {
                    options += `<option data-reg="${element.id}" value="${element.id}">${element.name}</option>`;
                });
                document.getElementById('provinsi').innerHTML = options;
            });

        // Event listener untuk provinsi
        document.getElementById('provinsi').addEventListener('change', (e) => {
            const provinsiId = e.target.value; // Mengambil ID provinsi
            if (!provinsiId) return; // Menghentikan jika tidak ada ID

            fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${provinsiId}.json`)
                .then(response => response.json())
                .then(regencies => {
                    let options = '<option value="">Pilih Kabupaten</option>';
                    document.getElementById('kecamatan').innerHTML = '<option value="">Pilih Kecamatan</option>';
                    document.getElementById('kelurahan').innerHTML = '<option value="">Pilih Kelurahan</option>';

                    regencies.forEach(element => {
                        options += `<option data-dist="${element.id}" value="${element.id}">${element.name}</option>`;
                    });
                    document.getElementById('kabupaten').innerHTML = options;
                })
                .catch(error => console.error('Error fetching regencies:', error));
        });

        // Event listener untuk kabupaten
        document.getElementById('kabupaten').addEventListener('change', (e) => {
            const kabupatenId = e.target.value; // Mengambil ID kabupaten
            if (!kabupatenId) return; // Menghentikan jika tidak ada ID

            fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${kabupatenId}.json`)
                .then(response => response.json())
                .then(districts => {
                    let options = '<option value="">Pilih Kecamatan</option>';
                    document.getElementById('kelurahan').innerHTML = '<option value="">Pilih Kelurahan</option>';

                    districts.forEach(element => {
                        options += `<option data-vill="${element.id}" value="${element.id}">${element.name}</option>`;
                    });
                    document.getElementById('kecamatan').innerHTML = options;
                })
                .catch(error => console.error('Error fetching districts:', error));
        });

        // Event listener untuk kecamatan
        document.getElementById('kecamatan').addEventListener('change', (e) => {
            const kecamatanId = e.target.value; // Mengambil ID kecamatan
            if (!kecamatanId) return; // Menghentikan jika tidak ada ID

            fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${kecamatanId}.json`)
                .then(response => response.json())
                .then(villages => {
                    let options = '<option value="">Pilih Kelurahan</option>';

                    villages.forEach(element => {
                        options += `<option value="${element.name}">${element.name}</option>`;
                    });
                    document.getElementById('kelurahan').innerHTML = options;
                })
                .catch(error => console.error('Error fetching villages:', error));
        });
    </script>
</body>

</html>
