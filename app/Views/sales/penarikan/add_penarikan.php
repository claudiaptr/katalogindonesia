<?= $this->extend('sales/layout'); ?>
<?= $this->section('link'); ?>
<link rel="stylesheet" href="<?= base_url(); ?>sales/plugins/select2/select2.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<?= $this->endSection() ?>
<?= $this->section('home'); ?>
<?php if (session()->has('validation')) : ?>
    <?php $validation = session('validation'); ?>

<?php endif; ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Penarikan
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <form role="form" id="demoform" method="post" action="<?= base_url('sales/store_penarikan'); ?>">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Form Penarikan</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <!-- text input -->
                            <div class="form-group col-md-6">
                                <label for="bank">Bank</label>
                                <input type="text" class="form-control" name="bank" placeholder="Masukan Jenis Bank" id="bank">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="rekening">Rekening</label>
                                <input type="text" class="form-control" name="rekening" placeholder="Masukan rekening" id="rekening">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="username_penarikan">Username Bank</label>
                                <input type="text" class="form-control" name="username_penarikan" placeholder="Masukan Username Bank" id="username_penarikan">
                            </div>
                            <div class="form-group col-md-6 ">
                                <label>Jumlah Penarikan</label>
                                <input type="text" class="form-control" name="jumlah_penarikan" placeholder="Masukan Jumlah Penarikan" id="rupiah-input" oninput="formatRupiah(this)">
                            </div>
                            
                        </div>
                       
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section><!-- /.content -->
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
<script>
    function formatRupiah(input) {
        let angka = input.value.replace(/[^,\d]/g, '').toString();
        let split = angka.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        input.value = 'Rp ' + rupiah;
    }

    document.getElementById('demoform').addEventListener('submit', function(e) {
        let input = document.getElementById('rupiah-input');
        input.value = input.value.replace(/[^,\d]/g, '').replace(',', '.');
    });
</script>
<?= $this->endSection() ?>