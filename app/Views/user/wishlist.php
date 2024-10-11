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
                    <th>Foto Barang</th>
                    <th>Judul Barang</th>
                    <th>Harga</th>
                    <th>Nama Toko</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($wishlist)): ?>
                    <?php foreach ($wishlist as $item): ?>
                        <tr>
                            <td>
                                <img src="<?= base_url('barang/' . esc($item['foto_barang'])); ?>" alt="<?= esc($item['judul_barang']); ?>" width="100" height="100">
                            </td>
                            <td><?= esc($item['judul_barang']); ?></td>
                            <td>Rp <?= number_format($item['harga_barang'], 2, ',', '.'); ?></td>
                            <td><?= esc($item['nama_toko']); ?></td> <!-- Tampilkan Nama Toko -->
                            <td class="align-middle">
                                <a href="<?= base_url(); ?>user/delete_wishlist/<?= esc($item['id']); ?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No items in your wishlist.</td>
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
    <a href="<?= base_url('user/home'); ?>" class="btn btn-primary">Continue Shopping</a>
</div>

<?= $this->endSection(); ?>
