<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/BackEnd/') ?>plugins/images/favicon.png">
    <title><?= $title; ?></title>
    <link href="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('assets/BackEnd/') ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link href="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/css-chart/css-chart.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- Menu CSS -->
    <link href="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/dropify/dist/css/dropify.min.css">
    <!-- toast CSS -->
    <link href="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />

    <link href="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Calendar CSS -->
    <link href="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/calendar/dist/fullcalendar.css" rel="stylesheet" />
    <!-- animation CSS -->
    <link href="<?= base_url('assets/BackEnd/') ?>css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('assets/BackEnd/') ?>css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?= base_url('assets/BackEnd/') ?>css/colors/megna-dark.css" id="theme" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?= base_url('assets/BackEnd/') ?>css/adit.css" id="theme" rel="stylesheet">




    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?= base_url('assets/BackEnd/') ?>https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="<?= base_url('assets/BackEnd/') ?>https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<?php
if (!$this->session->userdata('id')) {
    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Anda harus login terlebih dahulu!</div>');
    redirect('Login');
}
?>

<body class="fix-header">

    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>

    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="<?= base_url('dashboard') ?>">
                        <!-- Logo icon image, you can use font-icon also --><b>
                            <!--This is dark logo icon--><img src="<?= base_url('assets/BackEnd/') ?>plugins/images/admin-logo.png" height="25" alt="home" class="dark-logo" />
                            <!--This is light logo icon--><img src="<?= base_url('assets/BackEnd/') ?>plugins/images/admin-logo-dark.png" height="25" alt="home" class="light-logo" />
                        </b>
                        <!-- Logo text image you can use text also --><span class="hidden-xs">
                            <!--This is dark logo text-->
                            <h4 alt="home" class="dark-logo" />SMK Banjar Asri</h4>
                            <!--This is light logo text-->
                            <h4 class="light-logo" />SMK Banjar Asri</h1>

                        </span> </a>
                </div>
                <!-- /Logo -->
                <!-- Search input and Toggle icon -->
                <ul class="nav navbar-top-links navbar-left">
                    <li><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="ti-menu"></i></a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="<?= base_url('assets/BackEnd/') ?>#"> <i class="mdi mdi-gmail"></i>
                            <div class="<?php if ($_SESSION['notif'] <> 0) echo "notify"; ?>"> <span class="heartbit"></span> <span class="point"></span> </div>

                            <!--
                        pakai ini cu jika ada notifikasi masook
                            
                        -->
                        </a>
                        <ul class="dropdown-menu mailbox animated bounceInDown">
                            <li>
                                <div class="drop-title">Anda Memiliki <?= $_SESSION['notif']; ?> Pesan Baru</div>
                            </li>
                            <!-- <li>
                                <div class="message-center">
                                    <a href="<?= base_url() ?>Dashboard/updatebacanotif/26/KdH-0003">
                                        <div class="user-img"> <img src="<?= base_url('assets/BackEnd/') ?>plugins/images/email.png" alt="user" class="img-circle"> </div>
                                        <div class="mail-contnet">
                                            <h5>asdfsadfsadfasdfasdf</h5> <span class="mail-desc">dsfasdfsadf</span> <span class="time">2019-11-12 09:56:08</span>
                                        </div>
                                    </a>
                                    <a href="<?= base_url() ?>Dashboard/updatebacanotif/24/KdH-0002">
                                        <div class="user-img"> <img src="<?= base_url('assets/BackEnd/') ?>plugins/images/email.png" alt="user" class="img-circle"> </div>
                                        <div class="mail-contnet">
                                            <h5>asdfdsf</h5> <span class="mail-desc">sdfsdf</span> <span class="time">2019-11-12 09:55:03</span>
                                        </div>
                                    </a>
                                </div>
                            </li> -->
                            <li>
                                <a class="text-center" href="<?= base_url('Dashboard/tampilpesan') ?>"> <strong>Lihat semua pesan</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-messages -->
                    </li>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="<?= base_url('assets/BackEnd/') ?>#"> <img src="<?= base_url('assets/BackEnd/') ?>img/profile/<?= $this->session->userdata('foto'); ?>" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?= $this->session->userdata('name'); ?></b><span class="caret"></span> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="<?= base_url('assets/BackEnd/') ?>img/profile/<?= $this->session->userdata('foto'); ?>" alt="user" /></div>
                                    <div class="u-text">
                                        <h4><?= $this->session->userdata('name'); ?></h4>
                                        <p class="text-muted"><?= $this->session->userdata('email'); ?></p>
                                    </div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                    </li>
                    <li><a href="<?= base_url() ?>pegawai/Profile"><i class="ti-user"></i> Profil</a></li>

                    <li role="separator" class="divider"></li>

                    <li><a href="<?= base_url() ?>Login/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
                <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>