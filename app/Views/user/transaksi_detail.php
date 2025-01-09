<?= $this->extend('user/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-2">
            
        </div>


        <!-- Detail Transaksi -->
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <strong>ID Transaksi:</strong>
                        <span><?= $transaction['id'] ?></span>
                    </div>
                    <div class="mb-3">
                        <strong>Total:</strong>
                        <span>Rp <?= number_format($transaction['total'], 2, ',', '.') ?></span>
                    </div>
                    <div class="mb-3">
                        <strong>Status:</strong>
                        <span>
                            <?= $transaction['verifikasi'] == '1' ? 'Menunggu Verifikasi' : ($transaction['verifikasi'] == '2' ? 'Diproses' : 'Selesai') ?>
                        </span>
                    </div>
                    <div class="mb-3">
                        <strong>Alamat:</strong>
                        <span><?= $transaction['alamat'] ?></span>
                    </div>
                    <div class="mb-3">
                        <strong>Nomor Telepon:</strong>
                        <span><?= $transaction['nomortelp'] ?></span>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="<?= base_url('/user/transaction-history') ?>" class="btn btn-secondary">
                        Kembali ke Riwayat Transaksi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
