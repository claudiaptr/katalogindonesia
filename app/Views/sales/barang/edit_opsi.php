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
                    <div class="add-more-variasi">
                        <?php foreach ($opsi as $vi) : ?>
                            <div class="box box-default">
                                <div class="box-body">
                                    <div id="actions" class="row">
                                        <div class="col-lg-6">
                                            <div class="btn-group w-100">
                                                <span class="btn btn-danger delete col fileinput-button" data-id="<?= $vi['id'] ?>">
                                                    <i class="fa fa-trash"></i>
                                                    <span> Hapus Opsi</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Nama Opsi</label>
                                        <input type="text" class="form-control" name="nama_opsi" value="<?= $vi['nama_opsi']; ?>" placeholder="Enter nama opsi">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="hidden" class="form-control" name="id_variasi" value="<?= $variasi['id']; ?>">
                                      
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Harga</label>
                                        <input type="text" class="form-control" name="harga" value="<?= $vi['harga']; ?>" placeholder="Enter harga opsi">
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;    ?>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section><!-- /.content -->
</div>
<?= $this->endSection(); ?>
<?= $this->section('scripts') ?>
<script>
    $(".add-more-variasi").on("click", ".delete", function() {
        $(this).closest('.box-default').remove();
    });
</script>
<script>
    $(document).ready(function() {
        // Function to handle the delete button click
        $(".add-more-variasi").on("click", ".delete", function() {
            var $this = $(this);
            var id = $this.data('id'); // Assuming each delete button has a data-id attribute with the id of the item
            $.ajax({
                type: 'POST',
                url: "<?= base_url(); ?>/sales/delete_opsi/" + id,
                success: function(response) {
                    if (response.status === 'success') {
                        // Remove the card if delete is successful
                        $this.closest('.box-default').remove();
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    alert('Terjadi kesalahan saat menghapus data.');
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>