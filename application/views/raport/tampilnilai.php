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
                    <div class="panel-body">
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="smptable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center" rowspan="2">#</th>
                                            <th class="text-center" rowspan="2">NOMOR INDUK</th>
                                            <th class="text-center" rowspan="2">NAMA SISWA</th>
                                            <th class="text-center" rowspan="2"></th>
                                            <th class="text-center" colspan="4">PENGETAHUAN</th>
                                            <th class="text-center" rowspan="2"></th>
                                            <th class="text-center" colspan="4">KETERAMPILAN</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">KKM</th>
                                            <th class="text-center">NILAI</th>
                                            <th class="text-center">PREDIKAT</th>
                                            <th class="text-center">DESKRIPSI</th>
                                            <th class="text-center">KKM</th>
                                            <th class="text-center">NILAI</th>
                                            <th class="text-center">PREDIKAT</th>
                                            <th class="text-center">DESKRIPSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $i = 1;
                                        foreach ($nilai as $nilai) { ?>
                                            <tr>

                                                <td class="text-center"><?= $i++ ?></td>
                                                <td class="text-center"><?= $nilai['Nomor_induk'] ?></td>
                                                <td class="text-center"><?= $nilai['Nama_siswa'] ?></td>
                                                <td class="text-center"><?= $nilai['KKM'] ?></td>
                                                <td class="text-center"><?= $nilai['Angka1'] ?></td>
                                                <td class="text-center"><?= $nilai['Deskripsi2'] ?></td>
                                                <td class="text-center"><?= $nilai['KKM'] ?></td>
                                                <td class="text-center"><?= $nilai['Angka2'] ?></td>
                                                <td class="text-center"><?= $nilai['Deskripsi2'] ?></td>
                                                <td class="text-center">

                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-success btn-lg btn-block">SIMPAN NILAI</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>