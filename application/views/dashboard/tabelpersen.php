<?php

$juml =  0 +  $jumlah_tahun['Jumlah_tahun'];
for ($i = $juml; $i > 0; $i--) {
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
