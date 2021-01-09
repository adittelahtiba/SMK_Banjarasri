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
                    <?= $this->session->flashdata('message') ?>
                    <div class="wow" style="margin-bottom: 10px">
                        <a href="<?= base_url('Perusahaan/add') ?>" type="button" class="btn btn-success waves-effect waves-light m-r-10">
                            <i class="fa fa-plus m-r-5"></i>
                            <span>Tambah Data</span>
                        </a>
                    </div>
                    <!-- <a href="#" id="modaltambah" data-toggle="modal" data-target="#responsive-modal"><h3 class="box-title m-b-30">Tambah Data</h3></a> -->

                    <div class="table-responsive">
                        <table id="example23" class="table table-striped table color-bordered-table danger-bordered-table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nama Perusahaan</th>
                                    <th class="text-center">Tanggal Kontrak</th>
                                    <th class="text-center">Lama Kontrak</th>
                                    <th class="text-center">Pihak Kedua</th>
                                    <th class="text-center">Jumlah Penyerapan</th>
                                    <th class="text-center">Aktif</th>
                                    <th class="text-center">Kode Jurusan</th>
                                    <?php if ($this->session->userdata('level') > 0) { ?>
                                        <th class="text-center">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($perusahaan as $pr) { ?>
                                    <tr>
                                        <td class="text-center"><?= $i++ ?></td>
                                        <td class="text-center"><?= $pr['Nama_perusahaan'] ?></td>
                                        <td class="text-center"><?= $pr['Tanggal_kontrak'] ?></td>
                                        <td class="text-center"><?= $pr['Lama_kontrak'] ?></td>
                                        <td class="text-center"><?= $pr['Pihak_kedua'] ?></td>
                                        <td class="text-center"><?= $pr['Jumlah_penyerapan'] ?></td>
                                        <td class="text-center"><?= $pr['Aktif'] ?></td>
                                        <td class="text-center"><?= $pr['Kode_jurusan'] ?></td>
                                        <?php if ($this->session->userdata('level') > 0) { ?>
                                            <td class="text-center">
                                                <a href="<?= base_url('Perusahaan/edit'); ?>/<?= $pr['Id_perusahaan']; ?>"><button type="button" class="btn btn-warning btn-circle">
                                                        <i class=" fa fa-edit"></i>
                                                    </button></a>
                                                <?php if ($this->session->userdata('level') > 1) { ?>
                                                    <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" id="btndeleteperu" data-peru="<?= $pr['Nama_perusahaan'] ?>" data-id="<?= $pr['Id_perusahaan']; ?>">
                                                        <i class="ti-trash"></i>
                                                    </button>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>