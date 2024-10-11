<thead class="thead-dark">
    <tr>
        <th>Foto Barang</th>
        <th>Judul Barang</th>
        <th>Harga</th>
        <th>Pemilik</th>
        <th>Nama Toko</th> <!-- Kolom Nama Toko -->
        <th>Remove</th>
    </tr>
</thead>
<tbody>
    <?php if (!empty($wishlist)): ?>
        <?php foreach ($wishlist as $item): ?>
            <tr>
                <td>
                    <img src="<?= base_url('uploads/foto_barang/' . esc($item['foto_barang'])); ?>" alt="<?= esc($item['judul_barang']); ?>" width="100" height="100">
                </td>
                <td><?= esc($item['judul_barang']); ?></td>
                <td>Rp <?= number_format($item['harga_barang'], 2, ',', '.'); ?></td>
                <td><?= esc($item['pemilik']); ?></td>
                <td><?= esc($item['nama_toko']); ?></td> <!-- Tampilkan Nama Toko -->
                <td class="align-middle">
                    <a href="<?= base_url(); ?>user/delete_wishlist/<?= esc($item['id']); ?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">No items in your wishlist.</td>
        </tr>
    <?php endif; ?>
</tbody>
