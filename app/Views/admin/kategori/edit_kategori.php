<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid ">
    <div class="content-header">
        <div class="container-fluid">
            <div class="d-flex mb-2 justify-content-between">
                <div class="">
                    <h1 class="m-0">Edit Kategori</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Kategori</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="quickForm" action=" <?= base_url() ?>admin/update_kategori/<?= $kategori['id']; ?>" method="post">
            <?= csrf_field(); ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Kategori</label>
                    <input name="nama_kategori" type="text" class="form-control" id="exampleInputEmail1" value="<?= $kategori['nama_kategori']; ?>" placeholder="Masukkan Nama Kategori">
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
<script>
    $(function() {

        $('#quickForm').validate({
            rules: {
                nama_kategori: {
                    required: true,
                },
            },
            messages: {
                nama_kategori: {
                    required: "Please enter nama kategori",
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