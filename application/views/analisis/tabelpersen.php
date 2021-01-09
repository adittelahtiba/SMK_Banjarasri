<form action="<?= base_url('Analisis/simpanrasio'); ?>" method="POST">
    <input type="number" name="histori" value="<?= $histori; ?>" hidden>

    <div class="table-responsive">
        <table id="smptable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <?php

                    // $juml =  0 +  $jumlah_tahun['Jumlah_tahun'];
                    for ($i = $histori; $i > 0; $i--) {
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



                    foreach ($jurusana as $juru) {
                        if ($juru['Kode_jurusan'] <> '-') {

                            echo "<th></th>
                        <th colspan='3' class='text-center'>Jurusan " . $juru['Nama_jurusan'] . "</th>";
                        }
                    }
                    ?>
                    <th></th>
                </tr>

                <tr>
                    <th>Tahun</th>
                    <?php
                    foreach ($jurusana as $juru) {
                        if ($juru['Kode_jurusan'] <> '-') {
                            echo "<th class='text-center'>Sesuai Linear Kompetensi</th>";
                            echo "<th class='text-center'>Tidak Sesuai Linear Kompetensi</th>";
                            echo "<th class='text-center'>Belum mengisi Data</th>";
                            echo "<th></th>";
                        }
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
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

                foreach ($linear as $key) {
                    echo "<tr><td class='text-center'>" . $linear[$m][0];
                    for ($i = 3; $i > 0; $i--) {
                        echo "<td class='text-center'>";
                        if ($linear[$m][$n]['Y'] <> 0) {
                            echo round(($linear[$m][$n]['Y'] / $linear[$m][$n]['Jur']) * 100, 1);
                            $exponen[$m][$n] = round($linear[$m][$n]['Y'] / $linear[$m][$n]['Jur'], 3);
                        } else {
                            echo 0;
                            $exponen[$m][$n] = 0;
                        }
                        echo "%<td class='text-center'>";
                        if ($linear[$m][$n]['T'] <> 0) {
                            echo round(($linear[$m][$n]['T'] / $linear[$m][$n]['Jur']) * 100, 1);
                            $exponen[$m][$n] = round($linear[$m][$n]['Y'] / $linear[$m][$n]['Jur'], 3);
                        } else {
                            echo 0;
                            $exponen[$m][$n] = 0;
                        }
                        echo "%<td class='text-center'>";
                        if ($linear[$m][$n]['O'] <> 0) {
                            echo round(($linear[$m][$n]['O'] / $linear[$m][$n]['Jur']) * 100, 1);
                            $exponen[$m][$n] = round($linear[$m][$n]['Y'] / $linear[$m][$n]['Jur'], 3);
                        } else {
                            echo 0;
                            $exponen[$m][$n] = 0;
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
                echo "<tr><th colspan='5'>Belum mengisi Data<td colspan='7' class='text-center'>" . round($lo / ($ly + $lt + $lo) * 100, 1) . "%<td>";


                ?>
            </tbody>
        </table>
    </div>
    <!-- perhitungan -->
    <?php
    // echo var_dump($exponen);
    // echo "<hr>";
    // echo var_dump($exponen[1]);
    $exp;
    $z = 1;
    $x = count($exponen);
    $y = count($exponen[1]);
    for ($j = 1; $j <= $y; $j++) {
        $exp[$z] = 1;
        for ($i = 1; $i <= $x; $i++) {
            $exp[$z] = $exp[$z] * exp($exponen[$i][$j]);
            // echo $exponen[$i][$j] . " = ";
            // echo exp($exponen[$i][$j]) . "<br>";
        }
        $z++;
        echo "<hr>";
    }
    // echo var_dump($exp);
    // echo "<hr>";
    // echo array_sum($exp);
    // echo "<hr>";
    // echo var_dump($jalumni);

    echo "<div class='panel panel-info'><div class='panel-heading'>Hasil Analisis</div></div>";
    echo "<div class='table-responsive'>";
    echo "<table id='smptable' class='table table-bordered table-striped'>
<thead>
    <tr>
        <th></th>";

    $i = 1;
    foreach ($jurusana as $juru) {
        if ($juru['Kode_jurusan'] <> '-') {
            echo "<th class='text-center'>Jurusan " . $juru['Kode_jurusan'] . "</th>";
            echo "<th></th>";
            echo "<input type='text' name='Kode_jurusan[" . $i++ . "]' value='" . $juru['Kode_jurusan'] . "' hidden>";
        }
    }
    echo "</tr>
</thead>
<tbody>
    <tr><td>Persentase Pangsa Pasar Persaingan Jurusan</td>";
    $jumlahna = 0;
    $pembagi = 0;
    $i = 1;
    foreach ($jalumni as $ja) {
        $jumlahna = $jumlahna + $ja['Jumlahna'];
        echo "<td  class='text-center'>" . round(100 * $exp[$i] / array_sum($exp), 2) . "%<td>";
        $i++;
    }

    echo "<tr><td>Persentase Perbandingan Jumlah ALumni</td>";
    $i = 1;
    foreach ($jalumni as $ja) {
        echo "<td  class='text-center'>" . round(100 * $ja['Jumlahna'] / $jumlahna, 2) . "%<td>";
        $pembagi = $pembagi + ($exp[$i] / array_sum($exp)) * ($ja['Jumlahna'] / $jumlahna);
        $i++;
    }

    echo "<tr><td>Rasio Persentase Kebutuhan Siswa</td>";
    $i = 1;
    foreach ($jalumni as $ja) {
        echo "<input type='text' id='tes' name='kebutuhan[" . $i . "]' value='" . round((100 * $ja['Jumlahna'] / $jumlahna) * ($exp[$i] / array_sum($exp)) / $pembagi, 2) . "' hidden>";
        echo "<td  class='text-center'>" . round((100 * $ja['Jumlahna'] / $jumlahna) * ($exp[$i] / array_sum($exp)) / $pembagi, 2) . "%<td>";
        $i++;
    }
    ?>
    </tbody>
    </table>
    </div>
    <br>
    <br>
    <div class="col-md-12">
        <div class="col-md-6">
            <select class="form-control" id="Tahun_ajaran" name="Tahun_ajaran">
                <?php
                for ($i = 1; $i <= 3; $i++) {
                    echo "<option value='" . ($tahunajaran + $i) . "'>Untuk Tahun Ajaran " . ($tahunajaran + $i) . "/" . ($tahunajaran + 1 + $i) . "</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <hr>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label col-md-2">Pesan</label>
            <div class="col-md-9">
                <textarea placeholder="Pesan..." class="form-control" name="pesan" id="pesan" rows="4"></textarea>
                <?= form_error('pesan', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <hr>
    </div>
    <div class="col-md-12">

        <div class="col-md-offset-3 col-md-9">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-check"></i> Simpan</button>
            <a style="color: white" href=<?= base_url('Analisis/hasilanalisis/b'); ?> type="button" class="btn btn-inverse waves-effect waves-light m-r-10">
                <i class="fa fa-times m-r-5"></i>
                <span>Batal</span>
            </a>
        </div>
    </div>
</form>



<!-- end perhitungan -->