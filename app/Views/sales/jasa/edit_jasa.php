<?= $this->extend('sales/layout'); ?>
<?= $this->section('link'); ?>
<link rel="stylesheet" href="<?= base_url(); ?>sales/plugins/select2/select2.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<?= $this->endSection() ?>
<?= $this->section('home'); ?>
<?php if (session()->has('validation')) : ?>
    <?php $validation = session('validation'); ?>

<?php endif; ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit jasa Katalog
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <form role="form" id="demoform" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>sales/update_jasa/<?= $jasa['id']; ?>">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Form Tambah jasa</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">

                            <!-- text input -->
                            <input type="hidden" name="pemilik" value="<?= session()->get('id'); ?>">
                            <div class="form-group col-md-6  <?= ($validation->hasError('judul_jasa')) ? 'has-error' : ''; ?>">
                                <label>Judul jasa</label>
                                <input value="<?= $jasa['judul_jasa']; ?>" type="text" class="form-control " name="judul_jasa" placeholder="Enter Judul jasa">
                                <?php if ($validation->hasError('judul_jasa')) : ?>
                                    <label id="judul_jasa-error" class="error invalid-feedback" for="judul_jasa"><?= $validation->getError('judul_jasa'); ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 <?= ($validation->hasError('id_kategori_jasa')) ? 'has-error' : ''; ?>">
                                <label>Kategori jasa</label>
                                <select class="form-control" name="id_kategori_jasa" id="id_kategori" data-placeholder="Select a Kategori jasa">
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($kategori as $kt) : ?>
                                        <option value="<?= $kt['id']; ?>" <?= $kt['id'] == $jasa['id_kategori_jasa'] ? 'selected' : ''; ?>>
                                            <?= $kt['nama_kategori']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if ($validation->hasError('id_kategori_jasa')) : ?>
                                    <label id="id_kategori_jasa-error" class="error invalid-feedback" for="id_kategori_jasa"><?= $validation->getError('id_kategori_jasa'); ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 <?= ($validation->hasError('id_sub_kategori_jasa')) ? 'has-error' : ''; ?>">
                                <label>Sub Kategori jasa</label>
                                <select class="form-control" name="id_sub_kategori_jasa" id="id_sub_kategori" data-placeholder="Select a Sub Kategori jasa">
                                    <option value="">Pilih Sub Kategori</option>
                                    <?php foreach ($sub_ketgori as $sub) : ?>
                                        <option value="<?= $sub['id']; ?>" <?= $sub['id'] == $jasa['id_sub_kategori_jasa'] ? 'selected' : ''; ?>>
                                            <?= $sub['nama_sub_kategori']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if ($validation->hasError('id_sub_kategori_jasa')) : ?>
                                    <label id="id_sub_kategori_jasa-error" class="error invalid-feedback" for="id_sub_kategori_jasa"><?= $validation->getError('id_sub_kategori_jasa'); ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 <?= ($validation->hasError('foto_jasa')) ? 'has-error' : ''; ?>">
                                <label>Foto jasa</label>
                                <input type="file" class="form-control" name="foto_jasa" placeholder="Enter Judul jasa" accept="image/*">
                                <input type="hidden" name="existing_foto_jasa" value="<?= $jasa['foto_jasa'] ?>">
                                <?php if ($validation->hasError('foto_jasa')) : ?>
                                    <label id="foto_jasa-error" class="error invalid-feedback" for="foto_jasa"><?= $validation->getError('foto_jasa'); ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 <?= ($validation->hasError('harga_jasa')) ? 'has-error' : ''; ?>">
                                <label>Harga jasa</label>
                                <input value="Rp <?= $jasa['harga_jasa']; ?>" type="text" class="form-control" name="harga_jasa" placeholder="Enter Harga jasa" id="harga-input" oninput="formatRupiah(this)">
                                <?php if ($validation->hasError('harga_jasa')) : ?>
                                    <label id="harga_jasa-error" class="error invalid-feedback" for="harga_jasa"><?= $validation->getError('harga_jasa'); ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 <?= ($validation->hasError('jumlah_jasa')) ? 'has-error' : ''; ?>">
                                <label>Jumlah jasa</label>
                                <input value="<?= $jasa['jumlah_jasa']; ?>" type="number" class="form-control" name="jumlah_jasa" placeholder="Enter Judul jasa">
                                <?php if ($validation->hasError('jumlah_jasa')) : ?>
                                    <label id="jumlah_jasa-error" class="error invalid-feedback" for="jumlah_jasa"><?= $validation->getError('jumlah_jasa'); ?></label>
                                <?php endif; ?>
                            </div>
                            <!-- tambahkan input lainnya -->


                            <!-- textarea -->
                            <div class="form-group col-md-12 <?= ($validation->hasError('deskripsi_jasa')) ? 'has-error' : ''; ?>">
                                <label>Deskripsi jasa</label>
                                <textarea class="form-control summernote" name="deskripsi_jasa" rows="3" placeholder="Enter Judul jasa"><?= $jasa['deskripsi_jasa']; ?></textarea>
                                <?php if ($validation->hasError('deskripsi_jasa')) : ?>
                                    <label id="deskripsi_jasa-error" class="error invalid-feedback" for="deskripsi_jasa"><?= $validation->getError('deskripsi_jasa'); ?></label>
                                <?php endif; ?>
                            </div>
                            <!-- /.box-header -->
                            <!-- tambahkan input foto lainnya -->

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->

            <!-- tambahkan input foto utama jasa -->

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
                                <?php foreach ($foto_detail as $fdt) : ?>
                                    <div style="margin-top: 10px;" class="row">
                                        <div class="col-lg-10">
                                            <div class="custom-file">
                                                <input type="file" accept="image/png, image/jpeg" class="custom-file-input" value="<?= $fdt['foto_jasa_lain']; ?>" name="foto_detail[]" id="foto_detail">
                                                <label class="custom-file-label" for="exampleInputFile"><?= $fdt['foto_jasa_lain']; ?></label>
                                            </div>
                                            <input type="hidden" name="foto_detail_id[]" value="<?= $fdt['id'] ?>">
                                        </div>
                                        <div class="col-lg-2">
                                            <a href="<?= base_url(); ?>sales/delete_foto_lain/<?= $fdt['id']; ?>" type="button" class="btn btn-danger delete"> Delete </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>

                            <!-- <div class="table table-striped files" id="previews">
                                <div id="template" class="row mt-2">
                                    <div class="col-auto">
                                        <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                                    </div>
                                    <div class="col d-flex align-items-center">
                                        <p class="mb-0">
                                            <span class="lead" data-dz-name></span>
                                            (<span data-dz-size></span>)
                                        </p>
                                        <strong class="error text-danger" data-dz-errormessage></strong>
                                    </div>
                                    <div class="col-4 d-flex align-items-center">
                                        <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                        </div>
                                    </div>
                                    <div class="col-auto d-flex align-items-center">
                                        <div class="btn-group">
                                            <button class="btn btn-primary start">
                                                <i class="fas fa-upload"></i>
                                                <span>Start</span>
                                            </button>
                                            <button data-dz-remove class="btn btn-warning cancel">
                                                <i class="fas fa-times-circle"></i>
                                                <span>Cancel</span>
                                            </button>
                                            <button data-dz-remove class="btn btn-danger delete">
                                                <i class="fas fa-trash"></i>
                                                <span>Delete</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
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
                                <?php foreach ($variasi as $vri) : ?>
                                    <div class="form-group col-md-12">
                                        <label>Nama Variasi</label>
                                        <input type="text" class="form-control" name="nama_variasi[]" value="<?= $vri['nama_variasi']; ?>" placeholder="Enter nama variasi">
                                        <input type="hidden" name="variasi_id[]" value="<?= $vri['id'] ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- <div class="table table-striped files" id="previews">
                                <div id="template" class="row mt-2">
                                    <div class="col-auto">
                                        <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                                    </div>
                                    <div class="col d-flex align-items-center">
                                        <p class="mb-0">
                                            <span class="lead" data-dz-name></span>
                                            (<span data-dz-size></span>)
                                        </p>
                                        <strong class="error text-danger" data-dz-errormessage></strong>
                                    </div>
                                    <div class="col-4 d-flex align-items-center">
                                        <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                        </div>
                                    </div>
                                    <div class="col-auto d-flex align-items-center">
                                        <div class="btn-group">
                                            <button class="btn btn-primary start">
                                                <i class="fas fa-upload"></i>
                                                <span>Start</span>
                                            </button>
                                            <button data-dz-remove class="btn btn-warning cancel">
                                                <i class="fas fa-times-circle"></i>
                                                <span>Cancel</span>
                                            </button>
                                            <button data-dz-remove class="btn btn-danger delete">
                                                <i class="fas fa-trash"></i>
                                                <span>Delete</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="box-footer">
                            <p class="">* Untuk Menambahkan Opsi klik enter </p>
                        </div>

                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->

                </div>

            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section><!-- /.content -->
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url(); ?>asset/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?= base_url(); ?>sales/plugins/select2/select2.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $(".select2").select2({
            tags: true
        });
    });
