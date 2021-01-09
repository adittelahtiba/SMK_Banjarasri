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

        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <?= $this->session->flashdata('message'); ?>


                    <ul class="nav customtab nav-tabs" role="tablist">
                        <li role="presentation" class="<?php if ($ab == 'a') echo 'active'; ?>"><a href="#home1" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="fa fa-percent"></i></span><span class="hidden-xs"> Hasil Analisis Pangsa Pasar</span></a></li>
                        <li role="presentation" class="<?php if ($ab == 'b') echo 'active'; ?>"><a href="#profile1" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-sitemap"></i></span> <span class="hidden-xs">Hasil Analisis Rasio Pangsa Pasar</span></a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade <?php if ($ab == 'a') echo 'active in'; ?>" id="home1">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped table color-bordered-table danger-bordered-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Laporan</th>
                                            <th class="text-center">Kode Pangsa</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Persentase Pangsa Pasar</th>
                                            <th class="text-center">Persentase Dinaikan</th>
                                            <th class="text-center">Konfirmasi</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Detail</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $i = 1;
                                        foreach ($hasilpangsaperu as $hpp) {
                                            echo "<tr>";
                                            echo "<td class='text-center'>" . $i++ . "</td>";
                                            echo "<td class='text-center'>";
                                            if ($hpp['Konfirmasi'] == 'Konfirmasi') {
                                                echo "<a style='color: red; ' href='" . base_url('printpdf/printpangsaperu/') . $hpp['Kd_pangsaperu'] . "' type='button' class='btn waves-effect waves-light m-r-10' target='_blank'>
                                            <i class='fa  fa-file-pdf-o m-r-5'></i>
                                            <span>Print</span>
                                            </a>";
                                            }
                                            echo "</td>";
                                            echo "<td class='text-center'>" . $hpp['Kd_pangsaperu'] . "</td>";
                                            echo "<td class='text-center'>" . $hpp['Tanggal'] . "</td>";
                                            echo "<td class='text-center'>" . $hpp['Persentase_awal'] . "</td>";
                                            echo "<td class='text-center'>" . $hpp['Persentase_akhir'] . "</td>";
                                            echo "<td class='text-center'>" . $hpp['Konfirmasi'] . "</td>";
                                            echo "<td class='text-center'>" . $hpp['Status'] . "</td>";
                                            echo "<td class='text-center'>
                                        <a style='color: white; ' href='" . base_url('Analisis/pangsaperudetail/') . $hpp['Kd_pangsaperu'] . "' type='button' class='btn btn-success waves-effect waves-light m-r-10'>
                                            <i class='fa fa-external-link m-r-5'></i>
                                            <span>Lihat detail</span>
                                        </a>
                                         </td>";
                                            echo "<td class='text-center'>";
                                            if ($this->session->userdata('level') > 2) {

                                                echo "<button type='button' class='btn btn-warning btn-circle' data-toggle='modal' id='btndeletepangsaperu' data-id='" . $hpp['Kd_pangsaperu'] . "'>
                                                <i class='ti-trash'></i>
                                                </button>";
                                            }
                                            echo "</td>";
                                        }
                                        ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade <?php if ($ab == 'b') echo 'active in'; ?>" id="profile1">
                            <div class="table-responsive">
                                <table id="example23" class="table table-striped table color-bordered-table danger-bordered-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Laporan</th>
                                            <th class="text-center">Kode Rasio</th>
                                            <th class="text-center">Tahun Ajaran</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Histori Tahun Data</th>
                                            <th class="text-center">Konfirmasi</th>
                                            <th class="text-center">Detail</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $i = 1;
                                        foreach ($hasilrasio as $hr) {
                                            echo "<tr>";
                                            echo "<td class='text-center'>" . $i++ . "</td>";
                                            echo "<td class='text-center'>";
                                            if ($hr['Status'] == 'Konfirmasi') {
                                                echo "<a style='color: red; ' href='" . base_url('Printpdf/printrasio/') . $hr['Kd_rasio'] . "/" . $hr['Histori'] . "' type='button' class='btn waves-effect waves-light m-r-10' target='_blank'>
                                            <i class='fa  fa-file-pdf-o m-r-5'></i>
                                            <span>Print</span>
                                            </a>";
                                            }
                                            echo "</td>";
                                            echo "<td class='text-center'>" . $hr['Kd_rasio'] . "</td>";
                                            echo "<td class='text-center'>" . $hr['Tahun_ajaran'] . "/" . ($hr['Tahun_ajaran'] + 1) . "</td>";
                                            echo "<td class='text-center'>" . $hr['Tanggal'] . "</td>";
                                            echo "<td class='text-center'>" . $hr['Histori'] . " Tahun terakhir </td>";
                                            echo "<td class='text-center'>" . $hr['Status'] . "</td>";
                                            echo "<td class='text-center'>
                                        <a style='color: white; ' href='" . base_url('Analisis/rasiodetail/') . $hr['Kd_rasio'] . "' type='button' class='btn btn-success waves-effect waves-light m-r-10'>
                                            <i class='fa fa-external-link m-r-5'></i>
                                            <span>Lihat detail</span>
                                        </a>
                                         </td>
                                         <td class='text-center'>";
                                            if ($this->session->userdata('level') > 2) {
                                                echo "
                                             <button type='button' class='btn btn-warning btn-circle' data-toggle='modal' id='btndeleterasio' data-id='" . $hr['Kd_rasio'] . "'>
                                                 <i class='ti-trash'></i>
                                             </button>";
                                            }
                                            echo "</td>";
                                        }
                                        ?>
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