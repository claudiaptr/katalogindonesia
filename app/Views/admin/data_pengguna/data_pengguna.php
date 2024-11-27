<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <h1 class="mb-4">Data Pengguna</h1>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success mb-4"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger mb-4"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-header bg-white text-dark">
            <h3 class="card-title">Data Pengguna</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['no_hp'] ?></td>
                            <td>
                                <?= $user['level'] == 1 ? 'Admin' : ($user['level'] == 2 ? 'Penjual' : 'Pembeli') ?>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/data_pengguna/edit/' . $user['id']) ?>" class="btn btn-primary btn-sm">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-4">
                <?= $pager->links() ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
