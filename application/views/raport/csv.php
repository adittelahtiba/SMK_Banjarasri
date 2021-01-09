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
            <div class="col-md-12">
                <div class="white-box">
                    <?= $this->session->flashdata('message') ?>


                    <div class="panel-body">
                        <div class="col-md-12">
                            <h2 class="text-center"><?= $mapel['Kode_mapel'] . ' - ' . $mapel['Nama_mapel']; ?></h2>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="example23" class="table table-striped table color-bordered-table info-bordered-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th class="text-center"></th>
                                            <th class="text-center"></th>
                                            <th class="text-center" colspan="3">PENGETAHUAN</th>
                                            <th class="text-center" colspan="3">KETERAMPILAN</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">NOMOR INDUK</th>
                                            <th class="text-center">NAMA SISWA</th>
                                            <th class="text-center">KKM</th>
                                            <th class="text-center">NILAI</th>
                                            <th class="text-center">DESKRIPSI</th>
                                            <th class="text-center">KKM</th>
                                            <th class="text-center">NILAI</th>
                                            <th class="text-center">DESKRIPSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $i = 1;
                                        foreach ($nilai as $nilai) { ?>
                                            <tr>

                                                <td class="text-center"><?= $i++ ?></td>
                                                <td class="text-center"><?= $nilai['Nomor_induk'] ?></td>
                                                <td><?= $nilai['Nama_siswa'] ?></td>
                                                <td class="text-center"><?= $mapel['KKM']; ?></td>
                                                <td class="text-center"><?php if ($nilai['Angka1'] > 0) echo $nilai['Angka1']; ?></td>
                                                <td class=>
                                                    <?= $nilai['Deskripsi1'] ?></td>

                                                <td class="text-center"><?= $mapel['KKM']; ?></td>
                                                <td class="text-center"><?php if ($nilai['Angka2'] > 0) echo $nilai['Angka2']; ?></td>
                                                <td class=><?= $nilai['Deskripsi2'] ?></td>
                                                <input type="text" name="Nomor_induk[<?= $i - 2 ?>]" value="<?= $nilai['Nomor_induk'] ?>" hidden>
                                                <input type="text" name="Kode_mapel[<?= $i - 2 ?>]" value="<?= $mapel['Kode_mapel'] ?>" hidden>
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