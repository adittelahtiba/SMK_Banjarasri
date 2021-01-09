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
    <h1>LAPORAN HASIL ANALISIS PANGSA PASAR</h1>
    <table>
        <tr>
            <td> Nomor
            <td>:
            <td>
                <?= $detailpangsaperu[0]['Kd_pangsaperu']; ?>
        <tr>
            <td> Tanggal Analisis
            <td>:
            <td>
                <?php
                $date = date_create($detailpangsaperu[0]['Tanggal']);
                echo date_format($date, 'd-M-Y');
                ?>

        <tr>
            <td>Pangsa pasar awal
            <td>:
            <td>
                <?= $detailpangsaperu[0]['Persentase_awal']; ?>%
        <tr>
            <td>Pangsa pasar dinaikan menjadi
            <td>:
            <td>
                <?= $detailpangsaperu[0]['Persentase_akhir']; ?>%
        <tr>
            <td>Pemisalan penyerapan
            <td>:
            <td>
                <?= $detailpangsaperu[0]['Penyerapan']; ?>
        <tr>
            <td>Status Konfirmasi
            <td>:
            <td> <?= $detailpangsaperu[0]['Konfirmasi']; ?>
                <!-- terpenuhi -->
        <tr>
            <td>Status Terpenuhi
            <td>:
            <td>
                <?= $detailpangsaperu[0]['Status']; ?>

    </table>

    <br>
    <h4>A. Data Perusahaan Kerjasama</h4>

    <table class="tablo ten">
        <thead>
            <tr>
                <th>Jurusan</th>
                <th>Jumlah Perusahaan</th>
                <th>Jumlah Penyerapan</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $i = 0;
            $totalperu;
            $totalpenye;
            $array_pangsa;
            foreach ($perusahaan as $peru) {
                if ($peru['Nama_jurusan'] == '') {
                    echo " <tr><th>Bukan di Jurusan</th>";
                } else {
                    echo " <tr><th>" . $peru['Nama_jurusan'] . "</th>";
                }
                echo "<td class='text-center'>" . $peru['Jumlah'] . "</techo>";
                if ($peru['Penyerapan']) {
                    echo "<td class='text-center'>" . $peru['Penyerapan'] . "</td>";
                    $array_pangsa['penyerapan'][$i] = $peru['Penyerapan'];
                } else {
                    echo "<td class='text-center'>" . 0 . "</td>";
                    $array_pangsa['penyerapan'][$i] = 0;
                }
                $totalperu[$i] = $peru['Jumlah'];
                $totalpenye[$i] = $peru['Penyerapan'];
                $array_pangsa['jumlahperu'][$i] = $peru['Jumlah'];
                $i++;
            }
            echo "<tr><td colspan='3'></td>";
            echo "<tr><td><b>Jumlah</b><td class='text-center'>" .  array_sum($totalperu) . "<td class='text-center'>" . array_sum($totalpenye);
            ?>
        </tbody>
    </table>
    <br>
    <h4>B. Data Siswa Kelas XII Tahun Ajaran <?= $tahunajaran . "/" . ($tahunajaran + 1); ?></h4>

    <table class="tablo ten">
        <thead>

            <tr>
                <th>Jurusan</th>
                <th>Jumlah Siswa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $totalsiswa;
            foreach ($jumlahsiswa as $js) {
                echo "<tr><th>" . $js['Nama_jurusan'] . "</th><td>" . $js['Jumlah_siswa'] . "</td></tr>";
                $totalsiswa[$i] = $js['Jumlah_siswa'];
                $array_pangsa['kodejurusan'][$i] = $js['Kode_jurusan'];
                $array_pangsa['namajurusan'][$i] = $js['Nama_jurusan'];
                $array_pangsa['jumlahsiswa'][$i] = $js['Jumlah_siswa'];
                $array_pangsa['sisasiswa'][$i] = $js['Jumlah_siswa'] - $array_pangsa['penyerapan'][$i];
                $i++;
            }
            echo "<tr><td coldpsn='3'>";
            echo "<tr><td><b>Total</b></td><td>" . array_sum($totalsiswa) . "</td>";

            ?>


        </tbody>
    </table>

    <br>
    <h4>C. Data Kebutuhan Perusahaan</h4>

    <table class="tablo ten">
        <thead>
            <tr>
                <th colspan="2">PERUSAHAAN DIBUTUHKAN</th>
            </tr>
        </thead>
        <tbody id="tabelpangsapasar">
            <?php
            $i = 0;
            $total = 0;
            foreach ($detailpangsaperu as $peru) {
                if ($peru['Nama_jurusan'] <> '') {
                    echo " <tr><th>" . $peru['Nama_jurusan'] . "<td>" . $peru['Jumlah_peru'] . " Perusahaan";
                    $total = $total + $peru['Jumlah_peru'];
                }
                $i++;
            }
            echo " <tr><td class='col-md-6'><b>Total</b><td>" . $total . " Perusahaan";

            ?>
        </tbody>
    </table>


</body>

</html>