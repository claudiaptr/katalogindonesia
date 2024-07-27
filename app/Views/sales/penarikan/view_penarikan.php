<?= $this->extend('sales/layout'); ?>
<?= $this->section('home'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Data Penarikan
            
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data Penarikan</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="<?= base_url(); ?>sales/add_penarikan" class="btn btn-primary">Penarikan</a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Bank</th>
                                    <th>Jumlah Penarikan</th>
                                    <th>Tanggal Penarikan</th>
                                    <th>Status Penarikan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($penarikan as $pk) : ?>
                                    <tr>
                                        <td><?= $pk['bank']; ?></td>
                                        <td>Rp <?= number_format($pk['jumlah_penarikan'],0, ',', '.'); ?></td>
                                        <td><?= $pk['created_at']; ?></td>
                                        <td>
                                            <?php if ($pk['verifikasi_penarikan'] == 1) : ?>
                                                <span class="label label-warning">Pending</span>
                                            <?php elseif ($pk['verifikasi_penarikan'] == 2) : ?>
                                                <span class="label label-danger">Ditolak</span>
                                            <?php elseif ($pk['verifikasi_penarikan'] == 3) : ?>
                                                <span class="label label-success">Diterima</span>
                                            <?php endif ?>
                                        </td>
                                        <td style="display: flex;">
                                            <?php if ($pk['verifikasi_penarikan'] == 3) : ?>
                                                <a style=" margin-left: 10px;" href="<?= base_url(); ?>sales/foto_bukti/<?= $pk['id']; ?>" class="btn btn-primary mr-3">Foto Bukti </a>
                                            <?php else : ?>
                                                <a style=" margin-left: 10px;" href="" class="btn btn-default disabled mr-3">Foto Bukti</a>
                                            <?php endif ?>
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