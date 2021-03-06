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
                        <table id="myTable" class="table table-striped table color-bordered-table danger-bordered-table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">NOMOR INDUK</th>
                                    <th class="text-center">NISN</th>
                                    <th class="text-center">NAMA SISWA</th>
                                    <th class="text-center">L/P</th>
                                    <th class="text-center">TEMPAT LAHIR</th>
                                    <th class="text-center">TANGGAL LAHIR</th>
                                    <th class="text-center">AGAMA</th>
                                    <th class="text-center">NAMA AYAH</th>
                                    <th class="text-center">NAMA IBU</th>
                                    <th class="text-center">PEKERJAAN ORTU</th>
                                    <th class="text-center">ALAMAT</th>
                                    <th class="text-center">ASAL SEKOLAH</th>
                                    <th class="text-center">MAMPU/TIDAK MAMPU</th>
                                    <th class="text-center">TAHUN MASUK</th>
                                    <th class="text-center">NOMOR IJAZAH</th>
                                    <th class="text-center">NOMOR SKHUN</th>
                                    <th class="text-center">NOMOR PESERTA</th>
                                    <th class="text-center">KETERANGAN</th>
                                    <th class="text-center">NOMOR TELEPON</th>
                                    <th class="text-center">EMAIL</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tabelsiswa">
                                <?php $i = 1;
                                foreach ($siswa as $kl) { ?>
                                    <tr>

                                        <td class="text-center"><?= $i++ ?></td>
                                        <td class="text-center"><?= $kl['Nomor_induk'] ?></td>
                                        <td class="text-center"><?= $kl['NISN'] ?></td>
                                        <td class="text-center"><?= $kl['Nama_siswa'] ?></td>
                                        <td class="text-center"><?= $kl['Jenis_kelamin'] ?></td>
                                        <td class="text-center"><?= $kl['Tempat_lahir'] ?></td>
                                        <td class="text-center"><?= $kl['Tanggal_lahir'] ?></td>
                                        <td class="text-center"><?= $kl['Agama'] ?></td>
                                        <td class="text-center"><?= $kl['Nama_ayah'] ?></td>
                                        <td class="text-center"><?= $kl['Nama_ibu'] ?></td>
                                        <td class="text-center"><?= $kl['Pekerjaan_ortu'] ?></td>
                                        <td class="text-center"><?= $kl['Alamat'] ?></td>
                                        <td class="text-center"><?= $kl['Asal_sekolah'] ?></td>
                                        <td class="text-center"><?= $kl['Status_keuangan'] ?></td>
                                        <td class="text-center"><?= $kl['Tahun_masuk'] ?></td>
                                        <td class="text-center"><?= $kl['Nomor_ijazah'] ?></td>
                                        <td class="text-center"><?= $kl['Nomor_skhun'] ?></td>
                                        <td class="text-center"><?= $kl['Nomor_peserta'] ?></td>
                                        <td class="text-center"><?= $kl['keterangan'] ?></td>
                                        <td class="text-center"><?= $kl['Nomor_telp'] ?></td>
                                        <td class="text-center"><?= $kl['Email'] ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" id="btndltsiswa" data-id="<?= $kl['Nomor_induk']; ?>">
                                                <i class="ti-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>