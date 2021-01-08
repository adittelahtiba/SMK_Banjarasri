<?php if ($this->session->userdata('level') < 1) {
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
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <!-- batas kotak bodas -->
                    <div class="panel panel-info">
                        <div class="panel-heading">Pangsa Pasar<span class="label label-rouded label-danger pull-right"><?= $detailpangsaperu[0]['Persentase_awal']; ?>%</span></div>
                        <div class="panel-wrapper collapse in" aria-expanded="true">
                            <div class="panel-body">

                                <form action="<?= base_url('Analisis/konfirmasipangsaperu/') . $detailpangsaperu[0]['Kd_pangsaperu']; ?>" method="POST" class="form-horizontal form-bordered no-bg-addon">




                                    <div class="form-body">
                                        <div class="col-md-12">
                                            <div class="col-md-6">

                                                <?= $this->session->flashdata('message'); ?>
                                                <div class="form-group">
                                                    <label class="control-label col-md-6"><i class="fa fa-calendar"></i> Tanggal Analisis :</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static">
                                                            <?php
                                                            $date = date_create($detailpangsaperu[0]['Tanggal']);
                                                            echo date_format($date, 'd-M-Y');
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-6">Pangsa pasar awal :</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static">
                                                            <?= $detailpangsaperu[0]['Persentase_awal']; ?>%
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-6">Pangsa pasar dinaikan menjadi :</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static">
                                                            <?= $detailpangsaperu[0]['Persentase_akhir']; ?>%
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-6">Pemisalan penyerapan :</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control-static">
                                                            <?= $detailpangsaperu[0]['Penyerapan']; ?>
                                                        </p>
                                                    </div>
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
                                                        $total = 0;
                                                        foreach ($detailpangsaperu as $peru) {
                                                            if ($peru['Nama_jurusan'] <> '') {
                                                                echo " <tr><td>" . $peru['Nama_jurusan'] . "<td>" . $peru['Jumlah_peru'] . " Perusahaan";
                                                                $total = $total + $peru['Jumlah_peru'];
                                                            }
                                                            $i++;
                                                        }
                                                        echo " <tr><td><td>";
                                                        echo " <tr><td class='col-md-6'>Total<td>" . $total . " Perusahaan";

                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">

                                        <!-- .chat-right-panel -->
                                        <div class="media m-b-30 p-t-20">
                                            <div class="chat-right-aside">
                                                <div class="chat-main-header">
                                                    <div class="p-20 b-b">
                                                        <h3 class="box-title">Pesan</h3>
                                                    </div>
                                                </div>
                                                <div class="chat-box">
                                                    <ul class="chat-list slimscroll p-t-30">
                                                        <?php
                                                        foreach ($Pesan_obrolan as $pesan) {
                                                            if ($pesan['NIP'] <> $this->session->userdata('id')) {
                                                                echo "<li class='odd'>";
                                                            } else {
                                                                echo "<li>";
                                                            }

                                                            echo "<div class='chat-image'> <img src='" . base_url('assets/BackEnd/img/profile/') . $pesan['Foto'] . "'> </div>";
                                                            echo "<div class='chat-body'>";
                                                            echo "<div class='chat-text'>";
                                                            echo "<h4>" . $pesan['Nama'] . "</h4>";
                                                            echo "<p>" . $pesan['Isi_pesan'] . "</p> <b>" . $pesan['Tanggal_pesan'] . "</b>";
                                                            echo "</div>";
                                                            echo "</div>";
                                                            echo "</li>";
                                                        }
                                                        ?>

                                                    </ul>
                                                    <div class="row send-chat-box">
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control" name="pesan" placeholder="Tulis pesan anda disini"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if (($this->session->userdata('level') == 3) or ($this->session->userdata('level') == 4)) { ?>
                                            <!-- .chat-right-panel -->
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-4 control-label">Status Konfirmasi :</label>
                                                <div class="col-sm-7">
                                                    <div class="radio radio-success">
                                                        <input type="radio" name="konfirmasi" id="radio4" value="Konfirmasi" <?php if ($detailpangsaperu[0]['Konfirmasi'] <> 'Tolak') echo "checked"; ?>>
                                                        <label for="radio4"> Konfirmasi</label>
                                                    </div>
                                                    <div class="radio radio-danger">
                                                        <input type="radio" name="konfirmasi" id="radio6" value="Tolak" <?php if ($detailpangsaperu[0]['Konfirmasi'] == 'Tolak')  echo "checked"; ?>>
                                                        <label for="radio6"> Tolak </label>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>

                                        <?php } ?>

                                        <!-- terpenuhi -->
                                        <?php if (($this->session->userdata('level') == 2) or ($this->session->userdata('level') == 4)) { ?>
                                            <?php if ($detailpangsaperu[0]['Konfirmasi'] == 'Konfirmasi') { ?>
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-4 control-label">Status Terpenuhi :</label>
                                                    <div class="col-sm-7">
                                                        <div class="radio radio-success">
                                                            <input type="radio" name="status" id="radio7" value="Terpenuhi" <?php if ($detailpangsaperu[0]['Status'] <> 'Tidak terpenuhi') echo "checked"; ?>>
                                                            <label for="radio4"> Terpenuhi</label>
                                                        </div>
                                                        <div class="radio radio-danger">
                                                            <input type="radio" name="status" id="radio8" value="Tidak terpenuhi" <?php if ($detailpangsaperu[0]['Status'] == 'Tidak terpenuhi')  echo "checked"; ?>>
                                                            <label for="radio6"> Tidak </label>
                                                        </div>
                                                        <br>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                        <br>
                                        <br>
                                        <br>
                                        <br>

                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fa fa-check"></i> Simpan</button>
                                                <a style="color: white" href="<?= base_url('Analisis/hasilanalisis/a'); ?>" type="button" class="btn btn-inverse waves-effect waves-light m-r-10">
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