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
                        <form method="POST" action="<?= base_url('Printraport/index'); ?>">
                            <div class="form-group" style="margin-bottom: 50px">
                                <div class="col-sm-4">
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
                                <div class="col-sm-3">
                                    <select class="form-control" id="kelas" name="kelas">
                                        <option value='0' <?php if ($kel == 0) echo 'Selected'; ?>>--Pilih Kelas--</option>
                                        <option value='10' <?php if ($kel == 10) echo 'Selected'; ?>>Kelas X </option>
                                        <option value='11' <?php if ($kel == 11) echo 'Selected'; ?>>Kelas XI </option>
                                        <option value='12' <?php if ($kel == 12) echo 'Selected'; ?>>Kelas XII </option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
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
                                            <th class="text-center">NOMOR INDUK</th>
                                            <th class="text-center">NISN</th>
                                            <th class="text-center">NAMA SISWA</th>
                                            <th class="text-center">KELAS</th>
                                            <th class="text-center">JURUSAN</th>
                                            <th class="text-center">SEMESTER 1</th>
                                            <th class="text-center">SEMESTER 2</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($kelas as $kl) { ?>
                                            <tr>

                                                <td class="text-center"><?= $i++ ?></td>
                                                <td class="text-center"><?= $kl['Nomor_induk'] ?></td>
                                                <td class="text-center"><?= $kl['NISN'] ?></td>
                                                <td><?= $kl['Nama_siswa'] ?></td>
                                                <td class="text-center"><?= $no ?></td>
                                                <td class="text-center"><?= $kl['Kode_jurusan'] ?></td>
                                                <td class="text-center">
                                                    <?= "<a style='color: red; ' href='" . base_url('Printpdf/print/') . $kl['Nomor_induk'] . "/" . $no . "/1" . "' type='button' class='btn waves-effect waves-light m-r-10' target='_blank'>
                                            <i class='fa fa-print m-r-5'></i>
                                            <span>Print</span>
                                            </a>" ?>

                                                    <?= "<a style='color: green; ' href='" . base_url('Printpdf/download/') . $kl['Nomor_induk'] . "/" . $no . "/1"  . "' type='button' class='btn waves-effect waves-light m-r-10' target='_blank'>
                                            <i class='fa fa-download m-r-5'></i>
                                            <span>Download</span>
                                            </a>" ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= "<a style='color: red; ' href='" . base_url('Printpdf/print/') . $kl['Nomor_induk'] . "/" . $no . "/2"   . "' type='button' class='btn waves-effect waves-light m-r-10' target='_blank'>
                                            <i class='fa fa-print m-r-5'></i>
                                            <span>Print</span>
                                            </a>" ?>

                                                    <?= "<a style='color: green; ' href='" . base_url('Printpdf/download/') . $kl['Nomor_induk'] . "/" . $no . "/2"   . "' type='button' class='btn waves-effect waves-light m-r-10' target='_blank'>
                                            <i class='fa fa-download m-r-5'></i>
                                            <span>Download</span>
                                            </a>" ?>
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