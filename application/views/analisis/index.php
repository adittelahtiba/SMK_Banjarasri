<?php if (($this->session->userdata('level') < 2) or ($this->session->userdata('level') == 3)) {
    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Anda tidak memiliki hak akses ke halaman tersebut!</div>');
    redirect('Dashboard');
} ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title"><?= $title ?></h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="<?= base_url('Dashboard') ?>">Dashboard</a></li>
                    <li class="active"><?= $title ?></li>
                </ol>
            </div>
        </div>
        <div id="analisis">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-info block5">
                        <div class="panel-heading"> Data Analisis
                            <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-plus"></i></a></div>
                        </div>
                        <div class="panel-wrapper collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">


                                <hr><br>

                                <table id="smptable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th colspan="3" class="text-center">DATA PERUSAHAAN KERJA SAMA</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Jurusan</th>
                                            <th class="text-center">Jumlah Perusahaan</th>
                                            <th class="text-center">Jumlah Penyerapan</th>
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
                                                echo " <tr><td>Bukan di Jurusan</td>";
                                            } else {
                                                echo " <tr><td>" . $peru['Nama_jurusan'] . "</td>";
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
                                        echo "<tr><td>Jumlah<td class='text-center'>" .  array_sum($totalperu) . "<td class='text-center'>" . array_sum($totalpenye);
                                        ?>
                                    </tbody>
                                </table>



                                <br>
                                <hr><br>

                                <table id="smptable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-center">DATA SISWA KELAS XII <?= $tahunajaran . "/" . ($tahunajaran + 1); ?></th>
                                        </tr>
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
                                            echo "<tr><td>" . $js['Nama_jurusan'] . "</td><td>" . $js['Jumlah_siswa'] . "</td></tr>";
                                            $totalsiswa[$i] = $js['Jumlah_siswa'];
                                            $array_pangsa['kodejurusan'][$i] = $js['Kode_jurusan'];
                                            $array_pangsa['namajurusan'][$i] = $js['Nama_jurusan'];
                                            $array_pangsa['jumlahsiswa'][$i] = $js['Jumlah_siswa'];
                                            $array_pangsa['sisasiswa'][$i] = $js['Jumlah_siswa'] - $array_pangsa['penyerapan'][$i];
                                            $i++;
                                        }
                                        echo "<tr><td coldpsn='3'>";
                                        echo "<tr><td>Total</td><td>" . array_sum($totalsiswa) . "</td>";

                                        ?>


                                    </tbody>
                                </table>


                                <hr>

                                <table id="smptable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th colspan="3" class="text-center">PERSENTASE PANGSA PASAR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($perusahaan as $peru) {
                                            if ($peru['Nama_jurusan'] <> '') {
                                                echo " <tr><td>" . $peru['Nama_jurusan'] . "<td>" . round($totalpenye[$i] / $totalsiswa[$i] * 100, 2) . "%";
                                            }
                                            $i++;
                                        }
                                        echo " <tr><td><td>";
                                        echo " <tr><td>Pangsa Pasar Lulusan Sekolah<td>" . round(array_sum($totalpenye) / array_sum($totalsiswa) * 100, 2) . "%";
                                        $array_pangsa['pangsaawal'] = round(array_sum($totalpenye) / array_sum($totalsiswa) * 100, 2);
                                        $_SESSION['array_pangsa'] = $array_pangsa;
                                        ?>
                                    </tbody>
                                </table>

                                <a href="#" data-perform="panel-collapse"><span class="label label-rouded label-danger"><i class="ti-close"></i></span></a>
                            </div>
                        </div>
                    </div>
                    <!-- batas kotak bodas -->
                    <div class="panel panel-info">
                        <div class="panel-heading"> Meningkatkan Pangsa Pasar<span class="label label-rouded label-danger pull-right"><?= round(array_sum($totalpenye) / array_sum($totalsiswa) * 100, 2) . "%"; ?></span></div>
                        <div class="panel-wrapper collapse in" aria-expanded="true">
                            <div class="panel-body">

                                <form action="<?= base_url('Analisis/simpanpangsa') ?>" method="POST" class="form-horizontal form-bordered no-bg-addon">
                                    <div class="form-body">
                                        <div class="col-md-12">
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <br><br>
                                                    <div class="col-md-6">
                                                        <i class="fa fa-calendar"></i> <?= date('d M Y'); ?></p>
                                                        <input type="date" name="tanggal" value="<?= date('Y-m-d H:i:s'); ?>" hidden>
                                                    </div>
                                                </div>
                                                <?= $this->session->flashdata('message'); ?>
                                                <div class="form-group">
                                                    <br><br>
                                                    <label class="control-label col-md-5">Naikan Pangsa Pasar</label>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" name="pangsapersen" id="pangsapasar" placeholder="<?= round(array_sum($totalpenye) / array_sum($totalsiswa) * 100, 2); ?>">
                                                            <input type="number" name="pangsapersen2" value="<?= round(array_sum($totalpenye) / array_sum($totalsiswa) * 100, 2); ?>" hidden>
                                                            <div class="input-group-addon">%</div>
                                                        </div>
                                                        <?= form_error('pangsapersen', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5">Penyerapan perusahaan</label>
                                                    <div class="col-md-6">
                                                        <input type="number" placeholder="0" class="form-control" name="penyerapan" id="penyerapan">
                                                        <?= form_error('penyerapan', '<small class="text-danger pl-3">', '</small>'); ?>
                                                        <span class="help-block"> Pemisalan jumlah penyerapan / perusahaan </span> </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">

                                                <table id="smptable" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="3" class="text-center">PERUSAHAAN DIBUTUHKAN</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tabelpangsapasar">
                                                        <?php
                                                        $i = 0;
                                                        // foreach ($perusahaan as $peru) {
                                                        //     if ($peru['Nama_jurusan'] <> '') {
                                                        //         echo " <tr><td>" . $peru['Nama_jurusan'] . "<td>";
                                                        //         echo "<div class='col-md-12'>
                                                        //                     <div class='input-group'>
                                                        //                     <input type='text' class='form-control' id='exampleInputuname' placeholder='0' disabled>
                                                        //                     <div class='input-group-addon'>Perusahaan</div>
                                                        //                 </div>
                                                        //             </div>";
                                                        //     }
                                                        //     $i++;
                                                        // }
                                                        // echo " <tr><td><td>";
                                                        // echo " <tr><td class='col-md-6'>Total<td>";
                                                        // echo "<div class='col-md-12'>
                                                        //                     <div class='input-group'>
                                                        //                     <input type='text' class='form-control' id='exampleInputuname' placeholder='0' disabled>
                                                        //                     <div class='input-group-addon'>Perusahaan</div>
                                                        //                 </div>
                                                        //             </div>";
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Pesan</label>
                                            <div class="col-md-9">
                                                <textarea placeholder="Pesan..." class="form-control" name="pesan" id="pesan" rows="4"></textarea>
                                                <?= form_error('pesan', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn btn-success tblsimpananalisis" disabled>
                                                        <i class="fa fa-check"></i> Simpan</button>
                                                    <a style="color: white" href=<?= base_url('Analisis/hasilanalisis/a'); ?> type="button" class="btn btn-inverse waves-effect waves-light m-r-10">
                                                        <i class="fa fa-times m-r-5"></i>
                                                        <span>Batal</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6"> </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>