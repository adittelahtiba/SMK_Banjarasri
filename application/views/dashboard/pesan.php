<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Data <?= $title ?></h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="<?= base_url('Dashboard') ?>">Dashboard</a></li>
                    <li class="active"><?= $title ?></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="table-responsive manage-table">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>WAKTU</th>
                                    <th style="width: 150px;">NAMA PENGIRIM</th>
                                    <th>JABATAN</th>
                                    <th>PESAN</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($notif as $pesan) {
                                    $i++;
                                    if ($_SESSION['notif'] >= $i) { ?>
                                        <tr class="advance-table-row">
                                            <td></td>
                                            <td>
                                                <div class="checkbox checkbox-circle checkbox-info">
                                                    <input id="checkbox8" type="checkbox">
                                                    <label for="checkbox8"> </label>
                                                </div>
                                            </td>
                                        <?php } else { ?>
                                        <tr class=" advance-table-row active">
                                            <td style="width: 10px;"></td>
                                            <td style="width: 40px;">
                                                <div class="checkbox checkbox-circle checkbox-info">
                                                    <input id="checkbox7" checked="" type="checkbox" readonly>
                                                    <label for="checkbox7"> </label>
                                                </div>
                                            </td>
                                        <?php } ?>

                                        <td style="width: 60px;"><img src="<?= base_url('assets/BackEnd/img/profile/') . $pesan['Foto']  ?>" class="img-circle" alt="user img" width="30" /></td>
                                        <td><?= $pesan['Waktu']; ?></td>
                                        <td><?= $pesan['Nama']; ?></td>
                                        <td><?= $pesan['Tugas_tambah']; ?></td>
                                        <td><textarea class="form-control" readonly><?= $pesan['Email']; ?></textarea></td>
                                        <td>
                                            <?php

                                            if ($pesan['Kategori'] == 'pangsa') {
                                                echo "<a style='color: white; ' href='" . base_url('Analisis/pangsaperudetail/') . $pesan['Subject'] . "' type='button' class='btn btn-success waves-effect waves-light m-r-10'>
                                                 <i class='fa fa-external-link m-r-5'></i>
                                                 <span>Lihat detail</span>
                                             </a>";
                                            } else {

                                                echo "<a style='color: white; ' href='" . base_url('Analisis/rasiodetail/') . $pesan['Subject'] . "' type='button' class='btn btn-success waves-effect waves-light m-r-10'>
                                                 <i class='fa fa-external-link m-r-5'></i>
                                                 <span>Lihat detail</span>
                                             </a>";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-circle" data-toggle="modal" id="btndltnotif" data-id="<?= $pesan['id_notif']; ?>">
                                                <i class="ti-trash"></i>
                                            </button>
                                        </td>
                                        </tr>
                                    <?php
                                }
                                $_SESSION['notif'] = 0;
                                    ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>