<?= $this->extend('user/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-2">
            <!-- Sidebar content (if needed) -->
        </div>

        <!-- Detail Transaksi -->
        <div class="col-lg-9">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body">

                     <div>
                        <div class="mb-1">
                            <strong class="text-primary">ID Transaksi:</strong>
                            <span class="text-muted"><?= $transaction['id'] ?></span>
                        </div>

                        <div class="mb-1">
                            <strong class="text-primary">Nama Toko:</strong>
                            <span class="text-muted"><?= $toko['nama_toko'] ?></span>
                        </div>

                        <div class="mb-1">
                            <strong class="text-primary">Status:</strong>
                            <span class="text-muted">
                                <?= 
                                    $transaction['verifikasi'] == '1' ? 'Menunggu Verifikasi' :
                                    ($transaction['verifikasi'] == '3' ? 'Diproses' :
                                    ($transaction['verifikasi'] == '2' ? 'Dikemas' :
                                    ($transaction['verifikasi'] == '4' ? 'Dikirim' : 'Selesai')) )
                                ?>
                            </span>
                        </div>
                    </div>


                    <br>
                    <div class="row d-flex align-items-center justify-content-center">
                        <div class="col-md-4 text-center mb-3">
                            <img src="<?= base_url('barang/' . $transaction['foto_barang']) ?>" alt="Foto Barang" class="img-fluid rounded shadow" style="max-width: 200px;">
                        </div>
                        <div class="col-md-8">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <strong class="text-primary">Nama Barang:</strong>
                                </div>
                                <div class="col-md-8">
                                    <span class="text-muted"><?= $transaction['judul_barang'] ?></span>
                                </div>
                            </div>

                            <?php if (!empty($transaction['variasi'])): ?>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <strong class="text-primary">Variasi:</strong>
                                    </div>
                                    <div class="col-md-8">
                                        <span class="text-muted"><?= $transaction['variasi'] ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <strong class="text-primary">Harga Barang:</strong>
                                </div>
                                <div class="col-md-8">
                                    <span class="text-muted">Rp <?= number_format($transaction['harga_barang'], 2, ',', '.') ?></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <strong class="text-primary">Alamat:</strong>
                                </div>
                                <div class="col-md-8">
                                    <span class="text-muted"><?= $transaction['alamat'] ?></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <strong class="text-primary">Nomor Telepon:</strong>
                                </div>
                                <div class="col-md-8">
                                    <span class="text-muted"><?= $transaction['nomortelp'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>

                    <?php if ($transaction['verifikasi'] == 4): ?>
                        <form action="<?= base_url('/transactions/updateStatus/' . $transaction['id']) ?>" method="post">
                            <button type="submit" class="btn btn-success btn-lg w-100">
                                <i class="fa fa-check-circle me-2"></i> Selesai
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
                <div class="card-footer text-end">
                    <a href="<?= base_url('/user/transaction-history') ?>" class="btn btn-secondary btn-lg">
                        <i class="fa fa-arrow-left me-2"></i> Kembali ke Riwayat Transaksi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<!-- Tambahkan CSS di bawah ini di dalam file CSS atau di dalam tag <style> -->
<style>
    .card {
        background-color: #f9f9f9;
        border-radius: 15px;
    }
    .card-body {
        padding: 30px;
        background-color: #fff;
    }
    .card-footer {
        background-color: #f1f1f1;
        border-top: 1px solid #ddd;
    }
    .btn {
        font-size: 16px;
        padding: 10px;
    }
    .btn-lg {
        font-size: 18px;
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
    .btn:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }
    .text-primary {
        color: #007bff;
    }
    .text-muted {
        color: #6c757d;
    }
    .img-fluid {
        max-width: 100%;
        height: auto;
    }
    .shadow {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .rounded {
        border-radius: 10px;
    }
</style>
