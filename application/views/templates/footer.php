<footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by themedesigner.in </footer>
<?php unset($_SESSION['message']); ?>
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
<script src="<?= base_url('assets/BackEnd/') ?>js/kelas.js"></script>
<script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/dropzone-master/dist/dropzone.js"></script>
<script src="<?= base_url('assets/BackEnd/') ?>js/jasny-bootstrap.js"></script>
<script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/dropify/dist/js/dropify.min.js"></script>

<!--Morris JavaScript -->
<script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/raphael/raphael-min.js"></script>
<script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/morrisjs/morris.js"></script>
<script src="<?= base_url('assets/BackEnd/') ?>js/morris-data.js"></script>
<!--Style Switcher -->
<script type="text/javascript">
    $(function() {

        const flashdata = $('.flash-data').data('flash');
        if (flashdata) {
            swal({
                title: 'Data ' + '<?= $title ?>',
                text: flashdata,
                type: 'success',
                timer: 1500,
            });
        }

        $('#smptable').on('click', '#btndltsiswa1', function() {
            const id = $(this).data('id');
            swal({
                title: 'Apakah anda yakin?',
                text: "Anda tidak akan dapat mengembalikan data " + id + "!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, Hapus!'
            }, function(isConfirm) {
                if (isConfirm) {
                    window.location.href = '<?= base_url('Siswa/barudelete/'); ?>' + id;

                }
            });
        });

        $('#myTable').on('click', '#btndltsiswa', function() {
            const id = $(this).data('id');
            swal({
                title: 'Apakah anda yakin?',
                text: "Anda tidak akan dapat mengembalikan data " + id + "!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, Hapus!'
            }, function(isConfirm) {
                if (isConfirm) {
                    window.location.href = '<?= base_url('Siswa/barudelete/'); ?>' + id + '/semua';

                }
            });
        });

        $('#table').on('click', '#btndltnotif', function() {
            const id = $(this).data('id');
            swal({
                title: 'Apakah anda yakin?',
                text: "Notifikasi akan di hapus!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, Hapus!'
            }, function(isConfirm) {
                if (isConfirm) {
                    window.location.href = '<?= base_url('Analisis/notifdelete/'); ?>' + id;

                }
            });
        });

        $('#example23').on('click', '#btndelete', function() {
            const id = $(this).data('id');
            swal({
                title: 'Apakah anda yakin?',
                text: "Anda tidak akan dapat mengembalikan data " + id + "!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, Hapus!'
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '<?= base_url('Pegawai/delete'); ?>',
                        data: {
                            id: id
                        },
                        method: 'post',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            window.location.href = '';
                        },
                        error: function(data) {
                            alert('error')
                        }
                    });
                }
            });
        });

        console.log('ok');

        $('#example23').on('click', '#btndeleteswks', function() {
            const id = $(this).data('id');
            const kelas = $(this).data('kelas');
            swal({
                title: 'Apakah anda yakin?',
                text: "Anda tidak akan dapat mengembalikan data " + id + " dari kelas " + kelas + " !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, Hapus!'
            }, function(isConfirm) {
                if (isConfirm) {
                    window.location.href = '<?= base_url('Kelas/deletesiswa/'); ?>' + id + '/' + kelas;
                }
            });
        });

        $('#example23').on('click', '#btndeleteperu', function() {
            const id = $(this).data('id');
            const peru = $(this).data('peru');
            swal({
                title: 'Apakah anda yakin?',
                text: "Anda tidak akan dapat mengembalikan data perusahaan " + peru + "!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, Hapus!'
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '<?= base_url('Perusahaan/delete'); ?>',
                        data: {
                            id: id,
                            peru: peru
                        },
                        method: 'post',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            window.location.href = '';
                        },
                        error: function(data) {
                            alert('error')
                        }
                    });
                }
            });
        });

        $('#example23').on('click', '#btndeleterasio', function() {
            const id = $(this).data('id');
            swal({
                title: 'Apakah anda yakin?',
                text: "Anda tidak akan dapat mengembalikan hasil analisis " + id + "!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, Hapus!'
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '<?= base_url('Analisis/rasiodelete'); ?>',
                        data: {
                            id: id
                        },
                        method: 'post',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            window.location.href = '<?= base_url('Analisis/hasilanalisis/b'); ?>';
                        },
                        error: function(data) {
                            alert('error')
                        }
                    });
                }
            });
        });

        $('#myTable').on('click', '#btndeletepangsaperu', function() {
            const id = $(this).data('id');
            swal({
                title: 'Apakah anda yakin?',
                text: "Anda tidak akan dapat mengembalikan hasil analisis " + id + "!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, Hapus!'
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '<?= base_url('Analisis/pangsaperudelete'); ?>',
                        data: {
                            id: id
                        },
                        method: 'post',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            window.location.href = '<?= base_url('Analisis/hasilanalisis/a'); ?>';
                        },
                        error: function(data) {
                            alert('error')
                        }
                    });
                }
            });
        });

        $('#example23').on('click', '#btndlttahunajaran', function() {
            const id = $(this).data('id');
            swal({
                title: 'Apakah anda yakin?',
                text: "Anda akan mengahpus data siswa tahun ajaran " + id + "/" + (id + 1) + " !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, Hapus!'
            }, function(isConfirm) {
                if (isConfirm) {
                    window.location.href = '<?= base_url('Siswa/deletetahunajaran/'); ?>' + id;
                }
            });
        });

        $('#divbtntahunbaru').on('click', '#btntahunbaru', function() {
            const id = $(this).data('id');
            swal({
                title: 'Apakah anda yakin?',
                text: "Anda akan memulai tahun ajaran baru " + id,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya!'
            }, function(isConfirm) {
                if (isConfirm) {
                    $("#alerttopright").fadeToggle(350);
                    $('#modal-kotak , #bg').fadeIn("slow");

                    window.location.href = '<?= base_url('Kelas/tahunajaranbaru'); ?>';
                }
            });
        });

        $('#divlola1').on('click', '#btnlola1', function() {
            console.log('btnlola');
            $('#simepen').css('display', 'block');
        });
        $('#divlola2').on('click', '#btnlola2', function() {
            console.log('btnlola');
            $('#simepen').css('display', 'block');
        });
        $('#divlola3').on('click', '#btnlola3', function() {
            console.log('btnlola');
            $('#simepen').css('display', 'block');
        });
        $('#divlola4').on('click', '#btnlola4', function() {
            $('#simepen').css('display', 'block');
        });
        $('#divlola5').on('click', '#btnlola5', function() {
            console.log('btnlola');
            $('#simepen').css('display', 'block');
        });


    });
