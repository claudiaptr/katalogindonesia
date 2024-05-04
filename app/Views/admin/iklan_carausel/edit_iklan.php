<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid ">
    <div class="content-header">
        <div class="container-fluid">
            <div class="d-flex mb-2 justify-content-between">
                <div class="">
                    <h1 class="m-0">Edit Iklan Caraeusel</h1>
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
        <form  id="quickForm" action=" <?= base_url() ?>admin/update_iklan_carausel/<?= $iklan['id']; ?>"  method="post">
            <?= csrf_field(); ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Masukan judul iklan</label>
                    <input name="judul_iklan" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="<?= $iklan['judul_iklan']; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Isi Iklan</label>
                    <input name="isi_iklan" type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" value="<?= $iklan['isi_iklan']; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Background iklan</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <!-- <input name="foto_iklan" type="text" class="custom-file-input" id="exampleInputFile"> -->
                            <input name="foto_iklan" type="text" class="form-control"  value="<?= $iklan['foto_iklan']; ?>">
                            <!-- <label class="custom-file-label" for="exampleInputFile">Choose file</label> -->
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
    <?= $this->endSection() ?>