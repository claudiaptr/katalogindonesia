<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid ">
    <div class="content-header">
        <div class="container-fluid">
            <div class="d-flex mb-2 justify-content-between">
                <div class="">
                    <h1 class="m-0">Tambah Iklan Caraeusel</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Iklan</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="quickForm" action=" <?= base_url() ?>admin/store_iklan_carausel" enctype="multipart/form-data" method="post">
            <?= csrf_field(); ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Masukan judul iklan</label>
                    <input name="judul_iklan" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Isi Iklan</label>
                    <input name="isi_iklan" type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Backround Iklan</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="foto_iklan" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->

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
                judul_iklan: {
                    required: true,

                },
                isi_iklan: {
                    required: true,

                },
                foto_iklan: {
                    required: true
                },
            },
            messages: {
                judul_iklan: {
                    required: "Please enter judul iklan",

                },
                isi_iklan: {
                    required: "Please provide a isi iklan",
                },
                foto_iklan: "Please accept foto iklan"
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