<!DOCTYPE html>
<html lang="en">

<head>
     <link rel="shortcut icon" href="<?= base_url('assets/images/logo-login.png'); ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="smk">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="smk_alamiriyah_lebaksiu_tegal">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:image" content="https:/fillow.dexignlab.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title><?= $judul ?></title>

    <!-- KALENDER CSS -->
    <link href="<?= base_url('assets/') ?>vendor/fullcalendar/css/main.min.css" rel="stylesheet">

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/') ?>images/favicon.png">
    <link href="<?= base_url('assets/') ?>vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link href="<?= base_url('assets/') ?>vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/nouislider/nouislider.min.css">

    <!-- Datatable -->
    <link href="<?= base_url('assets/') ?>vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Style css -->
    <link href="<?= base_url('assets/') ?>css/style.css" rel="stylesheet">
    <style>
        .nice-select .list {
            max-height: 250px !important;
            overflow-y: auto !important;
        }
    </style>

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img src="<?= base_url('assets/') ?>images/logo-icon.png" alt="">
                <div class="brand-title">
                    <h2 class="">Presensi</h2>
                    <span class="brand-sub-title">RFID</span>
                </div>
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->
        <div id="flash-data" data-typealert="<?= $this->session->flashData('flashtype'); ?>" data-flashdata="<?= $this->session->flashData('flash'); ?>"></div>