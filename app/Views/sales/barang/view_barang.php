<?= $this->extend('sales/layout'); ?>
<?= $this->section('home'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Tables
            <small>advanced tables</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="<?= base_url(); ?>sales/add_barang" class="btn btn-primary">Tambah Barang</a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Foto Barang</th>
                                    <th>Judul barang</th>
                                    <th>Kategori Barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($barang as $bk) : ?>
                                    <tr>
                                        <td><img width="70px" src="<?= base_url(); ?>barang/<?= $bk['foto_barang']; ?>" alt=""></td>
                                        <td><?= $bk['judul_barang']; ?></td>
                                        <td><?= $bk['id_kategori_barang']; ?></td>
                                        <td><?= $bk['jumlah_barang']; ?></td>
                                        <td style="display: flex;">
                                            <a style=" margin-left: 10px;" href="<?= base_url(); ?>sales/edit_barang/<?= $bk['id']; ?>" class="btn btn-primary mr-3">Edit </a>
                                            <a style=" margin-left: 10px;" href="<?= base_url(); ?>sales/view_tambah_variasi/<?= $bk['id']; ?>" class="btn btn-success mr-3"> Variasi</a>
                                            <form  style=" margin-left: 10px;" action="<?= base_url(); ?>/sales/delete_barang/<?= $bk['id']; ?>" method="post">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger ">Hapus </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url(); ?>sales/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>sales/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
    $(function() {
        $("#example1").DataTable();
    });
</script>
<?= $this->endSection() ?>