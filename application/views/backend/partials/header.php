<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>RENSTRA FT UDINUS</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="<?= base_url('') ?>/assets/img/udinus.png" rel="icon">
    <link href="<?= base_url('') ?>/assets/img/udinus.png" rel="udinus">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('') ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('') ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('') ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url('') ?>/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url('') ?>/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= base_url('') ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url('') ?>/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />

    <!-- Template Main CSS File -->
    <link href="<?= base_url('') ?>/assets/css/style.css" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<style>
    body {
        background-color: #f6f9ff;
    }

    .logo span {
        font-size: 24px;
    }

    .dropdown-toggle::after {
        margin-left: 4px;
    }
</style>

<body>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="<?= base_url('dashboard') ?>" class="logo d-flex align-items-center" style="text-decoration: none;">
                <img src="<?= base_url('') ?>/assets/img/udinus.png" alt="" />
                <span class="d-none d-lg-block">Rencana Strategis FT</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <a
                        class="nav-link nav-profile d-flex align-items-center pe-0"
                        href="#"
                        data-bs-toggle="dropdown">
                        <span class="d-none d-md-block dropdown-toggle ps-2">
                            <?php echo $this->session->userdata('nama'); ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo $this->session->userdata('nama'); ?></h6>
                            <span><?php echo $this->session->userdata('level'); ?></span>
                        </li>

                        <li>
                            <hr class="dropdown-divider" />
                        </li>

                        <li>
                            <a
                                class="dropdown-item d-flex align-items-center"
                                href="<?= base_url('profil') ?>">
                                <i class="bi bi-person"></i>
                                <span>Profil Saya</span>
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider" />
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                <i class="bi bi-box-arrow-right text-danger"></i>
                                <span class="text-danger">Keluar Akun</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Modal Konfirmasi Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin keluar dari akun ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger">Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link <?php echo ($this->uri->segment(1) == 'dashboard') ? '' : 'collapsed'; ?>" href="<?php echo site_url('dashboard'); ?>">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <?php if ($this->session->userdata('level') == 'Admin' || $this->session->userdata('level') == 'Koordinator'): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->uri->segment(1) == 'renstra') ? '' : 'collapsed'; ?>" href="<?php echo site_url('renstra'); ?>">
                        <i class="bi bi-layout-text-window-reverse"></i>
                        <span>Rencana Strategis</span>
                    </a>
                </li>
            <?php endif; ?>

            <li class="nav-item">
                <a
                    class="nav-link <?php echo ($this->uri->segment(1) == 'ewmp' || $this->uri->segment(1) == 'hasil_pelaporan' || $this->uri->segment(1) == 'create_view') ? '' : 'collapsed'; ?>"
                    data-bs-target="#ewmp-nav"
                    data-bs-toggle="collapse"
                    href="#ewmp-nav">
                    <i class="bi bi-menu-button-wide"></i>
                    <span>Pelaporan EWMP</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul
                    id="ewmp-nav"
                    class="nav-content collapse <?php echo ($this->uri->segment(1) == 'ewmp' || $this->uri->segment(1) == 'hasil_pelaporan') ? 'show' : ''; ?>"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="<?php echo ($this->uri->segment(1) == 'ewmp' && in_array($this->uri->segment(2), ['', 'detail_pelaporan', 'create_view'])) ? 'active' : ''; ?>"
                            href="<?php echo site_url('ewmp'); ?>">
                            <i class="bi bi-circle"></i>
                            <span>Pelaporan</span>
                        </a>
                    </li>
                    <?php if (in_array($this->session->userdata('level'), ['Admin', 'Koordinator'])): ?>
                        <li>
                            <a class="<?php echo ($this->uri->segment(1) == 'hasil_pelaporan') ? 'active' : ''; ?>"
                                href="<?php echo site_url('hasil_pelaporan'); ?>">
                                <i class="bi bi-circle"></i>
                                <span>Hasil</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>

            <?php if ($this->session->userdata('level') == 'Admin' || $this->session->userdata('level') == 'Koordinator'): ?>
                <li class="nav-item">
                    <a
                        class="nav-link <?php echo ($this->uri->segment(1) == 'dosen' || $this->uri->segment(1) == 'mahasiswa') ? '' : 'collapsed'; ?>"
                        data-bs-target="#akademik-nav"
                        data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Data Akademik</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul
                        id="akademik-nav"
                        class="nav-content collapse <?php echo ($this->uri->segment(1) == 'dosen' || $this->uri->segment(1) == 'mahasiswa' || $this->uri->segment(1) == 'tahun' || $this->uri->segment(1) == 'tahun') ? 'show' : ''; ?>"
                        data-bs-parent="#sidebar-nav">
                        <li>
                            <a class="<?php echo ($this->uri->segment(1) == 'dosen') ? 'active' : ''; ?>" href="<?php echo site_url('dosen'); ?>">
                                <i class="bi bi-circle"></i><span>Dosen</span>
                            </a>
                        </li>
                        <li>
                            <a class="<?php echo ($this->uri->segment(1) == 'mahasiswa') ? 'active' : ''; ?>" href="<?php echo site_url('mahasiswa'); ?>">
                                <i class="bi bi-circle"></i><span>Mahasiswa</span>
                            </a>
                        </li>
                        <li>
                            <a class="<?php echo ($this->uri->segment(1) == 'tahun') ? 'active' : ''; ?>" href="<?php echo site_url('tahun'); ?>">
                                <i class="bi bi-circle"></i><span>Tahun</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if ($this->session->userdata('level') == 'Admin'): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->uri->segment(1) == 'user') ? '' : 'collapsed'; ?>" href="<?php echo site_url('user'); ?>">
                        <i class="bi bi-layout-text-window-reverse"></i>
                        <span>Kelola User</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </aside>
    