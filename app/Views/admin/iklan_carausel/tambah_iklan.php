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
        <form  action=" <?= base_url() ?>admin/store_iklan_carausel"  method="post">
            <?= csrf_meta(); ?>
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
                    <label for="exampleInputFile">Background iklan</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <!-- <input name="foto_iklan" type="text" class="custom-file-input" id="exampleInputFile"> -->
                            <input name="foto_iklan" type="text" class="form-control" >
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