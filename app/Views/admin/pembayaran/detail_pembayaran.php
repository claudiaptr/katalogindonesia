<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Pembayaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Detail Pembayaran</li>
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
                        <h3 class="d-inline-block d-sm-none"><?= $transaksi['judul_barang']; ?></h3>
                        <div class="col-12">
                            <img src="<?= base_url(); ?>transaksi/<?= $transaksi['bukti_pembayaran']; ?>" class="product-image" alt="Product Image">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h4>Deskripsi : </h4>
                        <hr>
                        <div class="row mt-5">
                            <div class="col-6"><h4>Nama Barang</h4></div>
                            <div class="col"><h4>:</h4></div>
                            <div class="col-5"><h4><?= $transaksi['judul_barang']; ?></h4></div>
                        </div>
                        <div class="row">
                            <div class="col-6"><h4>Nama Pembeli</h4></div>
                            <div class="col"><h4>:</h4></div>
                            <div class="col-5"><h4><?= $transaksi['username_transaksi']; ?></h4></div>
                        </div>
                        <div class="row">
                            <div class="col-6"><h4>Nama Penjual</h4></div>
                            <div class="col"><h4>:</h4></div>
                            <div class="col-5"><h4><?= $transaksi['username_pemilik']; ?></h4></div>
                        </div>
                        <div class="row">
                            <div class="col-6"><h4>Opsi Barang</h4></div>
                            <div class="col"><h4>:</h4></div>
                            <div class="col-5"><?php foreach (unserialize($transaksi['options']) as $key => $value) : ?><h4><?= $key; ?> : <?= $value; ?>  <?php endforeach; ?></h4></div>
                        </div>
                        <div class="row">
                            <div class="col-6"><h4>Qty</h4></div>
                            <div class="col"><h4>:</h4></div>
                            <div class="col-5"><h4><?= $transaksi['jumlah']; ?></h4></div>
                        </div>
                        <div class="row">
                            <div class="col-6"><h4>Sub Harga</h4></div>
                            <div class="col"><h4>:</h4></div>
                            <div class="col-5"><h4>Rp <?= number_format($transaksi['sub_total'], 0, ',', '.'); ?></h4></div>
                        </div>
                        <div class="row">
                            <div class="col-6"><h4>No Hp Pembeli</h4></div>
                            <div class="col"><h4>:</h4></div>
                            <div class="col-5"><h4><?= $transaksi['nomortelp']; ?></h4></div>
                        </div>
                        <div class="row">
                            <div class="col-6"><h4>Alamat Pembeli</h4></div>
                            <div class="col"><h4>:</h4></div>
                            <div class="col-5"><h4><?= $transaksi['alamat']; ?></h4></div>
                        </div>            
                        <div class="bg-gray py-2 px-3 mt-4">
                            Total Harga
                            <h2 class="mb-0">
                                Rp. <?= number_format($transaksi['total'], 0, ',', '.'); ?>
                            </h2>
                        </div>
                        <div class="mt-4 row ">
                            <?php if ($transaksi['verifikasi'] == 1) : ?>
                                <div class="col">
                                    <form class="verifikasi" action="<?= base_url(); ?>admin/verifikasi_pembayaran/<?= $transaksi['id']; ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="PUT">
                                        <button class="btn btn-success btn-lg btn-flat "> <i class="fas fa-check fa-lg mr-2"></i>Verifikasi</button>
                                    </form>
                                </div>
                            <?php endif ?>
                            <?php if ($transaksi['verifikasi'] == 1 || $transaksi['verifikasi'] == 3) : ?>
                                <div class="col">
                                    <form class="tolak" action="<?= base_url(); ?>admin/tolak_verifikasi_pembayaran/<?= $transaksi['id']; ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="PUT">
                                        <button class="btn btn-danger btn-lg btn-flat "> <i class="fas fa-ban fa-lg mr-2"></i>Tolak</button>
                                    </form>
                                </div>
                            <?php endif ?>
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