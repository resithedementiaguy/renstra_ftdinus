<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="<?= base_url('') ?>/assets/img/udinus.png" rel="icon">
    <link href="<?= base_url('') ?>/assets/img/udinus.png" rel="udinus">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('') ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('') ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('') ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url('') ?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url('') ?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= base_url('') ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url('') ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url('') ?>assets/css/style.css" rel="stylesheet">
</head>

<body>
    <main style="background-image: url('<?= base_url("assets/img/bg-gradient-1.jpg") ?>'); background-size: cover; background-position: center; min-height: 100vh;">
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="card py-4 mb-0">
                                <div class="card-body px-4 m-0">
                                    <div class="text-center pb-2">
                                        <img src="<?= base_url('') ?>/assets/img/udinus-unggul-logo.png" alt="" width="150px" />
                                        <h5 class="card-title text-center pb-0 mb-1 fs-4">Login Rencana Strategis FT</h5>
                                        <p class="text-center small">Masukkan Username & Password untuk login!</p>
                                    </div>

                                    <!-- Menampilkan alert error jika ada pesan flash -->
                                    <?php if ($this->session->flashdata('error')): ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?= $this->session->flashdata('error') ?>
                                        </div>
                                    <?php endif; ?>

                                    <form class="row g-3 needs-validation" action="auth/login" method="post" novalidate>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">
                                                    <i class="bi bi-person-fill text-secondary"></i>
                                                </span>
                                                <input type="text" name="username" class="form-control" id="yourUsername" placeholder="Masukkan Username" required>
                                                <div class="invalid-feedback">Masukkan nama terlebih dahulu!</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">
                                                    <i class="bi bi-lock-fill text-secondary"></i>
                                                </span>
                                                <input type="password" name="password" class="form-control" id="yourPassword" placeholder="Masukkan Password" required>
                                                <div class="invalid-feedback">Masukkan password terlebih dahulu!</div>
                                            </div>
                                        </div>
                                        <div class="col-12 pt-3">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                        <div class="col-12 text-center">
                                            <p class="small mb-0">
                                                Belum punya akun?
                                                <a href="<?php echo base_url('auth/register'); ?>">Buat sekarang!</a>
                                            </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url('') ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/chart.js/chart.umd.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/quill/quill.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url('') ?>assets/js/main.js"></script>

</body>

</html>