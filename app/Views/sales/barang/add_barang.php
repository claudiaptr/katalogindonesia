<?= $this->extend('sales/layout'); ?>
<?= $this->section('link'); ?>
<link rel="stylesheet" href="<?= base_url(); ?>sales/plugins/select2/select2.min.css">
<?= $this->endSection() ?>
<?= $this->section('home'); ?>
<?php if (session()->has('validation')) : ?>
    <?php $validation = session('validation'); ?>

<?php endif; ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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

    <!-- Main content -->
    <section class="content">
        <form role="form" id="demoform" method="post" enctype="multipart/form-data" action="<?= base_url('sales/store_barang'); ?>">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Form Tambah Barang</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">

                            <!-- text input -->
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
                                <input type="number" class="form-control" name="harga_barang" placeholder="Enter Harga Barang">
                                <?php if ($validation->hasError('harga_barang')) : ?>
                                    <label id="harga_barang-error" class="error invalid-feedback" for="harga_barang"><?= $validation->getError('harga_barang'); ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6 <?= ($validation->hasError('jumlah_barang')) ? 'has-error' : ''; ?>">
                                <label>Jumlah Barang</label>
                                <input required type="number" class="form-control" name="jumlah_barang" placeholder="Enter Judul Barang">
                                <?php if ($validation->hasError('jumlah_barang')) : ?>
                                    <label id="jumlah_barang-error" class="error invalid-feedback" for="jumlah_barang"><?= $validation->getError('jumlah_barang'); ?></label>
                                <?php endif; ?>
                            </div>
                            <!-- tambahkan input lainnya -->


                            <!-- textarea -->
                            <div class="form-group col-md-12 <?= ($validation->hasError('deskripsi_barang')) ? 'has-error' : ''; ?>">
                                <label>Deskripsi Barang</label>
                                <textarea class="form-control" name="deskripsi_barang" rows="3" placeholder="Enter Judul Barang"></textarea>
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
<script src="<?= base_url(); ?>sales/plugins/select2/select2.full.min.js"></script>
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
<!-- <script>
    $(function() {
        $('#demoform').validate({
            rules: {
                judul_barang: {
                    required: true,
                },
                id_kategori_barang: {
                    required: true,
                },
                id_sub_kategori_barang: {
                    required: true,
                },
                foto_barang: {
                    required: true,
                    accept: "image/*"
                },
                harga_barang: {
                    required: true,
                    numeric: true,
                },
                jumlah_barang: {
                    required: true,
                    numeric: true,
                },
                deskripsi_barang: {
                    required: true,
                },
            },
            messages: {
                foto_barang: {
                    accept: "Only image files are allowed."
                },
                id_kategori: {
                    required: "Please select judul kategori",
                },
            },
            rElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
                error.appendTo(element.parent());
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },

            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script> -->
<?= $this->endSection() ?>