<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="d-flex mb-2 justify-content-between">
            <div class="">
                <h1 class="m-0">Tolak Verifikasi Barang</h1>
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
                                    <th>Nama Barang</th>
                                    <th>Nama Pembeli</th>
                                    <th>Jumlah Dibeli</th>
                                  
                                    <th>Total Harga Keseluruhan</th>
                                   
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($transaksi as $tr) : ?>
                                    <tr class="text-center">

                                        <td><?= $tr['judul_barang']; ?></td>
                                        <td><?= $tr['username']; ?></td>
                                        <td><?= $tr['jumlah']; ?></td>
                                        <td>Rp. <?= number_format($tr['total'], 0, ',', '.'); ?></td>
                                        <td>
                                            <?php if ($tr['verifikasi'] == 1) : ?>
                                                <span class="btn btn-warning">Pending</span>
                                            <?php elseif ($tr['verifikasi'] == 2) : ?>
                                                <span class="btn btn-danger">Ditolak</span>
                                            <?php elseif ($tr['verifikasi'] == 3) : ?>
                                                <span class="btn btn-success">Diterima</span>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="<?= base_url(); ?>admin/detail_pembayaran/<?= $tr['id']; ?>" class="btn btn-primary mr-3">Detail Data</a>
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