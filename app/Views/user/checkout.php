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
                             <input class="form-control" name="bukti_pembayaran" type="file" accept="image/*" placeholder="New York">
                         </div>
                         <button type="submit" class="btn btn-block btn-primary font-weight-bold py-3">Place Order</button>
                     </div>
                 </div>
             </form>

         </div>
         <div class="col-lg-4">
             <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
             <div class="bg-light p-30 mb-5">
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
     </div>
 </div>
 <!-- Checkout End -->
 <?= $this->endSection(); ?>