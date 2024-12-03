<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <h2>Daftar Pengguna Belum Diverifikasi</h2>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('pesan') ?>
        </div>
    <?php endif; ?>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto Profil</th>
                <th>Nama Toko</th>
                <th>No HP</th>
                <th>Email</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $index => $user) : ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td>
                        <?php if (!empty($user['foto_profil'])): ?>
                            <img src="<?= base_url('public/' . $user['foto_profil']) ?>" alt="Foto Profil" width="50" height="50" class="img-thumbnail">
                        <?php else: ?>
                            <span>Tidak ada foto</span>
                        <?php endif; ?>
                    </td>
                    <td><?= esc($user['nama_toko']) ?></td>
                    <td><?= esc($user['no_hp']) ?></td>
                    <td><?= esc($user['email']) ?></td>
                    <td><?= esc($user['level'] == 3 ? 'Pendaftar' : 'Penjual') ?></td>
                    <td>
                        <?php if ($user['level'] == 3): ?>
                            <!-- Tombol Verifikasi -->
                            <a href="<?= site_url('admin/verifikasiPenjual/' . $user['id']) ?>" class="btn btn-success btn-sm">Verifikasi</a>
                            <!-- Tombol Tolak -->
                            <a href="<?= site_url('admin/tolakPenjual/' . $user['id']) ?>" class="btn btn-danger btn-sm">Tolak</a>
                        <?php else: ?>
                            <!-- Jika sudah diverifikasi, tidak ada tombol verifikasi atau tolak -->
                            <span class="badge bg-success">Sudah Diverifikasi</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>
