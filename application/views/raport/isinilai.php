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
        <form method="POST" action="<?= base_url('Isinilai/savemanual'); ?>">
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
                                                    <td><?= $nilai['Nama_siswa'] ?></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"><?= $mapel['KKM']; ?></td>
                                                    <td class="text-center"><input type="number" name="Angka1[<?= $i - 2 ?>]" class="form-control" value="<?= $nilai['Angka1'] ?>"></td>
                                                    <td class="text-center"><?php if ($nilai['Angka1'] <> null) {
                                                                                echo " <input type='text' name='tindak[" . ($i - 2) . "]' value='edit' hidden>";
                                                                                if ($nilai['Angka1'] >= 80) {
                                                                                    echo "A";
                                                                                } elseif ($nilai['Angka1'] >= 65 and $nilai['Angka1'] < 80) {
                                                                                    echo "B";
                                                                                } elseif ($nilai['Angka1'] >= 50 and $nilai['Angka1'] < 65) {
                                                                                    echo "C";
                                                                                } elseif ($nilai['Angka1'] >= 35 and $nilai['Angka1'] < 50) {
                                                                                    echo "D";
                                                                                } else {
                                                                                    echo "E";
                                                                                }
                                                                            } else {
                                                                                echo " <input type='text' name='tindak[" . ($i - 2) . "]' value='insert' hidden>";
                                                                                echo "T";
                                                                            } ?></td>
                                                    <td class="text-center"><textarea name="Deskripsi1[<?= $i - 2 ?>]" class="form-control"><?= $nilai['Deskripsi1'] ?></textarea></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"><?= $mapel['KKM']; ?></td>
                                                    <td class="text-center"><input type="number" name="Angka2[<?= $i - 2 ?>]" class="form-control" value="<?= $nilai['Angka2'] ?>"></td>
                                                    <td class="text-center"><?php if ($nilai['Angka2'] <> null) {
                                                                                if ($nilai['Angka2'] >= 80) {
                                                                                    echo "A";
                                                                                } elseif ($nilai['Angka2'] >= 65 and $nilai['Angka2'] < 80) {
                                                                                    echo "B";
                                                                                } elseif ($nilai['Angka2'] >= 50 and $nilai['Angka2'] < 65) {
                                                                                    echo "C";
                                                                                } elseif ($nilai['Angka2'] >= 35 and $nilai['Angka2'] < 50) {
                                                                                    echo "D";
                                                                                } else {
                                                                                    echo "E";
                                                                                }
                                                                            } else {
                                                                                echo "T";
                                                                            } ?></td>
                                                    <td class="text-center"><textarea name="Deskripsi2[<?= $i - 2 ?>]" class="form-control"><?= $nilai['Deskripsi2'] ?></textarea></td>
                                                    <td class="text-center"></td>
                                                    <input type="text" name="Nomor_induk[<?= $i - 2 ?>]" value="<?= $nilai['Nomor_induk'] ?>" hidden>
                                                    <input type="text" name="Kode_mapel[<?= $i - 2 ?>]" value="<?= $mapel['Kode_mapel'] ?>" hidden>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-success btn-lg btn-block">SIMPAN NILAI</button>
        </form>
    </div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>