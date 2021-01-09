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
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <?= $this->session->flashdata('message') ?>


                        <div class="wow">
                            <form method="POST" action="<?= base_url('Situasialumni/alumni'); ?>">

                                <div class="form-group" style="margin-bottom: 50px">
                                    <div class="col-sm-5">
                                        <select class="form-control" id="kodejurusan" name="kodejurusan">
                                            <?php
                                            foreach ($jurusan as $jur) {
                                                echo "<option value='" . $jur['Kode_jurusan'] . "'";
                                                if ($jur['Kode_jurusan'] == $kodejurusan) echo 'Selected';
                                                echo ">Jurusan " . $jur['Nama_jurusan'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-5">
                                        <select class="form-control" id="tahunajaran" name="tahunajaran">
                                            <?php
                                            foreach ($tahun as $tah) {
                                                $tahun2 = $tah['Tahun_masuk'] + 1;
                                                echo "<option value='" . $tah['Tahun_masuk'] . "'";
                                                if ($tah['Tahun_masuk'] == $tahunajaran) echo 'Selected';
                                                echo ">Tahun Ajaran " . $tah['Tahun_masuk'] . "/" . $tahun2 . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-block btn-info">Tampilkan</button>
                                    </div>



                                    <div class="col-sm-12">
                                        <hr>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <!-- <a href="#" id="modaltambah" data-toggle="modal" data-target="#responsive-modal"><h3 class="box-title m-b-30">Tambah Data</h3></a> -->



                        <div class="row">
                            <div class="col-sm-12">
                                <div class="white-box">

                                    <div class="table-responsive">
                                        <table id="example23" class="table table-striped table color-bordered-table danger-bordered-table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">NOMOR INDUK</th>
                                                    <th class="text-center">NAMA SISWA</th>
                                                    <th class="text-center">L/P</th>
                                                    <th class="text-center">BEKERJA</th>
                                                    <th class="text-center">WIRASWASTA</th>
                                                    <th class="text-center">KULIAH</th>
                                                    <th class="text-center">PENCAKER</th>
                                                    <th class="text-center">GAJI PERTAMA</th>
                                                    <th class="text-center">WAKTU TUNGGU</th>
                                                    <th class="text-center">LINEAR KOMPETENSI</th>
                                                    <th class="text-center">KEPUASAN KERJA</th>
                                                    <th class="text-center">KETERANGAN</th>
                                                    <th class="text-center">AKSI</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tabelsituasi">
                                                <?php $i = 1;
                                                foreach ($situasialumni as $sa) { ?>
                                                    <tr>
                                                        <td class="text-center"><?= $i++ ?></td>
                                                        <td class="text-center"><?= $sa['Nomor_induk'] ?></td>
                                                        <td class="text-center"><?= $sa['Nama_siswa'] ?></td>
                                                        <td class="text-center"><?= $sa['Jenis_kelamin'] ?></td>
                                                        <td class="text-center"><?= $sa['Bekerja'] ?></td>
                                                        <td class="text-center"><?= $sa['Wiraswasta'] ?></td>
                                                        <td class="text-center"><?= $sa['Kuliah'] ?></td>
                                                        <td class="text-center"><?= $sa['Pencaker'] ?></td>
                                                        <td class="text-center"><?= $sa['Gaji_pertama'] ?></td>
                                                        <td class="text-center"><?= $sa['Waktu_tunggu'] ?></td>
                                                        <td class="text-center"><?= $sa['Linear_kompetensi'] ?></td>
                                                        <td class="text-center"><?= $sa['Kepuasan_kerja'] ?></td>
                                                        <td class="text-center"><?= $sa['Keterangan'] ?></td>
                                                        <td class="text-center">
                                                            <a href="<?= base_url('Situasialumni/edit'); ?>/<?= $sa['Nomor_induk']; ?>"><button type="button" class="btn btn-warning btn-circle">
                                                                    <i class=" fa fa-edit"></i>
                                                                </button></a>
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
                </div>
            </div>
        </div>
    </div>
</div>