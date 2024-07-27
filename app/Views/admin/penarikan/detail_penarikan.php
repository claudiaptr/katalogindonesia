<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Penarikan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Detail Penarikan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        
                        <div class="col-12">
                            <img src="<?= base_url(); ?>penarikan/<?= $penarikan['bukti_pembayaran']; ?>" class="product-image" alt="Product Image">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h4>Deskripsi : </h4>
                        <hr>
                        <div class="row mt-5">
                            <div class="col-6"><h4>Nama Penerima</h4></div>
                            <div class="col"><h4>:</h4></div>
                            <div class="col-5"><h4><?= $penarikan['username']; ?></h4></div>
                        </div>
                        <div class="row">
                            <div class="col-6"><h4>Username Bank</h4></div>
                            <div class="col"><h4>:</h4></div>
                            <div class="col-5"><h4><?= $penarikan['username_bank']; ?></h4></div>
                        </div>
                        <div class="row">
                            <div class="col-6"><h4>Bank</h4></div>
                            <div class="col"><h4>:</h4></div>
                            <div class="col-5"><h4><?= $penarikan['bank']; ?></h4></div>
                        </div>
                       
                        <div class="row">
                            <div class="col-6"><h4>Rekening</h4></div>
                            <div class="col"><h4>:</h4></div>
                            <div class="col-5"><h4><?= $penarikan['nomor_rekening']; ?></h4></div>
                        </div>
                       
                                   
                        <div class="bg-gray py-2 px-3 mt-4">
                            Jumlah Penarikan
                            <h2 class="mb-0">
                                Rp. <?= number_format($penarikan['jumlah_penarikan'], 0, ',', '.'); ?>
                            </h2>
                        </div>
                      
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
</div>
<?= $this->endSection(); ?>
<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('.product-image-thumb').on('click', function() {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
        })
    })
</script>
<?= $this->endSection() ?>