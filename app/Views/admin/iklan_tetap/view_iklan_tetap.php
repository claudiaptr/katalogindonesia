<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="d-flex mb-2 justify-content-between">
            <div class="">
                <h1 class="m-0">Iklan Tetap</h1>
            </div><!-- /.col -->
            <div  class="">
                <a href="<?= base_url() ?>/admin/add_iklan_tetap" class="btn btn-primary"> Tambah Data </a>
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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th> Foto Iklan</th>
                                    <th>Judul Iklan</th>
                                    <th>Isi Iklan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($iklan as $ik) : ?>
                                    <tr class="text-center">
                                        <td><img width="120px" src="<?= base_url(); ?>img/<?= $ik['foto_iklan']; ?>" alt=""></td>
                                        <td><?= $ik['judul_iklan']; ?></td>
                                        <td><?= $ik['isi_iklan']; ?></td> 
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="<?= base_url(); ?>admin/edit_iklan_tetap/<?= $ik['slug']; ?>" class="btn btn-primary mr-3">Edit Data</a>
                                                <form class="delete" action="<?= base_url(); ?>admin/delete_iklan_tetap/<?= $ik['id']; ?>" method="post">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn btn-danger ">Hapus Data</button>
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