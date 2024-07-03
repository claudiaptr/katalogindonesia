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
            Tambah Diskon Katalog


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
                            <h3 class="box-title">Form Tambah Diskon</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <!-- text input -->
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
                            <div class="form-group col-md-6 <?= ($validation->hasError('harga_barang')) ? 'has-error' : ''; ?>">
                                <label>Diskon Barang</label>
                                <input type="text" class="form-control" name="harga_barang" placeholder="Enter Diskon Barang" id="rupiah-input" oninput="formatRupiah(this)">
                                <?php if ($validation->hasError('harga_barang')) : ?>
                                    <label id="harga_barang-error" class="error invalid-feedback" for="harga_barang"><?= $validation->getError('harga_barang'); ?></label>
                                <?php endif; ?>
                            </div>

                            <!-- tambahkan input lainnya -->


                            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section><!-- /.content -->
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
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
            '<input  required type="file" accept="image/png, image/jpeg" class="form-control-file"  name="foto_detail[]"  id="foto_detail">' +
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
            '<div style="margin-top: 10px;" class="row">' +
            '<div class="form-group col-md-12">' +
            '<label>Nama Variasi</label>' +
            ' <input required type="text" class="form-control" name="nama_variasi[]" placeholder="Enter nama variasi">' +
            '</div>' +
            '<div class="col-lg-2">' +
            '<button type="button" class="btn btn-danger hapus"> Delete </button>' +
            "</div>" +
            "</div>";
        $(".add-more-variasi").append(card);
        $(".select2").select2({
            tags: true
        });
    });

    $(".add-more-data").delegate(".delete", "click", function() {
        $(this).parent().parent().remove();
    });

    $(".add-more-variasi").delegate(".hapus", "click", function() {
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
        let input = document.getElementById('rupiah-input');
        input.value = input.value.replace(/[^,\d]/g, '').replace(',', '.');
    });
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