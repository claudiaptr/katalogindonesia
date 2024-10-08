<?= $this->extend('user/layout'); ?>
<?= $this->section('content'); ?>

<!-- My Account Start -->
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="list-group">
                    <a href="<?= base_url('myaccount'); ?>" class="list-group-item list-group-item-action active">Dashboard</a>
                    <a href="<?= base_url('myaccount/orders'); ?>" class="list-group-item list-group-item-action">Pesanan Saya</a>
                    <a href="<?= base_url('myaccount/settings'); ?>" class="list-group-item list-group-item-action">Pengaturan Akun</a>
                    <a href="<?= base_url('logout'); ?>" class="list-group-item list-group-item-action text-danger">Log Out</a>
                </div>
            </div>
            <div class="col-lg-9">
                <h1 class="my-4">Halo, <?= session()->get('username'); ?>!</h1>
                
                <h4>Informasi Akun</h4>
                <p>Email: <?= $data['email']; ?></p>
                <p>Nama: <?= $data['name']; ?></p>

                <h4 class="my-4">Pesanan Terakhir</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No. Pesanan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($orders)) : ?>
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada pesanan ditemukan.</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($orders as $order) : ?>
                                <tr>
                                    <td><?= $order['order_id']; ?></td>
                                    <td><?= $order['date']; ?></td>
                                    <td><?= $order['status']; ?></td>
                                    <td><?= $order['total']; ?></td>
                                    <td><a href="<?= base_url('myaccount/orders/' . $order['order_id']); ?>" class="btn btn-info">Detail</a></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Main Content End -->

    <?= $this->endSection(); ?>

