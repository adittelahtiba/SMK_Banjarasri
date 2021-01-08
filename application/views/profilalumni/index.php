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




    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?= base_url('assets/BackEnd/') ?>https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="<?= base_url('assets/BackEnd/') ?>https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<?php
if (!$this->session->userdata('nis')) {
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
                    <a class="logo" href="<?= base_url('dashboard/alumni') ?>">
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
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <input type="text" id="tautan" value="<?= base_url(); ?>" hidden>
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
                </div>
                <ul class="nav" id="side-menu">
                    <br>
                    <br>
                    <div class="text-center">
                        <img src="<?= base_url('assets/BackEnd/') ?>img/profile/<?= $this->session->userdata('foto'); ?>" alt="user-img" width="86" class="img-circle">
                    </div>
                    <br>
                    <br>
                    <li class="user-pro">
                        <a href="#" class="waves-effect">
                            <span class="hide-menu"><?php echo substr($this->session->userdata('name'), 0, 17); ?><span class="fa arrow"></span></span>
                        </a>
                        <ul class="nav nav-second-level collapse" aria-expanded="true">
                            <li><a href="<?= base_url('Login/logout') ?>"><i class="fa fa-power-off fa-fw"></i> <span class="hide-menu">Logout</span></a></li>
                        </ul>
                    </li>


                    <li class="devider"></li>

                </ul>
            </div>
        </div>

        <!-- end sidebar -->
        <!-- MULAI PROFIL -->


        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?= $title ?></h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                        <ol class="breadcrumb">
                            <li><a href="<?= base_url('Dashboard') ?>">Dashboard </a></li>
                            <li class="active"><?= $title ?></li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <!-- Nav tabs -->
                            <ul class="nav customtab2 nav-tabs" role="tablist">
                                <li role="presentation" class="<?php if ($active == '1') echo 'active'; ?>"><a href="#home6" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span><span class="hidden-xs"> Form alumni</span></a></li>
                                <li role="presentation" class="<?php if ($active == '2') echo 'active'; ?>"><a href="#profile6" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-lock"></i></span> <span class="hidden-xs">Ubah Password</span></a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade <?php if ($active == '1') echo 'active in'; ?>" id="home6">

                                    <div class="user-bg"> <img width="100%" alt="user" src="<?= base_url('assets/BackEnd/') ?>img/profile/<?= $this->session->userdata('foto'); ?>">
                                        <div class="overlay-box">
                                            <div class="user-content">
                                                <a href="javascript:void(0)"><img src="<?= base_url('assets/BackEnd/') ?>img/profile/<?= $this->session->userdata('foto'); ?>" class="thumb-lg img-circle" alt="img"></a>
                                                <h4 class="text-white"><?= $alumni['Nama_siswa']; ?></h4>
                                                <h5 class="text-white">NIS.<?= $alumni['Nomor_induk']; ?></h5>
                                                <h5 class="text-white">NISN.<?= $alumni['NISN']; ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-btm-box">
                                        <div class="row">
                                            <form action="<?= base_url('Situasialumni/update'); ?>" method="POST">
                                                <div class="col-md-12">
                                                    <p class="text-muted m-b-30 font-13"> Isi sesuai dengan situasi anda saat ini </p>
                                                    <?= $this->session->flashdata('message'); ?>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Bekerja</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1" name="Bekerja" value="<?= $alumni['Bekerja']; ?>" placeholder=""> </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Wiraswasta</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1" name="Wiraswasta" value="<?= $alumni['Wiraswasta']; ?>" placeholder=""> </div>

                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Kuliah</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1" name="Kuliah" value="<?= $alumni['Kuliah']; ?>" placeholder=""> </div>

                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Pencaker</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1" name="Pencaker" value="<?= $alumni['Pencaker']; ?>" placeholder=""> </div>

                                                </div>

                                                <div class="col-md-8">
                                                    <p class="text-muted m-b-30 font-13"> Detail pekerjaan </p>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-4 control-label">Gaji Pertama</label>
                                                        <div class="col-sm-7">
                                                            <div class="input-group"><span class="input-group-addon">Rp.</span>
                                                                <input type="number" name="Gaji_pertama" value="<?= $alumni['Gaji_pertama']; ?>" class="form-control" id="inputEmail3" placeholder="Masukan nominal gaji pertama anda"> </div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-4 control-label">Waktu Tunggu</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" name="Waktu_tunggu" class="form-control" value="<?= $alumni['Waktu_tunggu']; ?>" id="inputEmail3" placeholder="Contoh : 0-3 Bulan"> </div>
                                                        <br>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-4 control-label">Sesuai Linear Kompetensi :</label>
                                                        <div class="col-sm-7">
                                                            <div class="radio radio-success">
                                                                <input type="radio" name="Linear_kompetensi" id="radioa" value="Y" <?php if ($alumni['Linear_kompetensi'] == 'Y')  echo "checked"; ?>>
                                                                <label for="radio4"> Ya</label>
                                                            </div>
                                                            <div class="radio radio-danger">
                                                                <input type="radio" name="Linear_kompetensi" id="radiob" value="T" <?php if ($alumni['Linear_kompetensi'] == 'T')  echo "checked"; ?>>
                                                                <label for="radio6"> Tidak </label>
                                                            </div>
                                                            <div class="radio radio-warning">
                                                                <input type="radio" name="Linear_kompetensi" id="radioc" value="">
                                                                <label for="radio4"> </label>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputPassword3" class="col-sm-4 control-label">Kepuasan Bekerja :</label>
                                                        <div class="col-sm-7">
                                                            <div class="radio radio-success">
                                                                <input type="radio" name="Kepuasan_kerja" id="radiod" value="Y" <?php if ($alumni['Kepuasan_kerja'] == 'Y')  echo "checked"; ?>>
                                                                <label for="radio4"> Ya</label>
                                                            </div>
                                                            <div class="radio radio-danger">
                                                                <input type="radio" name="Kepuasan_kerja" id="radioe" value="T" <?php if ($alumni['Kepuasan_kerja'] == 'T')  echo "checked"; ?>>
                                                                <label for="radio6"> Tidak </label>
                                                            </div>
                                                            <div class="radio radio-warning">
                                                                <input type="radio" name="Kepuasan_kerja" id="radiof" value="">
                                                                <label for="radio4"> </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr>
                                                    </div>



                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Keterangan</label>
                                                            <textarea class="form-control" name="Keterangan" id="exampleInputEmail1" placeholder="Pendapat anda tentang pekerjaan dan tempat bekerja anda saat ini" rows="4"><?= $alumni['Keterangan']; ?></textarea> </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr>
                                                    </div>


                                                    <div class="col-sm-12 col-xs-12">
                                                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Simpan</button>
                                                        <button type="reset" class="btn btn-inverse waves-effect waves-light">Reset</button>
                                                    </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade <?php if ($active == '2') echo 'active in'; ?>" id="profile6">

                                <?= $this->session->flashdata('message'); ?>
                                <form class="form-material" action="<?= base_url('Situasialumni/ubahpass/'); ?>" enctype="multipart/form-data" method="post">
                                    <div class="form-group">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <input type="password" name="passlama" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password Lama">
                                            <?= form_error('passlama', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" name="password1" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password Baru">
                                                <small class="text-danger pl-3">*</small><?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" name="password2" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Ulangi Password Baru">

                                            </div>
                                        </div>
                                        <br>
                                        <hr>
                                        <br>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-check"></i> Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>