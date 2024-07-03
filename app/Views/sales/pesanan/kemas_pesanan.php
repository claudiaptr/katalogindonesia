<?= $this->extend('sales/layout'); ?>
<?= $this->section('home'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Tables
            <small>Kemas Pesanan</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data Pesanan</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Foto Barang</th>
                                    <th>Judul barang</th>
                                    <th>Kategori Barang</th>
                                    <th>Sub Katgori Barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($barang as $bk) : ?>
                                    <tr>
                                        <td><img width="70px" src="<?= base_url(); ?>barang/<?= $bk['foto_barang']; ?>" alt=""></td>
                                        <td><?= $bk['judul_barang']; ?></td>
                                        <td><?= $bk['kategori_name']; ?></td>
                                        <td><?= $bk['sub_kategori_name']; ?></td>
                                        <td><?= $bk['jumlah_barang']; ?></td>
                                        <td>
                                            <!-- <?php if ($bk['verifikasi'] == 1) : ?>
                                                <span class="label label-warning">Pending</span>
                                            <?php elseif ($bk['verifikasi'] == 2) : ?>
                                                <span class="label label-danger">Ditolak</span>
                                            <?php elseif ($bk['verifikasi'] == 3) : ?>
                                                <span class="label label-success">Diterima</span>
                                            <?php endif ?> -->
                                            <a style="background-color: beige;" href="" class="btn btn-secondary mr-3">Sudah Bayar</a>
                                        </td>
                                        <td style="display: flex;">
                                            <!-- <a style=" margin-left: 10px;" href="<?= base_url(); ?>#" class="btn btn-primary mr-3">Kemas </a>
                                            <a style=" margin-left: 10px;" href="<?= base_url(); ?>#" class="btn btn-success mr-3"> Kirim </a> -->
                                            <form class="delete" style=" margin-left: 10px;" action="<?= base_url(); ?>#">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger ">Selesai </button>
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