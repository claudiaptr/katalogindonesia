<?= $this->extend('user/layout'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid mt-4">
    <div class="col-lg-9">
    <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <?php if (!empty($barang)): ?>
                        <?php foreach ($barang as $bk): ?>
                            <div class="col-md-3 mb-4">
                                <div class="product-item bg-light text-center p-3">
                                    <a href="<?= base_url('user/detail/' . $bk['id']); ?>" class="text-decoration-none">
                                        <img src="<?= base_url('barang/' . $bk['foto_barang']); ?>" alt="<?= $bk['judul_barang']; ?>" class="img-fluid" style="width: 100%; height: 200px; object-fit: cover;">
                                        <h6 class="text-truncate"><?= $bk['judul_barang']; ?></h6>
                                        <p class="mb-0">Rp. <?= number_format($bk['harga_barang'], 0, ',', '.'); ?></p>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Tidak ada produk yang ditemukan untuk kategori ini.</p>
                    <?php endif; ?>
                </div>
                </div>

            </div>   
    </div>
</div>

<?= $this->endSection(); ?>

