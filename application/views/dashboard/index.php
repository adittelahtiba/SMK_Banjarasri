<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Dashboard</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            </div>
        </div>



        <!-- ================================================================== -->
        <!-- tahun body -->
        <!-- ================================================================== -->

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">Selamat Datang, <?= $this->session->userdata('name'); ?></div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <?= $this->session->flashdata('message'); ?>
                        <div class="panel-body">
                            <?php
                            $i = 0;
                            $totalperu;
                            $totalpenye;
                            $array_pangsa;
                            foreach ($perusahaan as $peru) {
                                if ($peru['Nama_jurusan'] == '') {
                                } else {
                                }

                                if ($peru['Penyerapan']) {

                                    $array_pangsa['penyerapan'][$i] = $peru['Penyerapan'];
                                } else {

                                    $array_pangsa['penyerapan'][$i] = 0;
                                }
                                $totalperu[$i] = $peru['Jumlah'];
                                $totalpenye[$i] = $peru['Penyerapan'];
                                $array_pangsa['jumlahperu'][$i] = $peru['Jumlah'];
                                $i++;
                            }


                            $i = 0;
                            $totalsiswa;
                            foreach ($jumlahsiswa2 as $js) {

                                $totalsiswa[$i] = $js['Jumlah_siswa'];
                                $array_pangsa['kodejurusan'][$i] = $js['Kode_jurusan'];
                                $array_pangsa['namajurusan'][$i] = $js['Nama_jurusan'];
                                $array_pangsa['jumlahsiswa'][$i] = $js['Jumlah_siswa'];
                                $array_pangsa['sisasiswa'][$i] = $js['Jumlah_siswa'] - $array_pangsa['penyerapan'][$i];
                                $i++;
                            }
                            ?>



                            <?php
                            $i = 0;
                            $pangs;
                            foreach ($perusahaan as $peru) {
                                if ($peru['Nama_jurusan'] <> '') {
                                    $pangs[$i]['Jur'] = $peru['Nama_jurusan'];
                                    $pangs[$i]['pers'] = round($totalpenye[$i] / $totalsiswa[$i] * 100, 2);
                                    $i++;
                                }
                            }

                            ?>
                            <div class="col-sm-12">
                                <div class="white-box">
                                    <h3 class="box-title">Persentase Pangsa Pasar</h3>
                                    <div class="row text-center">
                                        <div class="col-md-3">
                                            <div class="col-md-12">
                                                <div data-label="<?= round(array_sum($totalpenye) / array_sum($totalsiswa) * 100, 2) . "%"; ?>" class="css-bar css-bar-<?= (round(array_sum($totalpenye) / array_sum($totalsiswa) * 100 / 5, 0) * 5); ?> css-bar-lg css-bar-default"><label></label></div>
                                            </div>
                                            <div class="col-md-12">
                                                Pangsa Pasar Keseluruhan
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="col-md-12">
                                                <div data-label="<?= $pangs[0]['pers']; ?>%" class="css-bar css-bar-<?= (round($pangs[0]['pers'] / 5, 0) * 5); ?> css-bar-lg"></div>
                                            </div>
                                            <div class="col-md-12">
                                                Jurusan <?= $pangs[0]['Jur']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="col-md-12">
                                                <div data-label="<?= $pangs[1]['pers']; ?>%" class="css-bar css-bar-<?= (round($pangs[1]['pers'] / 5, 0) * 5); ?> css-bar-lg css-bar-success"></div>
                                            </div>
                                            <div class="col-md-12">
                                                Jurusan <?= $pangs[1]['Jur']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="col-md-12">
                                                <div data-label="<?= $pangs[2]['pers']; ?>%" class="css-bar css-bar-<?= (round($pangs[2]['pers'] / 5, 0) * 5); ?> css-bar-lg css-bar-warning"></div>
                                            </div>
                                            <div class="col-md-12">
                                                Jurusan <?= $pangs[2]['Jur']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <a href="<?= base_url('Dashboard/info'); ?>"><button class="btn btn-outline btn-info btn-lg btn-block">Informasi Lainya</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="panel-body">
                        <div class="col-sm-6">
                            <h4>Rekomendasi perusahaan dari hasil tracer alumni</h4>
                        </div>
                        <form method="POST" action="<?= base_url('Perusahaan/nonpatner'); ?>">
                            <div class="col-sm-4">
                                <select class="form-control" id="kodejurusan" name="kodejurusan">
                                    <option value='-' Selected>Jurusan </option>
                                    <option value='TAV'>Jurusan Teknik Audio dan Video</option>
                                    <option value='TKJ'>Jurusan Teknik Komputer Jaringan</option>
                                    <option value='TKR'>Jurusan Teknik Kendaraan Ringan</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-block btn-info">Tampilkan</button>
                            </div>
                        </form>
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="example23" class="table table-striped table color-bordered-table info-bordered-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nama Perusahaan</th>
                                            <th class="text-center">Jumlah Alumni Bekerja</th>
                                            <th class="text-center">Sesuai Linear Kompetensi</th>
                                            <th class="text-center">Tidak Sesuai Linear Kompetensi</th>
                                            <th class="text-center">Merasa Puas</th>
                                            <th class="text-center">Tidak Merasa Puas</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                            </div>
                            <?php
                            $i = 1;
                            foreach ($situasiperu as $peru) {
                                echo "<tr>";
                                echo "<td class='text-center'>" . $i++ . "</td>";
                                echo "<td class='text-center'>" . $peru['Bekerja'];
                                echo "<td class='text-center'>" . $peru['Jumlah'];
                                echo "<td class='text-center'>" . $peru['LinearY'];
                                echo "<td class='text-center'>" . $peru['LinearT'];
                                echo "<td class='text-center'>" . $peru['PuasY'];
                                echo "<td class='text-center'>" . $peru['PuasT'];
                            }
                            ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>