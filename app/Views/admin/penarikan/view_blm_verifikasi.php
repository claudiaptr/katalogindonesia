<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="d-flex mb-2 justify-content-between">
            <div class="">
                <h1 class="m-0">Verifikasi Penarikan</h1>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DataTable with default features</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Penarikan</th>
                                    <th>Username Bank</th>
                                    <th>Bank</th>
                                    <th>Jumlah Penarikan</th>
                                    <th>Saldo Saat Ini</th>
                                    <th>Rekening</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($penarikan as $prk) : ?>
                                    <tr class="text-center">
                                        <td><?= $prk['username']; ?></td>
                                        <td><?= $prk['username_bank']; ?></td>
                                        <td><?= $prk['bank']; ?></td>
                                        <td>Rp. <?= number_format($prk['jumlah_penarikan'], 0, ',', '.'); ?></td>
                                        <td>Rp. <?= number_format($prk['saldo'], 0, ',', '.'); ?></td>
                                        <td><?= $prk['nomor_rekening']; ?></td>
                                        <td>
                                            <?php if ($prk['verifikasi_penarikan'] == 1) : ?>
                                                <span class="btn btn-warning">Pending</span>
                                            <?php elseif ($prk['verifikasi_penarikan'] == 2) : ?>
                                                <span class="btn btn-danger">Ditolak</span>
                                            <?php elseif ($prk['verifikasi_penarikan'] == 3) : ?>
                                                <span class="btn btn-success">Diterima</span>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <?php if ($prk['verifikasi_penarikan'] == 3) : ?>
                                                    <a href="<?= base_url(); ?>admin/detail_penarikan/<?= $prk['id']; ?>" class="btn btn-secondary mr-3">Detail</a>
                                                    <a href="<?= base_url(); ?>admin/edit_verifikasi_penarikan/<?= $prk['id']; ?>" class="btn btn-primary mr-3">Edit</a>
                                                <?php elseif ($prk['verifikasi_penarikan'] == 1) : ?>
                                                    <a href="<?= base_url(); ?>admin/verifikasi_penarikan/<?= $prk['id']; ?>" class="btn btn-primary mr-3">Verifikasi</a>
                                                    <form class="delete" action="<?= base_url(); ?>admin/tolak_verifikasi_penarikan/<?= $prk['id']; ?>" method="post">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button class="btn btn-danger ">Tolak</button>
                                                    </form>
                                                <?php elseif ($prk['verifikasi_penarikan'] == 2) : ?>
                                                    <a href="<?= base_url(); ?>admin/detail_penarikan/<?= $prk['id']; ?>" class="btn btn-primary mr-3">Detail</a>
                                                <?php endif ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<?= $this->endSection(); ?>