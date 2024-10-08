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
                        <a href="<?= base_url(); ?>sales/add_jasa" class="btn btn-primary">Tambah jasa</a>
                       
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Foto jasa</th>
                                    <th>Judul jasa</th>
                                    <th>Kategori jasa</th>
                                    <th>Sub Katgori jasa</th>
                                    <th>Jumlah jasa</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($jasa as $bk) : ?>
                                    <tr>
                                        <td><img width="70px" src="<?= base_url(); ?>jasa/<?= $bk['foto_jasa']; ?>" alt=""></td>
                                        <td><?= $bk['judul_jasa']; ?></td>
                                        <td><?= $bk['kategori_name']; ?></td>
                                        <td><?= $bk['sub_kategori_name']; ?></td>
                                        <td><?= $bk['jumlah_jasa']; ?></td>
                                        <td>
                                            <?php if ($bk['verifikasi']==1) : ?>
                                                <span class="label label-warning">Pending</span>
                                            <?php elseif($bk['verifikasi']==2) : ?>
                                                <span class="label label-danger">Ditolak</span>
                                            <?php elseif($bk['verifikasi']==3) : ?>
                                                <span class="label label-success">Diterima</span>
                                            <?php endif ?>
                                        </td>
                                        <td style="display: flex;">
                                            <a style=" margin-left: 10px;" href="<?= base_url(); ?>sales/edit_jasa/<?= $bk['id']; ?>" class="btn btn-primary mr-3">Edit </a>
                                            <a style=" margin-left: 10px;" href="<?= base_url(); ?>sales/view_tambah_variasi/<?= $bk['id']; ?>" class="btn btn-success mr-3"> Variasi</a>
                                            <form class="delete" style=" margin-left: 10px;" action="<?= base_url(); ?>/sales/delete_jasa/<?= $bk['id']; ?>" method="post">
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