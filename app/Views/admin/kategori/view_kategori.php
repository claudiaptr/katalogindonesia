<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="d-flex mb-2 justify-content-between">
            <div class="">
                <h1 class="m-0">Kategori</h1>
            </div><!-- /.col -->
            <div class="">
                <a href="<?= base_url() ?>admin/add_kategori" class="btn btn-primary"> Tambah Data </a>
            </div>
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
                                    <th> Nama Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kategori as $kt) : ?>
                                    <tr class="text-center">

                                        <td><?= $kt['nama_kategori']; ?></td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="<?= base_url(); ?>/admin/edit_kategori/<?= $kt['slug']; ?>" class="btn btn-primary mr-3">Edit Data</a>
                                                <form class="delete" action="<?= base_url(); ?>admin/delete_kategori/<?= $kt['id']; ?>" method="post">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn btn-danger">Hapus Data</button>
                                                </form>
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