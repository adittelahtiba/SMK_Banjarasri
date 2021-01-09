<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <a href="<?= base_url('Dashboard'); ?>">
                    <h4 class="page-title">Dashboard</h4>
                </a>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            </div>
        </div>



        <!-- ================================================================== -->
        <!-- tahun body -->
        <!-- ================================================================== -->


        <!-- grafik -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="white-box">
                    <h3 class="box-title" id="grafik">Grafik Persentase Situasi Alumni Sesuai Kompetensi</h3>
                    <ul class="list-inline text-right">
                        <li>
                            <h5><i class="fa fa-circle m-r-5" style="color: #00bfc7;"></i>TAV</h5>
                        </li>
                        <li>
                            <h5><i class="fa fa-circle m-r-5" style="color: #fdc006;"></i>TKJ</h5>
                        </li>
                        <li>
                            <h5><i class="fa fa-circle m-r-5" style="color: #9675ce;"></i>TKR</h5>
                        </li>
                    </ul>
                    <div id="morris-area-charto"></div>
                </div>
                <?php if ($this->session->userdata('level') > 0) { ?>
                    <div class="col-sm-12">
                        <a href="<?= base_url('Dashboard/formsitusi'); ?>"><button class="btn btn-outline btn-info btn-lg btn-block">Minta Alumni Mengisi data Situasi</button></a>
                    </div>
                <?php } ?>

            </div>
        </div>
        <!-- grafik end -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel-body">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-5 control-label">
                                    <h2 class="box-title m-b-0">Persentase Kompetensi Kerja Lulusan</h2>
                                </label>

                                <div class="col-md-3">
                                    <select class="form-control" id="jumlah_tahun">
                                        <?php

                                        $juml =  0 +  $jumlah_tahun['Jumlah_tahun'];
                                        for ($i = $juml; $i > 0; $i--) {
                                            echo  "<option value=" . $i . ">" . $i . " Tahun Terakhir</option>";
                                            $linear[$i][1]['Y'] = 0;
                                            $linear[$i][2]['Y'] = 0;
                                            $linear[$i][3]['Y'] = 0;
                                            $linear[$i][1]['T'] = 0;
                                            $linear[$i][2]['T'] = 0;
                                            $linear[$i][3]['T'] = 0;
                                            $linear[$i][1]['O'] = 0;
                                            $linear[$i][2]['O'] = 0;
                                            $linear[$i][3]['O'] = 0;
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div class="table-responsive">
                                <table id="example23">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th colspan="3" class="text-center">Jurusan TAV</th>
                                            <th></th>
                                            <th colspan="3" class="text-center">Jurusan TKJ</th>
                                            <th></th>
                                            <th colspan="3" class="text-center">Jurusan TKR</th>
                                            <th></th>
                                        </tr>

                                        <tr>
                                            <th>Tahun</th>
                                            <th class="text-center">Sesuai Linear Kompetensi</th>
                                            <th class="text-center">Tidak Sesuai Linear Kompetensi</th>
                                            <th class="text-center">Belum mengisi Data</th>
                                            <th></th>
                                            <th class="text-center">Sesuai Linear Kompetensi</th>
                                            <th class="text-center">Tidak Sesuai Linear Kompetensi</th>
                                            <th class="text-center">Belum mengisi Data</th>
                                            <th></th>
                                            <th class="text-center">Sesuai Linear Kompetensi</th>
                                            <th class="text-center">Tidak Sesuai Linear Kompetensi</th>
                                            <th class="text-center">Belum mengisi Data</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody id="tabelpersen">
                                        <?php
                                        $tahun = '';
                                        $jurusan = '';
                                        $i = 0;
                                        $j = 0;
                                        $y = 0;
                                        $t = 0;
                                        $o = 0;
                                        $jur = 0;
                                        foreach ($situasi as $sit) {
                                            if ($tahun <> $sit['Tahun_ajaran']) {
                                                // echo "<tr><td>" . $sit['Tahun_ajaran'] . "</td>";
                                                $tahun = $sit['Tahun_ajaran'];
                                                $i++;
                                                $j = 0;
                                                $y = 0;
                                                $o = 0;
                                                $jur = 0;
                                                $linear[$i][$j] = $sit['Tahun_ajaran'];
                                            }
                                            if ($jurusan <> $sit['Kode_jurusan']) {
                                                $jurusan = $sit['Kode_jurusan'];
                                                $j++;
                                                $y = 0;
                                                $t = 0;
                                                $o = 0;
                                                $jur = 0;
                                            }

                                            if ($sit['Linear_kompetensi'] == 'Y') {
                                                $y++;
                                                $linear[$i][$j]['Y'] = $y;
                                            } elseif ($sit['Linear_kompetensi'] == 'T') {
                                                $t++;
                                                $linear[$i][$j]['T'] = $t;
                                            } else {
                                                $o++;
                                                $linear[$i][$j]['O'] = $o;
                                            }
                                            $jur++;
                                            $linear[$i][$j]['Jur'] = $jur;
                                        }
                                        $m = 1;
                                        $n = 1;
                                        $grafik;
                                        foreach ($linear as $key) {
                                            echo "<tr><td class='text-center'>";
                                            echo $linear[$m][0];
                                            for ($i = 3; $i > 0; $i--) {
                                                echo "<td class='text-center'>";
                                                if ($linear[$m][$n]['Y'] <> 0) {
                                                    echo round(($linear[$m][$n]['Y'] / $linear[$m][$n]['Jur']) * 100, 1);
                                                } else {
                                                    echo 0;
                                                }
                                                echo "%<td class='text-center'>";
                                                if ($linear[$m][$n]['T'] <> 0) {
                                                    echo round(($linear[$m][$n]['T'] / $linear[$m][$n]['Jur']) * 100, 1);
                                                } else {
                                                    echo 0;
                                                }
                                                echo "%<td class='text-center'>";
                                                if ($linear[$m][$n]['O'] <> 0) {
                                                    echo round(($linear[$m][$n]['O'] / $linear[$m][$n]['Jur']) * 100, 1);
                                                } else {
                                                    echo 0;
                                                }
                                                echo "%<td class='text-center'>";
                                                $n++;
                                            }
                                            $m++;
                                            $n = 1;
                                        }

                                        $m = 1;
                                        $n = 1;
                                        $ly = 0;
                                        $lt = 0;
                                        $lo = 0;
                                        $tavy = 0;
                                        $tavt = 0;
                                        $tavo = 0;
                                        $tkjy = 0;
                                        $tkjt = 0;
                                        $tkjo = 0;
                                        $tkry = 0;
                                        $tkrt = 0;
                                        $tkro = 0;
                                        foreach ($linear as $key) {
                                            for ($i = 3; $i > 0; $i--) {
                                                if ($n == 1) {
                                                    $tavy = $tavy + $linear[$m][$n]['Y'];
                                                    $tavt = $tavt + $linear[$m][$n]['T'];
                                                    $tavo = $tavo + $linear[$m][$n]['O'];
                                                } elseif ($n == 2) {
                                                    $tkjy = $tkjy + $linear[$m][$n]['Y'];
                                                    $tkjt = $tkjt + $linear[$m][$n]['T'];
                                                    $tkjo = $tkjo + $linear[$m][$n]['O'];
                                                } else {
                                                    $tkry = $tkry + $linear[$m][$n]['Y'];
                                                    $tkrt = $tkrt + $linear[$m][$n]['T'];
                                                    $tkro = $tkro + $linear[$m][$n]['O'];
                                                }
                                                $ly = $ly + $linear[$m][$n]['Y'];
                                                $lt = $lt + $linear[$m][$n]['T'];
                                                $lo = $lo + $linear[$m][$n]['O'];
                                                $n++;
                                            }
                                            $m++;
                                            $n = 1;
                                        }
                                        echo "<tr><td> Sub Total" . "<td class='text-center'>" . round($tavy / ($tavy + $tavt + $tavo) * 100, 1) . "%<td class='text-center'>" . round($tavt / ($tavy + $tavt + $tavo) * 100, 1) . "%<td class='text-center'>" . round($tavo / ($tavy + $tavt + $tavo) * 100, 1);
                                        echo  "%<td><td class='text-center'>" . round($tkjy / ($tkjy + $tkjt + $tkjo) * 100, 1) . "%<td class='text-center'>" . round($tkjt / ($tkjy + $tkjt + $tkjo) * 100, 1) . "%<td class='text-center'>" . round($tkjo / ($tkjy + $tkjt + $tkjo) * 100, 1) . "%<td><td class='text-center'>" . round($tkry / ($tkry + $tkrt + $tkro) * 100, 1);
                                        echo "%<td class='text-center'>" . round($tkrt / ($tkry + $tkrt + $tkro) * 100, 1) . "%<td class='text-center'>" . round($tkro / ($tkry + $tkrt + $tkro) * 100, 1) . "%<td class='text-center'>";
                                        echo "<tr><th colspan='13' class='text-center'> TOTAL";
                                        echo "<tr><th colspan='5'>Sesuai Linear Kompetensi<th colspan='7' class='text-center'>" . round($ly / ($ly + $lt + $lo) * 100, 1) . "%<td>";
                                        echo "<tr><th colspan='5'>Tidak Sesuai Linear Kompetensi<th colspan='7' class='text-center'>" . round($lt / ($ly + $lt + $lo) * 100, 1) . "%<td>";
                                        echo "<tr><th colspan='5'>Belum mengisi Data<th colspan='7' class='text-center'>" . round($lo / ($ly + $lt + $lo) * 100, 1) . "%<td>";


                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="white-box">
                            <h2 class="box-title m-b-0">Data Keadaan Siswa Tahun Ajaran <?= $tahunajaran . "/" . ($tahunajaran + 1); ?></h2>
                            <br>
                            <div class="table-responsive">
                                <table id="smptable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Kelas</th>
                                            <th colspan="3" class="text-center">X</th>
                                            <th></th>
                                            <th colspan="3" class="text-center">XI</th>
                                            <th></th>
                                            <th colspan="3" class="text-center">XII</th>
                                            <th></th>
                                        </tr>

                                        <?php

                                        $array_jsiswa;
                                        $n = 0;
                                        $jur = '';

                                        foreach ($jumlahsiswa as $jus) {
                                            if ($jur <> $jus['Kode_kelas']) {
                                                $m++;
                                                $n++;
                                                $jur = $jus['Kode_kelas'];
                                                $array_jsiswa['Jurusan'][$n] = substr($jus['Kode_kelas'], 0, 3);
                                                $array_jsiswa['P'][$n] = 0;
                                                $array_jsiswa['L'][$n] = 0;
                                            }

                                            if ($jus['Jenis_kelamin'] == 'P') {
                                                $array_jsiswa['P'][$n] = $jus['jmls'];
                                            } else {
                                                $array_jsiswa['L'][$n] = $jus['jmls'];
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <th>Jurusan</th>
                                            <?php
                                            for ($i = 1; $i <= $n; $i++) {
                                                echo "<th class='text-center'>";
                                                echo $array_jsiswa['Jurusan'][$i];
                                                if (($i % ($n / 3)) == 0) {
                                                    echo "<th class='text-center'>";
                                                }
                                            }
                                            ?>
                                        <tr>
                                            <th>L</th>
                                            <?php
                                            for ($i = 1; $i <= $n; $i++) {
                                                echo "<th class='text-center'>";
                                                echo $array_jsiswa['L'][$i];
                                                if (($i % ($n / 3)) == 0) {
                                                    echo "<th class='text-center'>";
                                                }
                                            }
                                            ?>
                                        <tr>
                                            <th>P</th>
                                            <?php
                                            for ($i = 1; $i <= $n; $i++) {
                                                echo "<th class='text-center'>";
                                                echo $array_jsiswa['P'][$i];
                                                if (($i % ($n / 3)) == 0) {
                                                    echo "<th class='text-center'>";
                                                }
                                            }
                                            ?>
                                        <tr>
                                            <th>Jumlah</th>
                                            <?php
                                            for ($i = 1; $i <= $n; $i++) {
                                                echo "<th class='text-center'>";
                                                echo $array_jsiswa['P'][$i] + $array_jsiswa['L'][$i];
                                                if (($i % ($n / 3)) == 0) {
                                                    echo "<th class='text-center'>";
                                                }
                                            }

                                            ?>
                                        <tr>
                                            <th>Jumlah Perkelas</th>
                                            <?php
                                            $jpk = 0;
                                            for ($i = 1; $i <= $n; $i++) {
                                                $jpk = $jpk + $array_jsiswa['P'][$i] + $array_jsiswa['L'][$i];


                                                if (($i % ($n / 3)) == 0) {
                                                    echo "<th class='text-center' colspan='3'>";
                                                    echo $jpk;
                                                    echo "<th class='text-center'>";
                                                    $jpk = 0;
                                                }
                                            }

                                            ?>
                                        <tr>
                                            <th>Total Siswa</th>
                                            <th colspan="11" class="text-center"><?= array_sum($array_jsiswa['L']) + array_sum($array_jsiswa['P']); ?></th>
                                            <th></th>

                                        </tr>
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
<!-- ================================================================== -->
<!-- akhir body -->
<!-- ================================================================== -->
<?php
$_SESSION['linear'] = $linear;
?>
</div>