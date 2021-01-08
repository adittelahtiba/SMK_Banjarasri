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
                        <a href="<?= base_url('pegawai/add') ?>" type="button" class="btn btn-success waves-effect waves-light m-r-10">
                            <i class="fa fa-plus m-r-5"></i>
                            <span>Tambah Data</span>
                        </a>

                    </div>

                    <!-- <?php var_dump($pegawai); ?> -->
                    <!-- <a href="#" id="modaltambah" data-toggle="modal" data-target="#responsive-modal"><h3 class="box-title m-b-30">Tambah Data</h3></a> -->

                    <div class="table-responsive">
                        <table id="example23" class="table table-striped table color-bordered-table danger-bordered-table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">NIP</th>
                                    <th class="text-center">Nama Guru</th>
                                    <th class="text-center">Tempat, Tanggal Lahir</th>
                                    <th class="text-center">Pendidikan</th>
                                    <th class="text-center">Jurusan</th>
                                    <th class="text-center">NUPTK</th>
                                    <th class="text-center">Jabatan</th>
                                    <th class="text-center">Tugas Tambahan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Nomor Telepon</th>
                                    <th class="text-center">Email</th>
                                    <?php if ($this->session->userdata('level') > 3) { ?>

                                        <th class="text-center">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($pegawai as $pg) { ?>
                                    <tr>
                                        <td class="text-center"><?= $i++ ?></td>
                                        <td class="text-center">'<?= $pg['NIP'] ?></td>
                                        <td class="text-center"><?= $pg['Nama'] ?></td>
                                        <td class="text-center"><?= $pg['Tempat_lahir'] . ", " . $pg['Tanggal_lahir'] ?></td>
                                        <td class="text-center"><?= $pg['Pendidikan'] ?></td>
                                        <td class="text-center"><?= $pg['Jurusan'] ?></td>
                                        <td class="text-center">'<?= $pg['NUPTK'] ?></td>
                                        <td class="text-center"><?= $pg['Jabatan'] ?></td>
                                        <td class="text-center"><?= $pg['Tugas_tambah'] ?></td>
                                        <td class="text-center"><?= $pg['Status'] ?></td>
                                        <td class="text-center"><?= $pg['Nomor_telp'] ?></td>
                                        <td class="text-center"><?= $pg['Email'] ?></td>
                                        <?php if ($this->session->userdata('level') > 3) { ?>
                                            <td class="text-center">
                                                <?php if ($pg['Level'] <> 4) { ?>
                                                    <a href="<?= base_url('Pegawai/edit'); ?>/<?= $pg['Id_peg']; ?>"><button type="button" class="btn btn-warning btn-circle">
                                                            <i class=" fa fa-edit"></i>
                                                        </button></a>
                                                    <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" id="btndelete" data-id="<?= $pg['NIP']; ?>">
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