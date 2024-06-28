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
                                    <th>Foto Barang</th>
                                    <th>Judul Barang</th>
                                    <th>Kategori Barang</th>
                                    <th>Sub Ketegori Barang</th>
                                    <th>Varifikasi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($barang as $bk) : ?>
                                    <tr class="text-center">
                                        <td><img width="70px" src="<?= base_url(); ?>barang/<?= $bk['foto_barang']; ?>" alt=""></td>
                                        <td><?= $bk['judul_barang']; ?></td>
                                        <td><?= $bk['kategori_name']; ?></td>
                                        <td><?= $bk['sub_kategori_name']; ?></td>
                                        <td>
                                            <?php if ($bk['verifikasi'] == 1) : ?>
                                                <span class="btn btn-warning">Pending</span>
                                            <?php elseif ($bk['verifikasi'] == 2) : ?>
                                                <span class="btn btn-danger">Ditolak</span>
                                            <?php elseif ($bk['verifikasi'] == 3) : ?>
                                                <span class="btn btn-success">Diterima</span>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="<?= base_url(); ?>admin/detail_barang/<?= $bk['id']; ?>" class="btn btn-primary mr-3">Detail Data</a>
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