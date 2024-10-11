<?= $this->extend('user/layout'); ?>
<?= $this->section('content'); ?>

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="<?= base_url(); ?>">Home</a>
                <span class="breadcrumb-item active">Wishlist</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Wishlist Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Barang/Jasa</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($wishlist)): ?>
                        <?php foreach ($wishlist as $item): ?>
                            <tr>
                                <td><?= esc($item['judul_barang']); ?></td> <!-- Ganti 'name' dengan 'judul_barang' -->
                                <td>Rp <?= number_format($item['harga_barang'], 2, ',', '.'); ?></td>
                                <td><?= esc($item['jumlah_barang']); ?></td>
                                <td>Rp <?= number_format($item['harga_barang'] * $item['jumlah_barang'], 2, ',', '.'); ?></td>
                                <td>
                                    <form action="<?= base_url('wishlist/remove/' . esc($item['id'])); ?>" method="post">
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No items in your wishlist.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Wishlist End -->

<!-- Continue Shopping Button -->
<div class="container">
    <a href="<?= base_url('shop'); ?>" class="btn btn-primary">Continue Shopping</a>
</div>

<?= $this->endSection(); ?>
