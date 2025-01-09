<?= $this->extend('user/layout'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid mt-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-2">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Hi, <?= session()->get('username') ?? 'Guest' ?></h5>
                    <img src="<?= base_url('uploads/profiles/' . ($user['foto_profil'] ?? 'default.jpg')) ?>"
                         alt="User Profile Picture"
                         style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;" />
                </div>
                <div class="list-group">
                    <a href="<?= base_url('/user/transaction-history') ?>" class="list-group-item list-group-item-action">Riwayat Transaksi</a>
                </div>
            </div>
        </div>

        <!-- Profile Form -->
        <div class="col-lg-7 col-md-8">
            <div class="card">
                <div class="card-header">
                    My Profile
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('pesan')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <p><?= esc($error) ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Profile Form -->
                    <form action="<?= base_url('/myaccount/update_profile') ?>" method="post" enctype="multipart/form-data">
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

                        <!-- Alamat -->
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea id="alamat" name="alamat" class="form-control" required><?= old('alamat', $user['alamat']) ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styling -->
<style>
    .container-fluid {
        font-family: 'Arial', sans-serif;
        color: #333;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        font-weight: bold;
        background-color: #ffc107;
        color: white;
        text-align: center;
        border-radius: 10px 10px 0 0;
    }

    .card-body {
        padding: 20px;
    }

    .list-group-item {
        font-weight: bold;
        color: #ffc107;
    }

    .list-group-item:hover {
        background-color: #f1f1f1;
    }

    .form-group label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-control {
        border-radius: 5px;
        border: 1px solid #ccc;
        padding: 10px;
    }

    .form-control:focus {
        border-color: #ffc107;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn-primary {
        border: none;
        color: white;
        font-weight: bold;
        padding: 10px 20px;
        border-radius: 25px;
        transition: background 0.3s;
    }

    .btn-primary:hover {
        background-color: #ffca2c;
    }

    @media (max-width: 768px) {
        .col-lg-2 {
            margin-bottom: 20px;
        }

        .card-header {
            font-size: 1.2rem;
        }
    }
</style>

<!-- Image Preview Script -->
<script>
    function previewUserImage() {
        const file = document.getElementById('foto_profil').files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('userImagePreview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
</script>

<?= $this->endSection(); ?>
