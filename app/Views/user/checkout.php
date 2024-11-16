<?= $this->extend('user/layout'); ?>
<?= $this->section('content'); ?>
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Checkout</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<?php
$id_user = session()->get('id');
$keranjang = $cart->contentsByUser($id_user);
?>
<!-- Checkout Start -->
<div class="container-fluid">
    <div class="row px-xl-5">

        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
            <div class="bg-light p-30 mb-5">

                <div class="text-center mt-4">
                    <h6> UNTUK PEMBAYARAN </h6>
                    <h6> ANDA DAPAT MEMINDAI KODE DI BAWAH INI </h6>
                    <img src="<?= base_url('img/qriscode.png'); ?>" alt="QRIS Code" style="max-width: 280px;" class="img-fluid">
                    <br>
                    <br>
                    <h6>ATAU BISA BAYAR KE</h6>

                    <h4>DANA : 082145865146 </h4>
                </div>

                <br>
                <br>

                <div class="border-bottom">
                    <h6 class="mb-3">Products</h6>
                    <?php foreach ($keranjang as $krng) : ?>
                        <div class="row justify-content-between">
                            <p class="col-6"><?= $krng['name']; ?></p>
                            <p class="col"><?= $krng['qty']; ?></p>
                            <p class="col">X</p>
                            <p class="col-3"><?= number_format($krng['price'], 0, ',', '.'); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5>Rp. <?= number_format($cart->totalByUser(session()->get('id')), 0, ',', '.'); ?></h5>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-8">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
            <form action="<?= base_url('transaksii'); ?>" method="post" enctype="multipart/form-data">
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        <input class="form-control" name="id_user" type="hidden" value="<?= $id_user; ?>">
                        <input class="form-control" name="total" type="hidden" value="<?= $cart->totalByUser(session()->get('id')); ?>">
                        <?php foreach ($keranjang as $krng) : ?>
                            <input class="form-control" name="sub_total[]" type="hidden" value="<?= $krng['subtotal']; ?>">
                            <input class="form-control" name="id_barang[]" type="hidden" value="<?= $krng['id_barang']; ?>">
                            <input class="form-control" name="jumlah[]" type="hidden" value="<?= $krng['qty']; ?>">
                            <textarea name="options[]" style="display:none;"><?= htmlspecialchars(serialize($krng['options'])); ?></textarea>
                        <?php endforeach; ?>
                        <div class="col-md-12 form-group">
                            <label>Nomor Telp</label>
                            <input class="form-control" name="nomortelp" type="number" placeholder="08*****">
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" id=""></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Bukti Pembayaran</label>

                            <!-- Area Drag & Drop -->
                            <div class="frame">
                                <div class="center">
                                    <br>

                                    <!-- Dropzone Area -->
                                    <div class="dropzone" id="dropzone" ondrop="handleDrop(event)" ondragover="allowDrop(event)">
                                        <img src="http://100dayscss.com/codepen/upload.svg" class="upload-icon" id="upload-icon" />
                                        <input type="file" class="upload-input" name="bukti_pembayaran" id="bukti-pembayaran" onchange="previewImage()" accept="image/*" style="display: none;" />
                                        <p>Seret File atau Klik untuk Memilih</p>
                                    </div>

                                    <!-- Preview Image -->
                                    <div id="preview-container" style="margin-top: 10px; display: none;">
                                        <h4>Preview Bukti Pembayaran:</h4>
                                        <img id="preview-image" src="#" alt="Preview Gambar" style="max-width: 50%; display: none;">
                                    </div>

                                    <button type="button" class="btn" name="uploadbutton">Unggah File</button>
                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-block btn-primary font-weight-bold py-3">Place Order</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk menangani event drop (drag and drop)
    function allowDrop(event) {
        event.preventDefault(); // Mencegah default action (misalnya membuka file)
    }

    // Fungsi untuk menangani saat file dijatuhkan
    function handleDrop(event) {
        event.preventDefault();
        var file = event.dataTransfer.files[0]; // Ambil file pertama yang dijatuhkan
        document.getElementById('bukti-pembayaran').files = event.dataTransfer.files; // Set file ke input
        previewImage(file); // Tampilkan preview gambar jika file gambar
    }

    // Fungsi untuk menampilkan preview gambar setelah memilih atau menjatuhkan file
    function previewImage(file = null) {
        const fileInput = document.getElementById('bukti-pembayaran');
        const fileToPreview = file || fileInput.files[0]; // Gunakan file yang dijatuhkan atau dipilih

        if (fileToPreview && fileToPreview.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImage = document.getElementById('preview-image');
                previewImage.src = e.target.result; // Set src gambar dengan hasil FileReader
                document.getElementById('preview-container').style.display = 'block'; // Tampilkan preview
                previewImage.style.display = 'block'; // Tampilkan gambar
            };
            reader.readAsDataURL(fileToPreview);
        } else {
            alert('Silakan pilih file gambar!');
        }
    }

    // Fungsi untuk membuka file input ketika area dropzone di klik
    document.getElementById('dropzone').addEventListener('click', function() {
        document.getElementById('bukti-pembayaran').click();
    });
</script>
<!-- Checkout End -->
<?= $this->endSection(); ?>