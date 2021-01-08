<?php if ($this->session->userdata('level') < 4) {
    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Anda tidak memiliki hak akses ke halaman tersebut!</div>');
    redirect('Dashboard');
} ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Data <?= $title ?></h4>
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

                    <div class="wow" style="margin-bottom: 10px">
                        <a href="<?= base_url('Kelas/kelolasiswa/a') ?>" type="button" class="btn btn-success waves-effect waves-light m-r-10">

                            <span>Kelola Siswa</span>
                        </a>
                    </div>
                    <!-- <a href="#" id="modaltambah" data-toggle="modal" data-target="#responsive-modal"><h3 class="box-title m-b-30">Tambah Data</h3></a> -->
                    <div>
                        <?= $this->session->flashdata('message') ?>
                    </div>

                    <div class="table-responsive">
                        <table id="example23" class="table table-striped table color-bordered-table danger-bordered-table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Aksi</th>
                                    <th class="text-center">Tahun Ajaran</th>
                                    <th class="text-center">Jumlah SIswa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($siswapertahun as $kl) { ?>
                                    <tr>

                                        <td class="text-center"><?= $i++ ?></td>
                                        <td class="text-center">
                                            <?php if ($i == 2) { ?>
                                                <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" id="btndlttahunajaran" data-id="<?= $kl['Tahun_ajaran']; ?>">
                                                    <i class="ti-trash"></i>
                                                </button>
                                            <?php   } ?>
                                        </td>
                                        <td class="text-center"><?= $kl['Tahun_ajaran'] . "/" . ($kl['Tahun_ajaran'] + 1) ?></td>
                                        <td class="text-center"><?= $kl['Jumlah_siswa'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>