</script>

<script type="text/javascript">
    //Alerts
    $(".myadmin-alert .closed").click(function(event) {
        $(this).parents(".myadmin-alert").fadeToggle(350);
        return false;
    });
    /* Click to close */
    $(".myadmin-alert-click").click(function(event) {
        $(this).fadeToggle(350);
        return false;
    });
    $(".showtop").click(function() {
        $(".alerttop").fadeToggle(350);
    });
    $(".showtop2").click(function() {
        $(".alerttop2").fadeToggle(350);
    });
    /** Alert Position Bottom  **/
    $(".showbottom").click(function() {
        $(".alertbottom").fadeToggle(350);
    });
    $(".showbottom2").click(function() {
        $(".alertbottom2").fadeToggle(350);
    });
    /** Alert Position Top Left  **/
    $("#showtopleft").click(function() {
        $("#alerttopleft").fadeToggle(350);
    });
    /** Alert Position Top Right  **/
    $("#showtopright").click(function() {
        $("#alerttopright").fadeToggle(350);
    });
    /** Alert Position Bottom Left  **/
    $("#showbottomleft").click(function() {
        $("#alertbottomleft").fadeToggle(350);
    });
    /** Alert Position Bottom Right  **/
    $("#showbottomright").click(function() {
        $("#alertbottomright").fadeToggle(350);
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tombol').click(function() {
            $('#modal-kotak , #bg').fadeIn("slow");
        });
        $('#tombol-tutup').click(function() {
            $('#modal-kotak , #bg').fadeOut("slow");
        });
    });
