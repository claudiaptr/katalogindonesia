<?= $this->extend('user/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-2">
            
        </div>


        <!-- Main Content -->
        <div class="col-lg-9 col-md-8 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-4">Riwayat Transaksi</h2>
                
                <!-- Form Filter -->
                <form method="get" class="mb-4">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="start_date">Tanggal Mulai:</label>
                            <input type="date" name="start_date" class="form-control" value="<?= $filters['start_date'] ?? '' ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="end_date">Tanggal Selesai:</label>
                            <input type="date" name="end_date" class="form-control" value="<?= $filters['end_date'] ?? '' ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="status">Status:</label>
                            <select name="status" class="form-control">
                                <option value="">Semua</option>
                                <option value="1" <?= ($filters['status'] ?? '') == '1' ? 'selected' : '' ?>>Menunggu Verifikasi</option>
                                <option value="2" <?= ($filters['status'] ?? '') == '2' ? 'selected' : '' ?>>Diproses</option>
                                <option value="3" <?= ($filters['status'] ?? '') == '3' ? 'selected' : '' ?>>Selesai</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="min_total">Total Minimum:</label>
                            <input type="number" name="min_total" class="form-control" value="<?= $filters['min_total'] ?? '' ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="max_total">Total Maksimum:</label>
                            <input type="number" name="max_total" class="form-control" value="<?= $filters['max_total'] ?? '' ?>">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                    </div>
                </form>

                <!-- Tabel Riwayat Transaksi -->
                <table class="table table-striped table-bordered" style="background-color: #ffffff; border-radius: 8px;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($transactions)): ?>
                            <tr>
                                <td colspan="5">Tidak ada data transaksi.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($transactions as $transaction): ?>
                                <tr>
                                    <td><?= $transaction['id'] ?></td>
                                    <td><?= number_format($transaction['total'], 2) ?></td>
                                    <td><?= $transaction['verifikasi'] == '1' ? 'Menunggu Verifikasi' : ($transaction['verifikasi'] == '2' ? 'Diproses' : 'Selesai') ?></td>
                                    <td><?= $transaction['created_at'] ?></td>
                                    <td><a href="/transactions/detail/<?= $transaction['id'] ?>">Detail</a></td>
                                </tr> 
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
</div>

        </div>
    </div>
</div>

<style>
    /* Container Styling */
    .container-fluid {
        font-family: 'Arial', sans-serif;
        color: #333;
    }

    /* Card Styling */
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 20px;
    }


    .list-group-item {
        font-weight: bold;
        border: none;
        padding: 10px;
    }

    /* Form Styling */
    form {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 20px;
    }

    form label {
        font-weight: bold;
        margin-right: 5px;
    }

    form input, form select {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px 10px;
        min-width: 150px;
    }

    form button {
        color: white;
        border: none;
        border-radius: 5px;
        padding: 8px 15px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s;
    }

    form button:hover {
        background-color: #ffd333;
    }

    /* Table Styling */
    .table {
        margin-top: 10px;
    }

    .table th {
        background-color:rgb(255, 170, 0);
        color: white;
        text-align: center;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .table td, .table th {
        text-align: center;
        vertical-align: middle;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        form {
            flex-direction: column;
        }

        form input, form select {
            width: 100%;
        }

        form button {
            width: 100%;
            margin-top: 10px;
        }
    }
</style>

<?= $this->endSection() ?>