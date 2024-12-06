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
    .logo span {
        font-size: 24px;
    }

    .dropdown-toggle::after {
        margin-left: 4px;
    }
</style>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
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

                        <!-- <li>
                            <hr class="dropdown-divider" />
                        </li> -->

                        <!-- <li>
                            <a
                                class="dropdown-item d-flex align-items-center"
                                href="#">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li> -->

                        <li>
                            <hr class="dropdown-divider" />
                        </li>

                        <li>
                            <hr class="dropdown-divider" />
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="auth/logout">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link <?php echo ($this->uri->segment(1) == 'dashboard') ? '' : 'collapsed'; ?>" href="<?php echo site_url('dashboard'); ?>">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo ($this->uri->segment(1) == 'renstra') ? '' : 'collapsed'; ?>" href="<?php echo site_url('renstra'); ?>">
                    <i class="bi bi-layout-text-window-reverse"></i>
                    <span>Rencana Strategis</span>
                </a>
            </li>

            <li class="nav-item">
                <a
                    class="nav-link <?php echo ($this->uri->segment(1) == 'ewmp') ? '' : 'collapsed'; ?>"
                    data-bs-target="#ewmp-nav"
                    data-bs-toggle="collapse"
                    href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Pelaporan EWMP</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul
                    id="ewmp-nav"
                    class="nav-content collapse <?php echo ($this->uri->segment(1) == 'ewmp') ? 'show' : ''; ?>"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="<?php echo ($this->uri->segment(1) == 'ewmp' && $this->uri->segment(2) == '') ? 'active' : ''; ?>" href="<?php echo site_url('ewmp'); ?>">
                            <i class="bi bi-circle"></i><span>Pelaporan</span>
                        </a>
                    </li>
                    <li>
                        <a class="<?php echo ($this->uri->segment(1) == 'ewmp' && $this->uri->segment(2) == 'hasil') ? 'active' : ''; ?>" href="<?php echo site_url('ewmp/hasil'); ?>">
                            <i class="bi bi-circle"></i><span>Hasil</span>
                        </a>
                    </li>
                </ul>
            </li>

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
                    class="nav-content collapse <?php echo ($this->uri->segment(1) == 'dosen' || $this->uri->segment(1) == 'mahasiswa') ? 'show' : ''; ?>"
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
                </ul>
            </li>
        </ul>
    </aside>