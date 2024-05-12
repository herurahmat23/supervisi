<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI ATAN - <?= $title ?></title>

    <link rel="shortcut icon" href="<?= base_url('assets/') ?>dist/img/siatan_logo.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-dark navbar-lightblue">
            <div class="container">
                <a href="<?= site_url('Dashboard') ?>" class="navbar-brand">
                    <img src="<?= base_url('assets/') ?>dist/img/siatan_logo.png" alt="SI ATAN  Logo" class="brand-image elevation-0 ">
                    <span class="brand-text badge badge-pill badge-light font-weight">SI ATAN</span>
                </a>
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="<?= site_url('Dashboard') ?>" class="nav-link <?php if ($menu == "mn_dashboard") {
                                                                                        echo "active";
                                                                                    } ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('Master') ?>" class="nav-link <?php if ($menu == "mn_master") {
                                                                                    echo "active";
                                                                                } ?>"><i class="fas fa-th"></i> Master</a>
                        </li>
                        <?php if ($this->session->userdata('id_role') == 1) { ?>
                            <li class="nav-item">
                                <a href="<?= site_url('User') ?>" class="nav-link <?php if ($menu == "mn_user") {
                                                                                        echo "active";
                                                                                    } ?>"><i class="fas fa-hospital-user"></i> User</a>
                            </li>
                        <?php } ?>

                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-notes-medical"></i> Instrumen
                            </a>
                            <div class="dropdown-menu">
                                <a href="<?= site_url('Instrumen_penilaian') ?>" class="dropdown-item">Instrumen Penilaian</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">Hasil Penilaian</a>
                                <a href="<?= site_url('Instrumen_penilaian/hasil_karu') ?>" class="dropdown-item submenu-toggle" data-target="submenuHasilPenilaian">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ka. Ruangan</a>
                                <a href="<?= site_url('Instrumen_penilaian/hasil_katim') ?>" class="dropdown-item submenu-toggle" data-target="submenuHasilPenilaian">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ka. Tim</a>
                                <a href="<?= site_url('Instrumen_penilaian/hasil_staff') ?>" class="dropdown-item submenu-toggle" data-target="submenuHasilPenilaian">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Staff</a>
                                <a href="<?= site_url('Instrumen_penilaian/hasil_evaluasi') ?>" class="dropdown-item submenu-toggle" data-target="submenuHasilPenilaian">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Evaluasi</a>
                                <a href="<?= site_url('Instrumen_penilaian/laporan_rtl_bulanan') ?>" class="dropdown-item submenu-toggle" data-target="submenuHasilPenilaian">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Laporan RTL Bulanan</a>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a href="<?= site_url('Grafik') ?>" class="nav-link <?php if ($menu == "mn_grafik") {
                                                                                    echo "active";
                                                                                } ?>"><i class="fas fa-chart-bar"></i> Grafik</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('Kebijakan') ?>" class="nav-link <?php if ($menu == "mn_kebijakan") {
                                                                                        echo "active";
                                                                                    } ?>"><i class="fas fa-file-medical"></i> Kebijakan</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('Tentang_rs') ?>" class="nav-link <?php if ($menu == "mn_tentang_rs") {
                                                                                        echo "active";
                                                                                    } ?>"><i class="far fa-hospital"></i> Tentang RS</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <!-- Navbar Search -->
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#" role="button">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li> -->
                        <li class="nav-item dropdown ">
                            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
                                <i class="far fa-user"></i><strong> <?= $this->session->userdata('nama') ?> | <span class="badge badge-dark">Role: <?= $this->session->userdata('nama_role') ?></span></strong>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right " style="left: inherit; right: 0px;">

                                <div class="dropdown-divider"></div>
                                <a href="<?= site_url('Login/logout') ?>" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <h1 class="m-0"> <?= $title ?></h1>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">