</script>


<script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();
        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });
        // Used events
        var drEvent = $('#input-file-events').dropify();
        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });
        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });
        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });
        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
</script>
<script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        var grafik = document.getElementById('grafik');

        if (grafik) {

            console.log('grafik');
            Morris.Area({
                element: 'morris-area-charto',
                data: [
                    <?php
                    $gr = count($_SESSION['linear']);
                    for ($i = 0; $i < $gr; $i++) {
                        echo "{period: '" . ($_SESSION['linear'][$i + 1][0]) . "'";
                        echo ",TAV: " . (round($_SESSION['linear'][$i + 1][1]['Y'] / $_SESSION['linear'][$i + 1][1]['Jur'] * 100, 2));
                        echo ",TKJ: " . (round($_SESSION['linear'][$i + 1][2]['Y'] / $_SESSION['linear'][$i + 1][2]['Jur'] * 100, 2));
                        echo ",TKR: " . (round($_SESSION['linear'][$i + 1][3]['Y'] / $_SESSION['linear'][$i + 1][3]['Jur'] * 100, 2)) . "},";
                    }
                    ?>
                    // {
                    //     period: '2017',
                    //     TAV: 20,
                    //     TKJ: 22,
                    //     TKR: 29
                    // }, {
                    //     period: '2018',
                    //     TAV: 25,
                    //     TKJ: 14,
                    //     TKR: 22
                    // },
                    // {
                    //     period: '2019',
                    //     TAV: 15,
                    //     TKJ: 13,
                    //     TKR: 20
                    // }

                ],
                xkey: 'period',
                ykeys: ['TAV', 'TKJ', 'TKR'],
                labels: ['TAV', 'TKJ', 'TKR'],
                pointSize: 3,
                fillOpacity: 0,
                pointStrokeColors: ['#00bfc7', '#fdc006', '#9675ce'],
                behaveLikeLine: true,
                gridLineColor: '#e0e0e0',
                lineWidth: 1,
                hideHover: 'auto',
                lineColors: ['#00bfc7', '#fdc006', '#9675ce'],
                resize: true

            });
        }
    });
</script>

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
<script>
    $(function() {

        var i = 1;
        $('#dynamic_field').on('click', '#add', function() {
            i++;
            $('#dynamic_field').append('<div class="col-md-10" id="row' + i + '"><input type="text" class="form-control" id="NamaBk" name="NamaBk[]"></div><div class="col-md-2" id="rowx' + i + '"><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Hapus</button></div>');
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
            $('#rowx' + button_id + '').remove();
        });
    });
</script>
<!-- <script src="<?php // echo base_url('assets/BackEnd/') 
                    ?>js/dashboard1.js"></script> -->
<!-- Custom tab JavaScript -->
<script src="<?= base_url('assets/BackEnd/') ?>js/cbpFWTabs.js"></script>
<script type="text/javascript">
    (function() {
        [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
            new CBPFWTabs(el);
        });
    })();
</script>

<script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/toast-master/js/jquery.toast.js"></script>

<script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>
<script src="<?= base_url('assets/BackEnd/') ?>js/mask.js"></script>
<script src="<?= base_url('assets/BackEnd/') ?>js/chat.js"></script>

<!--Style Switcher -->
<script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
<!-- EASY PIE CHART JS -->
<script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
<script src="<?= base_url('assets/BackEnd/') ?>plugins/bower_components/jquery.easy-pie-chart/easy-pie-chart.init.js"></script>
</body>

</html>