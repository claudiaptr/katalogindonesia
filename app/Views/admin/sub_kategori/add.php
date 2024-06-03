<?= $this->extend('admin/layout'); ?>
<?= $this->section('link') ?>
<link rel="stylesheet" href="<?= base_url(); ?>asset/plugins/select2/css/select2.min.css">
<?= $this->endSection() ?>
<?= $this->section('content'); ?>
<div class="container-fluid ">
    <div class="content-header">
        <div class="container-fluid">
            <div class="d-flex mb-2 justify-content-between">
                <div class="">
                    <h1 class="m-0">Tambah Kategori</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Kategori</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="quickForm" action=" <?= base_url() ?>admin/store_sub_kategori" enctype="multipart/form-data" method="post">
            <?= csrf_field(); ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Sub Kategori</label>
                    <input name="nama_sub_kategori" type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Kategori">
                </div>
                <div class="form-group">
                  <label>Jenis Kategori</label>
                  <select name="id_kategori" class="form-control select2" style="width: 100%;">
                    <option selected="selected" value="">Pilih Jenis Kategori</option>
                    <?php foreach ($kategori as $kt) : ?>
                    <option value="<?= $kt['id']; ?>"><?= $kt['nama_kategori']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('scripts') ?>
<script src="<?= base_url(); ?>asset/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?= base_url(); ?>asset/plugins/select2/js/select2.full.min.js"></script>
<script>
    $(function() {
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        $('#quickForm').validate({
            rules: {
                nama_kategori: {
                    required: true,
                },
            },
            messages: {
                nama_kategori: {
                    required: "Please enter judul iklan",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>


<?= $this->endSection() ?>