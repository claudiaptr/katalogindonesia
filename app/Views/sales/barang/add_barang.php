<?= $this->extend('sales/layout'); ?>
<?= $this->section('link'); ?>

<?= $this->endSection() ?>
<?= $this->section('home'); ?>
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
            <input type="hidden" class="userid" name="userid" id="userid" value="">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Form Tambah Barang</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">

                            <!-- text input -->
                            <input type="hidden" name="id" value="<?= $id; ?>">
                            <div class="form-group col-md-6">
                                <label>Judul Barang</label>
                                <input type="text" class="form-control" name="judul_barang" placeholder="Enter Judul Barang">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Jenis Barang</label>
                                <input type="text" class="form-control" name="jenis_barang" placeholder="Enter Jenis Barang">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Foto Barang</label>
                                <input type="file" class="form-control" name="foto_barang" placeholder="Enter Judul Barang">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Jumlah Barang</label>
                                <input type="number" class="form-control" name="jumlah_barang" placeholder="Enter Judul Barang">
                            </div>
                            <!-- tambahkan input lainnya -->


                            <!-- textarea -->
                            <div class="form-group col-md-12">
                                <label>Deskripsi Barang</label>
                                <textarea class="form-control" name="deskripsi_barang" rows="3" placeholder="Enter Judul Barang"></textarea>
                            </div>

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
                    <!-- /.card -->
                </div>
            </div>

            <button class="btn btn-primary">Submit</button>
        </form>
    </section><!-- /.content -->
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
<script>
    $(".add-more").on("click", function() {
        var card =
            '<div style="margin-top: 10px;" class="row">' +
            '<div class="col-lg-10">' +
            '<div class="custom-file">' +
            '<input type="file" accept="image/png, image/jpeg" class="form-control-file" required name="foto_detail[]"  id="foto_detail">' +
            "</div>" +
            "</div>" +
            '<div class="col-lg-2">' +
            '<button class="btn btn-danger delete"> Delete </button>' +
            "</div>" +
            "</div>";
        $(".add-more-data").append(card);
    });

    $(".add-more-data").delegate(".delete", "click", function() {
        $(this).parent().parent().remove();
    });
</script>
<?= $this->endSection() ?>