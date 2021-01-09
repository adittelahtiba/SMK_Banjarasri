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
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">Analisis Pangsa Pasar Persaingan Jurusan</div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <div class="col-sm-12">
                                <div class="white-box">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-5 control-label">
                                            <h2 class="box-title m-b-0">Persentase Kompetensi Kerja Lulusan</h2>
                                        </label>

                                        <div class="col-sm-3">

                                            <select class="form-control" id="jumlah_tahun2">
                                                <?php

                                                echo  "<option value=" . 0 . ">--Pilih Data Alumni--</option>";
                                                $juml =  0 +  $jumlah_tahun['Jumlah_tahun'];
                                                for ($i = $juml; $i > 0; $i--) {
                                                    echo  "<option value=" . $i . ">" . $i . " Tahun Terakhir</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <div id="tabelpersen">
                                        <div class="alert alert-warning">Pilih data alumni terlebih dahulu! </div>
                                    </div>
                                    <!-- beres tabel -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>