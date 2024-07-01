<?= $this->extend('sales/layout'); ?>
<?= $this->section('link'); ?>
<link rel="stylesheet" href="<?= base_url(); ?>sales/plugins/select2/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css">
<?= $this->endSection() ?>

<?= $this->section('home'); ?>
<?php if (session()->has('validation')) : ?>
    <?php $validation = session('validation'); ?>
<?php endif; ?>

<div class="content-wrapper">
    <!-- Header Konten (Judul Halaman) -->
    <section class="content-header">
        <h1>
            Tambah Barang Katalog
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>

    <!-- Konten Utama -->
    <section class="content">
        <form role="form" id="demoform" method="post" enctype="multipart/form-data" action="<?= base_url('sales/store_barang'); ?>">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Form Tambah Barang</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <!-- input teks -->
                            <input type="hidden" name="pemilik" value="<?= session()->get('id'); ?>">
                            <div class="form-group col-md-6  <?= ($validation->hasError('judul_barang')) ? 'has-error' : ''; ?>">
                                <label>Judul Barang</label>
                                <input type="text" class="form-control " name="judul_barang" placeholder="Enter Judul Barang">
                                <?php if ($validation->hasError('judul_barang')) : ?>
                                    <label id="judul_barang-error" class="error invalid-feedback" for="judul_barang"><?= $validation->getError('judul_barang'); ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 <?= ($validation->hasError('id_kategori_barang')) ? 'has-error' : ''; ?>">
                                <label>Kategori Barang</label>
                                <select class="form-control" name="id_kategori_barang" id="id_kategori" data-placeholder="Select a Kategori Barang">
                                    <option value="">Pilih Barang</option>
                                    <?php foreach ($kategori as $kt) : ?>
                                        <option value="<?= $kt['id']; ?>"> <?= $kt['nama_kategori']; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if ($validation->hasError('id_kategori_barang')) : ?>
                                    <label id="id_kategori_barang-error" class="error invalid-feedback" for="id_kategori_barang"><?= $validation->getError('id_kategori_barang'); ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 <?= ($validation->hasError('id_sub_kategori_barang')) ? 'has-error' : ''; ?>">
                                <label>Sub Kategori Barang</label>
                                <select class="form-control" name="id_sub_kategori_barang" id="id_sub_kategori" data-placeholder="Select a Kategori Barang">
                                </select>
                                <?php if ($validation->hasError('id_sub_kategori_barang')) : ?>
                                    <label id="id_sub_kategori_barang-error" class="error invalid-feedback" for="id_sub_kategori_barang"><?= $validation->getError('id_sub_kategori_barang'); ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 <?= ($validation->hasError('foto_barang')) ? 'has-error' : ''; ?>">
                                <label>Foto Barang</label>
                                <input type="file" class="form-control" name="foto_barang" placeholder="Enter Judul Barang" accept="image/*">
                                <?php if ($validation->hasError('foto_barang')) : ?>
                                    <label id="foto_barang-error" class="error invalid-feedback" for="foto_barang"><?= $validation->getError('foto_barang'); ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 <?= ($validation->hasError('harga_barang')) ? 'has-error' : ''; ?>">
                                <label>Harga Barang</label>
                                <input type="text" class="form-control" name="harga_barang" placeholder="Enter Harga Barang" id="rupiah-input" oninput="formatRupiah(this)">
                                <?php if ($validation->hasError('harga_barang')) : ?>
                                    <label id="harga_barang-error" class="error invalid-feedback" for="harga_barang"><?= $validation->getError('harga_barang'); ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 <?= ($validation->hasError('jumlah_barang')) ? 'has-error' : ''; ?>">
                                <label>Jumlah Barang</label>
                                <input type="number" class="form-control" name="jumlah_barang" placeholder="Enter Judul Barang">
                                <?php if ($validation->hasError('jumlah_barang')) : ?>
                                    <label id="jumlah_barang-error" class="error invalid-feedback" for="jumlah_barang"><?= $validation->getError('jumlah_barang'); ?></label>
                                <?php endif; ?>
                            </div>
                            <!-- tambahkan input lainnya -->

                            <!-- textarea -->
                            <div class="form-group col-md-12 <?= ($validation->hasError('deskripsi_barang')) ? 'has-error' : ''; ?>">
                                <label>Deskripsi Barang</label>
                                <textarea class="form-control summernote" name="deskripsi_barang" rows="3" placeholder="Enter Deskripsi Barang"></textarea>
                                <?php if ($validation->hasError('deskripsi_barang')) : ?>
                                    <label id="deskripsi_barang-error" class="error invalid-feedback" for="deskripsi_barang"><?= $validation->getError('deskripsi_barang'); ?></label>
                                <?php endif; ?>
                            </div>
                            <!-- /.box-header -->
                            <!-- tambahkan input foto lainnya -->

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->

            <!-- tambahkan input foto utama barang -->

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title">Tambahkan Foto Lain </h3>
                        </div>
                        <div class="box-body">
                            <div id="actions" class="row">
                                <div class="col-lg-6">
                                    <div class="btn-group w-100">
                                        <span class="btn btn-success add-more col fileinput-button">
                                            <i class="fa fa-plus"></i>
                                            <span>Add files</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex align-items-center">
                                    <div class="fileupload-process w-100">
                                        <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-more-data">
                            </div>
                        </div>

                        <!-- /.card-body -->

                    </div>
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title">Tambahkan Variasi </h3>
                        </div>
                        <div class="box-body">
                            <div id="actions" class="row">
                                <div class="col-lg-6">
                                    <div class="btn-group w-100">
                                        <span class="btn btn-success add-variasi col fileinput-button">
                                            <i class="fa fa-plus"></i>
                                            <span>Add Variasi</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="add-more-variasi">
                            </div>
                        </div>
                        <div class="box-footer">
                            <p class="">* Untuk Menambahkan Opsi klik enter </p>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section><!-- /.content -->
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url(); ?>sales/plugins/select2/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
<script>
    $(function() {
        //Inisialisasi Select2
        $(".select2").select2({
            tags: true
        });

        //Inisialisasi Summernote
        $('.summernote').summernote({
            height: 150
        });

        // Tambah Foto Barang Lain
        $(".add-more").click(function() {
            var html = $(".add-more-data").html();
            $(".add-more-data").append(html);
        });
        $("body").on("click", ".remove", function() {
            $(this).parents(".control-group").remove();
        });

        // Tambah Variasi
        $(".add-variasi").click(function() {
            var html = $(".add-more-variasi").html();
            $(".add-more-variasi").append(html);
        });
        $("body").on("click", ".remove-variasi", function() {
            $(this).parents(".control-group").remove();
        });

    });
</script>
<?= $this->endSection() ?>