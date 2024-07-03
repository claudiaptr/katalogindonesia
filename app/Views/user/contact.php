  <?= $this->extend('user/layout'); ?>
  <?= $this->section('content'); ?>
  <!-- Breadcrumb Start -->
  <div class="container-fluid">
      <div class="row px-xl-5">
          <div class="col-12">
              <nav class="breadcrumb bg-light mb-30">
                  <a class="breadcrumb-item text-dark" href="#">Home</a>
                  <span class="breadcrumb-item active">Contact</span>
              </nav>
          </div>
      </div>
  </div>
  <!-- Breadcrumb End -->


  <!-- Contact Start -->
  <div class="container-fluid">
      <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
          <span class="bg-secondary pr-3">Contact Us</span>
      </h2>
      <div class="row px-xl-5">
          <div class="col-lg-7 mb-5">
              <div class="contact-form bg-light p-30">
                  <?php if (session()->getFlashdata('message')) : ?>
                      <div class="alert alert-info"><?php echo session()->getFlashdata('message'); ?></div>
                  <?php endif; ?>
                  <form name="sentMessage" id="contactForm" novalidate="novalidate" method="post" action="<?php echo base_url('email'); ?>">
                      <div class="control-group">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required="required" data-validation-required-message="Please enter your name" />
                          <?php if (isset($validation) && $validation->hasError('name')) : ?>
                              <p class="help-block text-danger"><?php echo $validation->getError('name'); ?></p>
                          <?php endif; ?>
                      </div>
                      <div class="control-group">
                          <input type="email" class="form-control" id="email_tujuan" name="email_tujuan" placeholder="Your Email" required="required" data-validation-required-message="Please enter your email" />
                          <?php if (isset($validation) && $validation->hasError('email_tujuan')) : ?>
                              <p class="help-block text-danger"><?php echo $validation->getError('email_tujuan'); ?></p>
                          <?php endif; ?>
                      </div>
                      <div class="control-group">
                          <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required="required" data-validation-required-message="Please enter a subject" />
                          <?php if (isset($validation) && $validation->hasError('subject')) : ?>
                              <p class="help-block text-danger"><?php echo $validation->getError('subject'); ?></p>
                          <?php endif; ?>
                      </div>
                      <div class="control-group">
                          <textarea class="form-control" rows="8" id="message" name="pesan" placeholder="Message" required="required" data-validation-required-message="Please enter your message"></textarea>
                          <?php if (isset($validation) && $validation->hasError('pesan')) : ?>
                              <p class="help-block text-danger"><?php echo $validation->getError('pesan'); ?></p>
                          <?php endif; ?>
                      </div>
                      <div>
                          <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Send Message</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>







  <!-- Ini Bagian Alamat -->

  <div class="col-lg-5 mb-5">
      <div class="bg-light p-30 mb-30">
          <iframe style="width: 100%; height: 250px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d479.03198683036055!2d115.23261955468152!3d-8.639168972271765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23f8661ef31cd%3A0x663c45c04ca4cfb3!2sPT.%20Indo%20Apps%20Solusindo%20-%20Apps%20%26%20Web%20Development%20%7C%20Seo%20Services%20di%20Bali!5e0!3m2!1sid!2sid!4v1719296258664!5m2!1sid!2sid" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
      </div>
      <div class="bg-light p-30 mb-3">
          <p class="mb-2">
              <i class="fa fa-map-marker-alt text-primary mr-3"></i>
              Jl. Ganetri IV No.4, Tonja, Kec. Denpasar Utara,
          <div style="margin-left: 30px;">Kota Denpasar, Bali 80237</div>
          </p>

          <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>patners@katalogindonesia.com</p>
          <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+62-8786-5309-966</p>
      </div>
  </div>
  </div>
  </div>
  <!-- Contact End -->
  <?= $this->endSection(); ?>