</script>
<script>
    $(".add-more").on("click", function() {
        var card =
            '<div style="margin-top: 10px;" class="row">' +
            '<div class="col-lg-10">' +
            '<div class="custom-file">' +
            '<input type="file" accept="image/png, image/jpeg" class="form-control-file"  name="foto_detail[]"  id="foto_detail">' +
            "</div>" +
            "</div>" +
            '<div class="col-lg-2">' +
            '<button type="button" class="btn btn-danger delete"> Delete </button>' +
            "</div>" +
            "</div>";
        $(".add-more-data").append(card);
    });


    $(".add-variasi").on("click", function() {
        // uniqueId++;
        var card =
            '<div class="form-group col-md-12">' +
            '<label>Nama Variasi</label>' +
            ' <input type="text" class="form-control" name="nama_variasi[]" placeholder="Enter nama variasi">' +
            '</div>';
        $(".add-more-variasi").append(card);
        $(".select2").select2({
            tags: true
        });
    });

    $(".add-more-data").delegate(".delete", "click", function() {
        $(this).parent().parent().remove();
    });
</script>
<script>
    $(document).ready(function() {
        $('#id_kategori').change(function(e) {
            var id_kategori = $('#id_kategori').val();
            $.ajax({
                type: 'POST',
                url: "<?= base_url('/sales/sub_kategori'); ?>",
                data: {
                    id_kategori: id_kategori
                },

                success: function(response) {
                    $("#id_sub_kategori").html(response);
                }
            })
        })
    })
</script>

<script>
    function formatRupiah(input) {
        let angka = input.value.replace(/[^,\d]/g, '').toString();
        let split = angka.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        input.value = 'Rp ' + rupiah;
    }

    document.getElementById('demoform').addEventListener('submit', function(e) {
        let input = document.getElementById('harga-input');
        input.value = input.value.replace(/[^,\d]/g, '').replace(',', '.');
    });
</script>
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

        // Tambah Foto jasa Lain
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