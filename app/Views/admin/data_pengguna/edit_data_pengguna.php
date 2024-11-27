<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <h1 class="mb-4">Edit Data Pengguna</h1>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success mb-4"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger mb-4"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <!-- Form Edit Pengguna -->
    <div class="card shadow-sm">
        <div class="card-header bg-white text-dark">
            <h3 class="card-title">Form Edit Pengguna</h3>
        </div>
        <div class="card-body">
            <form method="post" action="<?= base_url('admin/data_pengguna/update') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= $user['id'] ?>">

                <!-- Username Field (Readonly) -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" readonly>
                </div>

                <!-- Email Field (Readonly) -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" readonly>
                </div>

                <!-- No HP Field (Readonly) -->
                <div class="form-group">
                    <label for="no_hp">No. HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $user['no_hp'] ?>" readonly>
                </div>

                <!-- Role Selection -->
                <div class="form-group">
                    <label for="level">Role</label>
                    <select class="form-control" id="level" name="level">
                        <option value="1" <?= $user['level'] == 1 ? 'selected' : '' ?>>Admin</option>
                        <option value="2" <?= $user['level'] == 2 ? 'selected' : '' ?>>Penjual</option>
                        <option value="3" <?= $user['level'] == 3 ? 'selected' : '' ?>>Pembeli</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary btn-block mt-3">Update</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
