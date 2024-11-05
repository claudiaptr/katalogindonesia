<?= $this->extend('sales/layout'); ?>
<?= $this->section('home'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tambah Diskon
            <small>Menambahkan diskon untuk produk</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Diskon</a></li>
            <li class="active">Tambah Diskon</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Form Tambah Diskon</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <form action="<?= base_url('sales/save_diskon'); ?>" method="post">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <!-- Judul Barang -->
                                <div class="form-group col-md-6 <?= ($validation->hasError('id_barang')) ? 'has-error' : ''; ?>">
                                    <label>Judul Barang</label>
                                    <select class="form-control select2" name="id_barang" id="id_barang" data-placeholder="Pilih Judul Barang">
                                        <option value="">Pilih Barang</option>
                                        <?php foreach ($barang as $bk) : ?>
                                            <option value="<?= $bk['id']; ?>"><?= $bk['judul_barang']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="help-block"><?= $validation->getError('id_barang'); ?></span>
                                </div>

                                <!-- Diskon -->
                                <div class="form-group col-md-6 <?= ($validation->hasError('diskon')) ? 'has-error' : ''; ?>">
                                    <label>Diskon (%)</label>
                                    <input type="number" class="form-control" name="diskon" value="<?= old('diskon'); ?>" placeholder="Masukkan diskon" required>
                                    <span class="help-block"><?= $validation->getError('diskon'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan Diskon</button>
                                <a href="<?= base_url('sales/data_diskon'); ?>" class="btn btn-default">Kembali</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
<script>
    $(function() {
        $('.select2').select2();
    });
</script>
<?= $this->endSection() ?>
