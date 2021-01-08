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
                        <form method="POST" action="<?= base_url('Isinilai/manual/'); ?>">
                            <div class="form-group" style="margin-bottom: 50px">
                                <div class="col-sm-4">
                                    <select class="form-control" id="kodejurusan" name="kodejurusan">
                                        <option value='-' <?php if ($jur == '-') echo 'Selected'; ?>>--Pilih Jurusan--</option>
                                        <option value='TAV' <?php if ($jur == 'TAV') echo 'Selected'; ?>>Jurusan Teknik Audio dan Video</option>
                                        <option value='TKJ' <?php if ($jur == 'TKJ') echo 'Selected'; ?>>Jurusan Teknik Komputer Jaringan</option>
                                        <option value='TKR' <?php if ($jur == 'TKR') echo 'Selected'; ?>>Jurusan Teknik Kendaraan Ringan</option>
                                    </select>
                                    <?php if ($jur == '-') {
                                        echo "<span style='color: #ffc800;' class='form-control-feedback fa  fa-exclamation-circle'></span>";
                                    } else {
                                        echo "<span style='color: #00ff1f;' class='form-control-feedback fa fa-check-circle'></span>";
                                    } ?>
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" id="kelas" name="kelas">
                                        <option value='0' <?php if ($kel == 0) echo 'Selected'; ?>>--Pilih Kelas--</option>
                                        <option value='10' <?php if ($kel == 10) echo 'Selected'; ?>>Kelas X </option>
                                        <option value='11' <?php if ($kel == 11) echo 'Selected'; ?>>Kelas XI </option>
                                        <option value='12' <?php if ($kel == 12) echo 'Selected'; ?>>Kelas XII </option>
                                    </select>
                                    <?php if ($kel == 0) {
                                        echo "<span style='color: #ffc800;' class='form-control-feedback fa  fa-exclamation-circle'></span>";
                                    } else {
                                        echo "<span style='color: #00ff1f;' class='form-control-feedback fa fa-check-circle'></span>";
                                    } ?>
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" id="semester" name="semester">
                                        <option value=' 0' <?php if ($sem == 0) echo 'Selected'; ?>>--Pilih Semester--</option>
                                        <option value='1' <?php if ($sem == 1) echo 'Selected'; ?>>1 (Ganjil) </option>
                                        <option value='2' <?php if ($sem == 2) echo 'Selected'; ?>>2 (Genap) </option>
                                    </select>
                                    <?php if ($sem == 0) {
                                        echo "<span style='color: #ffc800;' class='form-control-feedback fa  fa-exclamation-circle'></span>";
                                    } else {
                                        echo "<span style='color: #00ff1f;' class='form-control-feedback fa fa-check-circle'></span>";
                                    } ?>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-block btn-info">Tampilkan</button>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped table color-bordered-table info-bordered-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">KODE MAPEL</th>
                                            <th class="text-center">NAMA MAPEL</th>
                                            <th class="text-center">KATEGORI</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($mapel as $mpl) { ?>
                                            <tr>

                                                <td class="text-center"><?= $i++ ?></td>
                                                <td class="text-center"><?= $mpl['Kode_mapel'] ?></td>
                                                <td><?= $mpl['Nama_mapel'] ?></td>
                                                <td><?= $mpl['Kategori'] ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('Isinilai/isimanual/') . $mpl['Kode_mapel'] ?>"><button class="btn btn-outline btn-success btn-lg btn-block">ISI NILAI SISWA</button></a>

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