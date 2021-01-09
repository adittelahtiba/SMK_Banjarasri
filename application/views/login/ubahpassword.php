<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/BackEnd/') ?>plugins/images/favicon.png">
    <title>Ample Admin Template - The Ultimate Multipurpose admin template</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('assets/BackEnd/') ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- Menu CSS -->
    <link href="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Calendar CSS -->
    <link href="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/calendar/dist/fullcalendar.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/BackEnd/') ?>css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?= base_url('assets/BackEnd/') ?>css/colors/megna-dark.css" id="theme" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?= base_url('assets/BackEnd/') ?>css/colors/default.css" id="theme" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?= base_url('assets/BackEnd/') ?>https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="<?= base_url('assets/BackEnd/') ?>https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header">
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <section id="wrapper" class="new-login-register">
        <div class="lg-info-panel">
            <div class="inner-panel">
                <a href="javascript:void(0)" class="p-20 di"><img src="<?= base_url('assets/BackEnd/') ?>plugins/images/admin-logo-dark.png"></a>
                <div class="lg-content">
                    <h2>THE ULTIMATE & MULTIPURPOSE ADMIN TEMPLATE OF 2017</h2>
                    <p class="text-muted">with this admin you can get 2000+ pages, 500+ ui component, 2000+ icons, different demos and many more... </p>
                    <a href="#" class="btn btn-rounded btn-danger p-l-20 p-r-20"> Buy now</a>
                </div>
            </div>
        </div>
        <div class="new-login-box">
            <div class="white-box">
                <h3 class="box-title m-b-0">Ubah Password</h3>
                <small>Masukan password baru anda</small>

                <form class="form-horizontal new-lg-form" id="loginform" method="post" action="<?= base_url('lupapassword/ubah'); ?>">
                    <?= $this->session->flashdata('message'); ?>

                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="hidden" name="id2" value="<?= $hash ?>">

                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="inputPassword"> Password Baru</label>
                            <input class="form-control" type="password" name="password1" placeholder="Password Baru">
                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="inputPassword"> Komfirmasi Password</label>
                            <input class="form-control" type="password" name="password2" placeholder="Konfirmasi Password">
                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader -->
        <!-- ============================================================== -->
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
            </svg>
        </div>

        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?= base_url('assets/BackEnd/') ?>bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- Menu Plugin JavaScript -->
        <script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
        <!--slimscroll JavaScript -->
        <script src="<?= base_url('assets/BackEnd/') ?>js/jquery.slimscroll.js"></script>
        <!--Wave Effects -->
        <script src="<?= base_url('assets/BackEnd/') ?>js/waves.js"></script>
        <!--Counter js -->
        <script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
        <script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/counterup/jquery.counterup.min.js"></script>
        <!--Morris JavaScript -->
        <!-- <script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/raphael/raphael-min.js"></script>
    <script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/morrisjs/morris.js"></script> -->

        <!-- Calendar JavaScript -->
        <script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/moment/moment.js"></script>
        <script src='<?= base_url("assets/BackEnd/") ?>plugins/bower_components/calendar/dist/fullcalendar.min.js'></script>
        <script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/calendar/dist/cal-init.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?= base_url('assets/BackEnd/') ?>js/custom.min.js"></script>

        <script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
        <!-- start - This is for export functionality only -->
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>

        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
                $(document).ready(function() {
                    var table = $('#example').DataTable({
                        "columnDefs": [{
                            "visible": false,
                            "targets": 2
                        }],
                        "order": [
                            [2, 'asc']
                        ],
                        "displayLength": 25,
                        "drawCallback": function(settings) {
                            var api = this.api();
                            var rows = api.rows({
                                page: 'current'
                            }).nodes();
                            var last = null;
                            api.column(2, {
                                page: 'current'
                            }).data().each(function(group, i) {
                                if (last !== group) {
                                    $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                                    last = group;
                                }
                            });
                        }
                    });
                    // Order by the grouping
                    $('#example tbody').on('click', 'tr.group', function() {
                        var currentOrder = table.order()[0];
                        if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                            table.order([2, 'desc']).draw();
                        } else {
                            table.order([2, 'asc']).draw();
                        }
                    });
                });
            });
            $('#example23').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        </script>
        <!-- <script src="<?php // echo base_url('assets/BackEnd/') 
                            ?>js/dashboard1.js"></script> -->
        <!-- Custom tab JavaScript -->
        <script src="<?= base_url('assets/BackEnd/') ?>js/cbpFWTabs.js"></script>


        <script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/toast-master/js/jquery.toast.js"></script>

        <script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
        <!--Style Switcher -->
        <script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>