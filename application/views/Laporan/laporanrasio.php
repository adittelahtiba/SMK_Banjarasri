<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/BackEnd/') ?>plugins/images/favicon.png">
    <link href="<?= base_url('assets/BackEnd/') ?>css/print.css" id="theme" rel="stylesheet">

    <title><?= $title; ?></title>
</head>

<body>
    <h1>LAPORAN ANALISIS RASIO KEBUTUHAN SISWA TAHUN AJARAN <?= $drasio[0]['Tahun_ajaran'] . '/' . ($drasio[0]['Tahun_ajaran'] + 1); ?></h1>

    <table width="60%">

        <tr>
            <td>Nomor</td>
            <td>:</td>
            <td><?= $drasio[0]['Kd_rasio']; ?></td>
        </tr>
        <tr>
            <td>Tanggal Analisis</td>
            <td>:</td>
            <td><?php
                $date = date_create($drasio[0]['Tanggal']);
                echo date_format($date, 'd-M-Y');
                ?></td>
        </tr>
        <tr>
            <td>Data Lulusan</td>
            <td>:</td>
            <td><?= $drasio[0]['Histori']; ?> Tahun Terakhir</td>
        </tr>
        <tr>
            <td>Status Konfirmasi</td>
            <td>:</td>
            <td><?= $drasio[0]['Status']; ?></td>
        </tr>
    </table>
    <br>
    <h4>A. Hasil Analisis</h4>
    <table class="tablo ten">


        <?php

        foreach ($drasio as $peru) {
            if ($peru['Nama_jurusan'] <> '') {
                echo "<tr><td>Rasio untuk jurusan " . $peru['Kode_jurusan'] . " <td>: <td>" . $peru['Rasio'] . " %";
            }
        }
        ?>
        </td>
        </tr>
    </table>
    <br>
    <h4>B. Data yang digunakan</h4>

    <div class="table-responsive">
        <table class="tablo ten">
            <thead class="teh">
                <tr>
                    <?php

                    // $juml =  0 +  $jumlah_tahun['Jumlah_tahun'];
                    for ($i = $drasio[0]['Histori']; $i > 2; $i--) {
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

                    echo "<th>";

                    foreach ($jurusana as $juru) {
                        if ($juru['Kode_jurusan'] <> '-') {

                            echo "
                        <th colspan='3' class='text-center'>Jurusan " . $juru['Nama_jurusan'] . "</th>";
                        }
                    }
                    ?>
                </tr>

                <tr>
                    <th>Tahun</th>
                    <?php
                    foreach ($jurusana as $juru) {
                        if ($juru['Kode_jurusan'] <> '-') {
                            echo "<th class='text-center'>Sesuai Linear Kompetensi</th>";
                            echo "<th class='text-center'>Tidak Sesuai Linear Kompetensi</th>";
                            echo "<th class='text-center'>Belum mengisi Data</th>";
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
                echo  "%<td class='text-center'>" . round($tkjy / ($tkjy + $tkjt + $tkjo) * 100, 1) . "%<td class='text-center'>" . round($tkjt / ($tkjy + $tkjt + $tkjo) * 100, 1) . "%<td class='text-center'>" . round($tkjo / ($tkjy + $tkjt + $tkjo) * 100, 1) . "%<td class='text-center'>" . round($tkry / ($tkry + $tkrt + $tkro) * 100, 1);
                echo "%<td class='text-center'>" . round($tkrt / ($tkry + $tkrt + $tkro) * 100, 1) . "%<td class='text-center'>" . round($tkro / ($tkry + $tkrt + $tkro) * 100, 1) . "%";
                echo "<tr><td colspan='10' class='text-center'> <b>TOTAL</b>";
                echo "<tr><th colspan='5'>Sesuai Linear Kompetensi<td colspan='5' class='text-center'>" . round($ly / ($ly + $lt + $lo) * 100, 1) . "%";
                echo "<tr><th colspan='5'>Tidak Sesuai Linear Kompetensi<td colspan='5' class='text-center'>" . round($lt / ($ly + $lt + $lo) * 100, 1) . "%";
                echo "<tr><th colspan='5'>Belum mengisi Data<td colspan='5' class='text-center'>" . round($lo / ($ly + $lt + $lo) * 100, 1) . "%";


                ?>
            </tbody>
        </table>
        <br>
        <h4>C. Detail Hasil Analisis</h4>
    </div>

    <table class="tablo">
        <thead class="teh">
            <tr>
                <th></th>
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
                }

                $i = 1;
                foreach ($jurusana as $juru) {
                    if ($juru['Kode_jurusan'] <> '-') {
                        echo "<th class='text-center'>Jurusan " . $juru['Kode_jurusan'] . "</th>";
                    }
                }
                echo "</tr>
</thead>
<tbody>
    <tr><th>Persentase Pangsa Pasar Persaingan Jurusan</td>";
                $jumlahna = 0;
                $pembagi = 0;
                $i = 1;
                foreach ($jalumni as $ja) {
                    $jumlahna = $jumlahna + $ja['Jumlahna'];
                    echo "<td  class='text-center'>" . round(100 * $exp[$i] / array_sum($exp), 2) . "%";
                    $i++;
                }

                echo "<tr><th>Persentase Perbandingan Jumlah ALumni</td>";
                $i = 1;
                foreach ($jalumni as $ja) {
                    echo "<td  class='text-center'>" . round(100 * $ja['Jumlahna'] / $jumlahna, 2) . "%";
                    $pembagi = $pembagi + ($exp[$i] / array_sum($exp)) * ($ja['Jumlahna'] / $jumlahna);
                    $i++;
                }

                echo "<tr><th>Rasio Persentase Kebutuhan Siswa</th>";
                $i = 1;
                foreach ($jalumni as $ja) {
                    echo "<td  class='text-center'>" . round((100 * $ja['Jumlahna'] / $jumlahna) * ($exp[$i] / array_sum($exp)) / $pembagi, 2) . "%";
                    $i++;
                }
                ?>
                </tbody>
    </table>
</body>

</html>