<?= $this->extend('sales/layout') ?>

<?= $this->section('home') ?>

<!-- Profil Penjual Section -->
<div id="profilePenjual" class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <h1>Profil Penjual</h1>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="col-lg-6 col-xs-12">
            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- Profile Form -->
            <<form action="<?= base_url('/sales/profilepenjual') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <!-- Foto Profil -->
    <div class="form-group text-center">
        <label for="foto_profil">Foto Profil</label>
        <div>
            <img id="userImagePreview" 
                 src="<?= base_url('uploads/profiles/' . ($user['foto_profil'] ?? 'default.jpg')) ?>" 
                 class="img-circle" 
                 alt="User Image" 
                 style="width: 160px; height: 160px; object-fit: cover; margin-bottom: 15px;">
        </div>
        <input type="file" id="foto_profil" name="foto_profil" class="form-control" accept="image/*" onchange="previewUserImage()">
        <input type="hidden" name="old_foto_profil" value="<?= $user['foto_profil'] ?>">
    </div>
    
    <!-- Username -->
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?= old('username', $user['username']) ?>" class="form-control" required>
    </div>

    <!-- Email -->
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= old('email', $user['email']) ?>" class="form-control" required>
    </div>

    <!-- No HP -->
    <div class="form-group">
        <label for="no_hp">Nomor HP</label>
        <input type="text" id="no_hp" name="no_hp" value="<?= old('no_hp', $user['no_hp']) ?>" class="form-control" required>
    </div>

    <!-- Nama Toko -->
    <div class="form-group">
        <label for="nama_toko">Nama Toko</label>
        <input type="text" id="nama_toko" name="nama_toko" value="<?= old('nama_toko', $user['nama_toko']) ?>" class="form-control" required>
    </div>

    <!-- Alamat -->
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat" class="form-control" required><?= old('alamat', $user['alamat']) ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>

        </div>
    </section>
</div>

<script>
    // Fungsi untuk menampilkan pratinjau gambar
    function previewUserImage() {
        const fileInput = document.getElementById('foto_profil');
        const preview = document.getElementById('userImagePreview');
        
        if (fileInput.files && fileInput.files[0]) {
            const file = fileInput.files[0];

            // Validasi ukuran file (1MB = 1024KB)
            if (file.size > 1024 * 1024) {
                alert('Ukuran file tidak boleh lebih dari 1MB.');
                fileInput.value = ''; // Reset input file
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>

<?= $this->endSection() ?>