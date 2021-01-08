
<?php
if ($penye != 0) {


    $totalperu = round(($pangsa - $array_pangsa['pangsaawal']) * (array_sum($array_pangsa['jumlahsiswa']) / $penye) / 100, 0);
    $totalperu2;
    $totalsisa = array_sum($array_pangsa['sisasiswa']);
    $i = 0;
    foreach ($perusahaan as $peru) {
        if ($peru['Nama_jurusan'] <> '') {
            echo " <tr><td>" . $peru['Nama_jurusan'] . "<td>";
            echo "<div class='col-md-12'>
                                                                            <div class='input-group'>
                                                                            <input type='text' name='perusahaan[" . $i . "]' class='form-control' id='exampleInputuname' value='" . round($array_pangsa['sisasiswa'][$i] / $totalsisa * $totalperu, 0) . "' readonly>
                                                                            <div class='input-group-addon'>Perusahaan</div>
                                                                        </div>
                                                                    </div>";
            echo "<input type='text' name='kdjurusan[" . $i . "]' value='" . $array_pangsa['kodejurusan'][$i] . "' hidden>";
            $totalperu2[$i] = round($array_pangsa['sisasiswa'][$i] / $totalsisa * $totalperu, 0);
        }
        $i++;
    }






    echo " <tr><td><td>";
    echo " <tr><td class='col-md-6'>Total<td>";
    echo "<div class='col-md-12'>
                                                                            <div class='input-group'>
                                                                            <input type='text' class='form-control' id='exampleInputuname' value='" . array_sum($totalperu2) . "' placeholder='" . array_sum($totalperu2) . "' readonly>
                                                                            <div class='input-group-addon'>Perusahaan</div>
                                                                        </div>
                                                                    </div>";
} else {
    echo "<div class='alert alert-danger' role='alert'><h3 class='text-uppercase'>Pemisalan jumlah penyerapan tidak boleh 0 !</h3></div>";
}
?>