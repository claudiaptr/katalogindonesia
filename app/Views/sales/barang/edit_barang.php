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
            Edit Barang Katalog
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <form role="form" id="demoform" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>sales/update_barang/<?= $barang['id']; ?>">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Form Edit Barang</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">

                            <!-- text input -->
                            <input type="hidden" name="pemilik" value="<?= session()->get('id'); ?>">

                            <!-- Judul Barang -->
                            <div class="form-group col-md-6 <?= ($validation->hasError('judul_barang')) ? 'has-error' : ''; ?>">
                                <label>Judul Barang</label>
                                <input value="<?= $barang['judul_barang']; ?>" type="text" class="form-control " name="judul_barang" placeholder="Enter Judul Barang">
                                <?php if ($validation->hasError('judul_barang')) : ?>
                                    <label id="judul_barang-error" class="error invalid-feedback" for="judul_barang"><?= $validation->getError('judul_barang'); ?></label>
                                <?php endif; ?>
                            </div>

                            <!-- Kategori Barang -->
                            <div class="form-group col-md-6 <?= ($validation->hasError('id_kategori_barang')) ? 'has-error' : ''; ?>">
                                <label>Kategori Barang</label>
                                <select class="form-control" name="id_kategori_barang" id="id_kategori" data-placeholder="Select a Kategori Barang">
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($kategori as $kt) : ?>
                                        <option value="<?= $kt['id']; ?>" <?= $kt['id'] == $barang['id_kategori_barang'] ? 'selected' : ''; ?>>
                                            <?= $kt['nama_kategori']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if ($validation->hasError('id_kategori_barang')) : ?>
                                    <label id="id_kategori_barang-error" class="error invalid-feedback" for="id_kategori_barang"><?= $validation->getError('id_kategori_barang'); ?></label>
                                <?php endif; ?>
                            </div>

                            <!-- Sub Kategori Barang -->
                            <div class="form-group col-md-6 <?= ($validation->hasError('id_sub_kategori_barang')) ? 'has-error' : ''; ?>">
                                <label>Sub Kategori Barang</label>
                                <select class="form-control" name="id_sub_kategori_barang" id="id_sub_kategori" data-placeholder="Select a Sub Kategori Barang">
                                    <option value="">Pilih Sub Kategori</option>
                                    <?php foreach ($sub_ketgori as $sub) : ?>
                                        <option value="<?= $sub['id']; ?>" <?= $sub['id'] == $barang['id_sub_kategori_barang'] ? 'selected' : ''; ?>>
                                            <?= $sub['nama_sub_kategori']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if ($validation->hasError('id_sub_kategori_barang')) : ?>
                                    <label id="id_sub_kategori_barang-error" class="error invalid-feedback" for="id_sub_kategori_barang"><?= $validation->getError('id_sub_kategori_barang'); ?></label>
                                <?php endif; ?>
                            </div>

                            <!-- Foto Barang -->
                            <div class="form-group col-md-6 <?= ($validation->hasError('foto_barang')) ? 'has-error' : ''; ?>">
                                <label>Foto Barang</label>
                                <input type="file" class="form-control" name="foto_barang" placeholder="Enter Judul Barang" accept="image/*">
                                <input type="hidden" name="existing_foto_barang" value="<?= $barang['foto_barang'] ?>">
                                <?php if ($validation->hasError('foto_barang')) : ?>
                                    <label id="foto_barang-error" class="error invalid-feedback" for="foto_barang"><?= $validation->getError('foto_barang'); ?></label>
                                <?php endif; ?>
                            </div>

                            <!-- Harga Barang -->
                            <div class="form-group col-md-6 <?= ($validation->hasError('harga_barang')) ? 'has-error' : ''; ?>">
                                <label>Harga Barang</label>
                                <input value="Rp <?= number_format($barang['harga_barang'], 0, ',', '.'); ?>" type="text" class="form-control" name="harga_barang" placeholder="Enter Harga Barang" id="harga-input" oninput="formatRupiah(this)">
                                <?php if ($validation->hasError('harga_barang')) : ?>
                                    <label id="harga_barang-error" class="error invalid-feedback" for="harga_barang"><?= $validation->getError('harga_barang'); ?></label>
                                <?php endif; ?>
                            </div>

                            <!-- Jumlah Barang -->
                            <div class="form-group col-md-6 <?= ($validation->hasError('jumlah_barang')) ? 'has-error' : ''; ?>">
                                <label>Jumlah Barang</label>
                                <input value="<?= $barang['jumlah_barang']; ?>" type="number" class="form-control" name="jumlah_barang" placeholder="Enter Jumlah Barang">
                                <?php if ($validation->hasError('jumlah_barang')) : ?>
                                    <label id="jumlah_barang-error" class="error invalid-feedback" for="jumlah_barang"><?= $validation->getError('jumlah_barang'); ?></label>
                                <?php endif; ?>
                            </div>

                            <!-- Diskon -->
                            <div class="form-group col-md-6 <?= ($validation->hasError('diskon')) ? 'has-error' : ''; ?>">
                                <label>Diskon (%)</label>
                                <input value="<?= isset($barang['diskon']) ? $barang['diskon'] : ''; ?>" type="number" class="form-control" name="diskon" placeholder="Enter Diskon" min="0" max="100" step="0.01" oninput="calculateDiscount()">
                                <?php if ($validation->hasError('diskon')) : ?>
                                    <label id="diskon-error" class="error invalid-feedback" for="diskon"><?= $validation->getError('diskon'); ?></label>
                                <?php endif; ?>
                            </div>

                            <!-- Harga Setelah Diskon -->
                            <div class="form-group col-md-6 <?= ($validation->hasError('harga_setelah_diskon')) ? 'has-error' : ''; ?>">
                                <label>Harga Setelah Diskon</label>
                                <input type="text" class="form-control" name="harga_setelah_diskon" id="harga_setelah_diskon" value="Rp <?= number_format($barang['harga_setelah_diskon'], 0, ',', '.'); ?>" readonly>
                                <?php if ($validation->hasError('harga_setelah_diskon')) : ?>
                                    <label id="harga_setelah_diskon-error" class="error invalid-feedback" for="harga_setelah_diskon"><?= $validation->getError('harga_setelah_diskon'); ?></label>
                                <?php endif; ?>
                            </div>

                            <!-- Deskripsi Barang -->
                            <div class="form-group col-md-12 <?= ($validation->hasError('deskripsi_barang')) ? 'has-error' : ''; ?>">
                                <label>Deskripsi Barang</label>
                                <textarea class="form-control summernote" name="deskripsi_barang" rows="3" placeholder="Enter Deskripsi Barang"><?= $barang['deskripsi_barang']; ?></textarea>
                                <?php if ($validation->hasError('deskripsi_barang')) : ?>
                                    <label id="deskripsi_barang-error" class="error invalid-feedback" for="deskripsi_barang"><?= $validation->getError('deskripsi_barang'); ?></label>
                                <?php endif; ?>
                            </div>

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->

            <!-- Foto Lain -->
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
                                                <input type="file" accept="image/png, image/jpeg" class="custom-file-input" value="<?= $fdt['foto_barang_lain']; ?>" name="foto_detail[]" id="foto_detail">
                                                <label class="custom-file-label" for="exampleInputFile"><?= $fdt['foto_barang_lain']; ?></label>
                                            </div>
                                            <input type="hidden" name="foto_detail_id[]" value="<?= $fdt['id'] ?>">
                                        </div>
                                        <div class="col-lg-2">
                                            <a href="<?= base_url(); ?>sales/delete_foto_lain/<?= $fdt['id']; ?>" type="button" class="btn btn-danger delete"> Delete </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->

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
    function formatRupiah(angka) {
        let number_string = angka.value.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        angka.value = rupiah;
    }

    // Fungsi untuk menghitung harga setelah diskon
    function calculateDiscount() {
        let harga = <?= $barang['harga_barang']; ?>;
        let diskon = document.querySelector('[name="diskon"]').value || 0;
        let hargaSetelahDiskon = harga - (harga * (diskon / 100));
        
        document.querySelector('#harga_setelah_diskon').value = 'Rp ' + formatRupiahAmount(hargaSetelahDiskon);
    }

    // Format nilai angka untuk Rupiah
    function formatRupiahAmount(angka) {
        return angka.toLocaleString('id-ID');
    }
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