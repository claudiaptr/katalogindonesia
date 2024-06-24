<?= $this->extend('sales/layout'); ?>
<?= $this->section('link'); ?>
<link rel="stylesheet" href="<?= base_url(); ?>sales/plugins/select2/select2.min.css">
<?= $this->endSection() ?>
<?= $this->section('home'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Opsi Barang
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Edit Opsi</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <form role="form" method="POST" action="">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title">Edit Opsi</h3>
                        </div>
                        <div class="box-body">
                            <?php foreach ($opsi as $vi) : ?>
                                <div class="form-group col-md-12">
                                    <label>Nama Opsi</label>
                                    <input type="text" class="form-control" name="nama_opsi" value="<?= $vi['nama_opsi']; ?>" placeholder="Enter nama opsi">
                                </div>
                                <!-- <div class="form-group col-md-12">
                                    <input type="hidden" class="form-control" name="id_variasi" value="<?= $variasi['id']; ?>">
                                </div> -->
                                <div class="form-group col-md-12">
                                    <label>Harga</label>
                                    <input type="text" class="form-control" name="harga" value="<?= $vi['harga']; ?>" placeholder="Enter harga opsi">
                                </div>
                            <?php endforeach;    ?>
                        </div>
                    </div>
                    <div class="add-more-variasi"></div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section><!-- /.content -->
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
<script>
    $(".add-variasi").on("click", function() {
        var card =
            '<div class="box box-default">' +
            '<div class="box-body">' +
            ' <div class="form-group col-md-12">' +
            '<label>Nama Opsi</label>' +
            '<input type="text" class="form-control" name="nama_opsi[]" placeholder="Enter nama opsi">' +
            " </div>" +
            '<div class="form-group col-md-12">' +
            " <label>Harga</label>" +
            ' <input type="text" class="form-control" name="harga_opsi[]" placeholder="Enter harga opsi">' +
            '  </div>' +
            '  </div>' +
            '  </div>';
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
<?= $this->endSection() ?>