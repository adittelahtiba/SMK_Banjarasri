<?php if ($this->session->userdata('level') < 4) {
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
        <a href="#handap">
            <div class="btn btn-back-to-top bg0-hov btn-success" id="myBtn" style="display: flex;">
                <span class="symbol-btn-back-to-top">
                    Simpan
                </span>
            </div>
        </a>
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <?= $this->session->flashdata('message'); ?>


                    <ul class="nav customtab nav-tabs" role="tablist">
                        <li role="presentation" class="<?php if ($ab == 'a') echo 'active'; ?>"><a href="#a" aria-controls="a" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs">Siswa baru</span><span class="hidden-xs">Siswa baru</span></a></li>
                        <li role="presentation" class="<?php if ($ab == 'b') echo 'active'; ?>"><a href="#b" aria-controls="b" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs">Kenaikan kelas 10</span> <span class="hidden-xs">Kenaikan kelas 10</span></a></li>
                        <li role="presentation" class="<?php if ($ab == 'c') echo 'active'; ?>"><a href="#c" aria-controls="c" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs">Kenaikan kelas 11</span> <span class="hidden-xs">Kenaikan kelas 11</span></a></li>
                        <li role="presentation" class="<?php if ($ab == 'd') echo 'active'; ?>"><a href="#d" aria-controls="d" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs">Kelulusan kelas 12</span> <span class="hidden-xs">Kelulusan kelas 12</span></a></li>
                        <li role="presentation" class="<?php if ($ab == 'e') echo 'active'; ?>"><a href="#e" aria-controls="e" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs">Form Tambah Siswa</span> <span class="hidden-xs">Form Tambah Siswa</span></a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- 1 -->
                        <div role="tabpanel" class="tab-pane fade <?php if ($ab == 'a') echo 'active in'; ?>" id="a">
                            <form action="<?= base_url('Kelas/siswabaru'); ?>" enctype="multipart/form-data" method="POST">
                                <div class="table-responsive">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="white-box">
                                                <h3 class="box-title">Upload File Excel</h3>
                                                <label for="input-file-now">Tambah siswa baru via upload file excel</label>
                                                <input type="file" name="inexcel" id="input-file-now" class="dropify" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="<?= base_url(); ?>assets/BackEnd/file/siswa%20baru%20format.xlsx">
                                                <button class="btn btn-success waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-file-excel-o"></i></span>Download Format Excel</button>
                                            </a>
                                        </div>

                                        <div class="col-md-12" id="divlola1">
                                            <button type="submit" class="btn btn-success" id="btnlola1">
                                                <i class="fa fa-check"></i> Simpan</button>
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                            </form>
                            <div class="col-md-12">

                                <table id="smptable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="text-center">CALON SISWA BARU Tahun Ajaran <?= ($sepuluh[0]['Tahun_ajaran'] + 1) . "/" . ($sepuluh[0]['Tahun_ajaran'] + 2); ?></th>

                                        </tr>
                                        <tr>
                                            <td class='text-center' colspan="2">AKSI</td>
                                            <td class='text-center'>NIS</td>
                                            <td class='text-center'>NAMA</td>
                                            <td class='text-center'>JURUSAN</td>
                                            <td class='text-center'>TAHUN MASUK</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($sembilan as $s9) {
                                            echo "<tr>";
                                            echo "<td class='text-center'>";
                                            echo "<button type='button' class='btn btn-danger btn-circle' data-toggle='modal' id='btndltsiswa1' data-id='" . $s9['Nomor_induk'] . "'><i class='ti-trash'></i></button>";
                                            echo "<td class='text-center'>";
                                            echo "<a href='" . base_url('Siswa/baruedit/') . $s9['id'] . "'><button type='button' class='btn btn-warning btn-circle'><i class='fa fa-edit'></i></button></a>";
                                            echo "<td>" . $s9['Nomor_induk'] . "</td>";
                                            echo "<td>" . $s9['Nama_siswa'] . "</td>";
                                            echo "<td class='text-center'>" . $s9['Kode_jurusan'] . "</td>";
                                            echo "<td class='text-center'>" . $s9['Tahun_masuk'] . "</td>";

                                            $i++;
                                        }
                                        if ($sembilan == null) {
                                            echo "<tr><td colspan='6'>Belum ada data</td>";
                                        }
                                        ?>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <!-- 2 -->
                    <div role="tabpanel" class="tab-pane fade <?php if ($ab == 'b') echo 'active in'; ?>" id="b">
                        <form action="<?= base_url('Kelas/update/b'); ?>" method="POST">
                            <div class="table-responsive">
                                <table id="smptable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th colspan="4" class="text-center">KELAS X Tahun Ajaran <?= $sepuluh[0]['Tahun_ajaran'] . "/" . ($sepuluh[0]['Tahun_ajaran'] + 1); ?></th>
                                            <th colspan="3" class="text-center">STATUS</th>
                                            <input type="text" name="Tahun_ajaran" value="<?= ($sepuluh[0]['Tahun_ajaran'] + 1); ?>" hidden>
                                        </tr>
                                        <tr>
                                            <td>NIS</td>
                                            <td>NAMA</td>
                                            <td>JURUSAN</td>
                                            <td>TAHUN MASUK</td>
                                            <td>NAIK KELAS</td>
                                            <td>TINGGAL KELAS</td>
                                            <td>LAINYA</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($sepuluh as $s10) {
                                            echo "<tr>";
                                            echo "<td>" . $s10['Nomor_induk'] . "</td>";
                                            echo "<td>" . $s10['Nama_siswa'] . "</td>";
                                            echo "<td class='text-center'>" . $s10['Kode_jurusan'] . "</td>";
                                            echo "<td class='text-center'>" . $s10['Tahun_masuk'] . "</td>";
                                            echo "<td>";
                                            echo "<div class='radio radio-success'>";
                                            echo "<input type='radio' id='A" . $i . "' name='status[" . $i . "]' value='Naik'";
                                            if (($s10['Status'] <> 'Tinggal') or ($s10['Status'] <> 'Lain')) {
                                                echo "checked";
                                            }
                                            echo "><label for='A" . $i . "'> Naik Kelas</label></div>";
                                            echo "</td>";

                                            echo "<td>";
                                            echo "<div class='radio radio-danger'>";
                                            echo "<input type='radio' id='B" . $i . "' name='status[" . $i . "]' value='Tinggal'";
                                            if ($s10['Status'] == 'Tinggal') {
                                                echo "checked";
                                            }
                                            echo "><label for='B" . $i . "'> Tinggal Kelas</label></div>";
                                            echo "</td>";

                                            echo "<td>";
                                            echo "<div class='radio radio-warning'>";
                                            echo "<input type='radio' id='C" . $i . "' name='status[" . $i . "]' value='Lain'";
                                            if ($s10['Status'] == 'Lain') {
                                                echo "checked";
                                            }
                                            echo "><label for='C" . $i . "'> Lainya</label></div>";
                                            echo "</td>";
                                            echo "<input type='text' name='status2[" . $i . "]' value='" . $s10['Status'] . "' hidden>";
                                            echo "<input type='text' name='Nomor_induk[" . $i . "]' value='" . $s10['Nomor_induk'] . "' hidden>";
                                            echo "<input type='text' name='Kode_kelas[" . $i . "]' value='" . substr($s10['Kode_kelas'], 0, 3) . '10'  . "' hidden>";

                                            $i++;
                                        }
                                        ?>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div id="divlola2">
                                <button type="submit" class="btn btn-success" id="btnlola2">
                                    <i class="fa fa-check"></i> Simpan</button>
                                <button type="reset" class="btn btn-dark">
                                    <i class="fa fa-times m-r-5"></i> Batal</button>
                            </div>
                        </form>
                    </div>
                    <!-- 3 -->
                    <div role="tabpanel" class="tab-pane fade <?php if ($ab == 'c') echo 'active in'; ?>" id="c">
                        <form action="<?= base_url('Kelas/update/c'); ?>" method="POST">
                            <div class="table-responsive">
                                <table id="smptable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th colspan="4" class="text-center">KELAS XI Tahun Ajaran <?= $sebelas[0]['Tahun_ajaran'] . "/" . ($sebelas[0]['Tahun_ajaran'] + 1); ?></th>
                                            <th colspan="3" class="text-center">STATUS</th>
                                            <input type="text" name="Tahun_ajaran" value="<?= ($sebelas[0]['Tahun_ajaran'] + 1); ?>" hidden>
                                        </tr>
                                        <tr>
                                            <td>NIS</td>
                                            <td>NAMA</td>
                                            <td>JURUSAN</td>
                                            <td>TAHUN MASUK</td>
                                            <td>NAIK KELAS</td>
                                            <td>TINGGAL KELAS</td>
                                            <td>LAINYA</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($sebelas as $s11) {
                                            echo "<tr>";
                                            echo "<td>" . $s11['Nomor_induk'] . "</td>";
                                            echo "<td>" . $s11['Nama_siswa'] . "</td>";
                                            echo "<td class='text-center'>" . $s11['Kode_jurusan'] . "</td>";
                                            echo "<td class='text-center'>" . $s11['Tahun_masuk'] . "</td>";
                                            echo "<td>";
                                            echo "<div class='radio radio-success'>";
                                            echo "<input type='radio' id='D" . $i . "' name='status[" . $i . "]' value='Naik'";
                                            if (($s11['Status'] <> 'Tinggal') or ($s11['Status'] <> 'Lain')) {
                                                echo "checked";
                                            }
                                            echo "><label for='D" . $i . "'> Naik Kelas</label></div>";
                                            echo "</td>";

                                            echo "<td>";
                                            echo "<div class='radio radio-danger'>";
                                            echo "<input type='radio' id='E" . $i . "' name='status[" . $i . "]' value='Tinggal'";
                                            if ($s11['Status'] == 'Tinggal') {
                                                echo "checked";
                                            }
                                            echo "><label for='E" . $i . "'> Tinggal Kelas</label></div>";
                                            echo "</td>";

                                            echo "<td>";
                                            echo "<div class='radio radio-warning'>";
                                            echo "<input type='radio' id='F" . $i . "' name='status[" . $i . "]' value='Lain'";
                                            if ($s11['Status'] == 'Lain') {
                                                echo "checked";
                                            }
                                            echo "><label for='F" . $i . "'> Lainya</label></div>";
                                            echo "</td>";

                                            echo "<input type='text' name='status2[" . $i . "]' value='" . $s11['Status'] . "' hidden>";
                                            echo "<input type='text' name='Nomor_induk[" . $i . "]' value='" . $s11['Nomor_induk'] . "' hidden>";
                                            echo "<input type='text' name='Kode_kelas[" . $i . "]' value='" . substr($s11['Kode_kelas'], 0, 3) . '11'  . "' hidden>";

                                            $i++;
                                        }
                                        ?>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div id="divlola3">
                                <button type="submit" class="btn btn-success" id="btnlola3">
                                    <i class="fa fa-check"></i> Simpan</button>
                                <button type="reset" class="btn btn-dark">
                                    <i class="fa fa-times m-r-5"></i> Batal</button>
                            </div>
                        </form>
                    </div>
                    <!-- 4 -->
                    <div role="tabpanel" class="tab-pane fade <?php if ($ab == 'd') echo 'active in'; ?>" id="d">
                        <form action="<?= base_url('Kelas/update/d'); ?>" method="POST">
                            <div class="table-responsive">
                                <table id="smptable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th colspan="4" class="text-center">KELAS XII Tahun Ajaran <?= $duabelas[0]['Tahun_ajaran'] . "/" . ($duabelas[0]['Tahun_ajaran'] + 1); ?></th>
                                            <th colspan="3" class="text-center">STATUS</th>
                                            <input type="text" name="Tahun_ajaran" value="<?= ($duabelas[0]['Tahun_ajaran'] + 1); ?>" hidden>
                                        </tr>
                                        <tr>
                                            <td>NIS</td>
                                            <td>NAMA</td>
                                            <td>JURUSAN</td>
                                            <td>TAHUN MASUK</td>
                                            <td>LULUS</td>
                                            <td>TIDAK LULUS</td>
                                            <td>LAINYA</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($duabelas as $s12) {
                                            echo "<tr>";
                                            echo "<td>" . $s12['Nomor_induk'] . "</td>";
                                            echo "<td>" . $s12['Nama_siswa'] . "</td>";
                                            echo "<td class='text-center'>" . $s12['Kode_jurusan'] . "</td>";
                                            echo "<td class='text-center'>" . $s12['Tahun_masuk'] . "</td>";
                                            echo "<td>";
                                            echo "<div class='radio radio-success'>";
                                            echo "<input type='radio' id='G" . $i . "' name='status[" . $i . "]' value='Naik'";
                                            if (($s12['Status'] <> 'Tinggal') or ($s12['Status'] <> 'Lain')) {
                                                echo "checked";
                                            }
                                            echo "><label for='G" . $i . "'> Lulus</label></div>";
                                            echo "</td>";

                                            echo "<td>";
                                            echo "<div class='radio radio-danger'>";
                                            echo "<input type='radio' id='H" . $i . "' name='status[" . $i . "]' value='Tinggal'";
                                            if ($s12['Status'] == 'Tinggal') {
                                                echo "checked";
                                            }
                                            echo "><label for='H" . $i . "'> Tidak Lulus</label></div>";
                                            echo "</td>";

                                            echo "<td>";
                                            echo "<div class='radio radio-warning'>";
                                            echo "<input type='radio' id='I" . $i . "' name='status[" . $i . "]' value='Lain'";
                                            if ($s12['Status'] == 'Lain') {
                                                echo "checked";
                                            }
                                            echo "><label for='I" . $i . "'> Lainya</label></div>";
                                            echo "</td>";

                                            echo "<input type='text' name='status2[" . $i . "]' value='" . $s12['Status'] . "' hidden>";
                                            echo "<input type='text' name='Nomor_induk[" . $i . "]' value='" . $s12['Nomor_induk'] . "' hidden>";
                                            echo "<input type='text' name='Kode_kelas[" . $i . "]' value='" . substr($s12['Kode_kelas'], 0, 3) . '12'  . "' hidden>";

                                            $i++;
                                        }
                                        ?>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div id="divlola4">
                                <button type="submit" class="btn btn-success" id="btnlola4">
                                    <i class="fa fa-check"></i> Simpan</button>
                                <button type="reset" class="btn btn-dark">
                                    <i class="fa fa-times m-r-5"></i> Batal</button>
                            </div>
                        </form>
                    </div>
                    <!-- 5 -->
                    <div role="tabpanel" class="tab-pane fade <?php if ($ab == 'e') echo 'active in'; ?>" id="e">
                        <form action="<?= base_url('Kelas/siswabaruform/e'); ?>" method="POST">
                            <div class="col-md-12">
                                <i class="fa fa-calendar"></i> <?= date('d M Y'); ?></p>
                                <hr>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-12">Program</label>
                                <div class="col-md-12">
                                    <select class="form-control" name="Kode_jurusan" id="Kode_jurusan">
                                        <option value="">--Pilih--</option>
                                        <option value="TAV" <?= set_select('Kode_jurusan', 'TAV'); ?>>Teknik Audio Video</option>
                                        <option value="TKJ" <?= set_select('Kode_jurusan', 'TKJ'); ?>>Teknik Komputer Jaringan</option>
                                        <option value="TKR" <?= set_select('Kode_jurusan', 'TKR'); ?>>Teknik Kendaraan Ringan</option>
                                    </select>
                                    <?= form_error('Kode_jurusan', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-12">Tingkat</label>
                                <div class="col-md-12">
                                    <select class="form-control" name="Kode_kelas" id="Kode_kelas">
                                        <option value="">--Pilih--</option>
                                        <option value="09" <?= set_select('Kode_kelas', '09'); ?>>Siswa Baru Tahun Ajaran <?= ($duabelas[0]['Tahun_ajaran'] + 1) . "/" . ($duabelas[0]['Tahun_ajaran'] + 2); ?></option>
                                        <option value="10" <?= set_select('Kode_kelas', '10'); ?>>Kelas 10 Tahun Ajaran <?= $duabelas[0]['Tahun_ajaran'] . "/" . ($duabelas[0]['Tahun_ajaran'] + 1); ?></option>
                                        <option value="11" <?= set_select('Kode_kelas', '11'); ?>>Kelas 11 Tahun Ajaran <?= $duabelas[0]['Tahun_ajaran'] . "/" . ($duabelas[0]['Tahun_ajaran'] + 1); ?></option>
                                        <option value="12" <?= set_select('Kode_kelas', '12'); ?>>Kelas 12 Tahun Ajaran <?= $duabelas[0]['Tahun_ajaran'] . "/" . ($duabelas[0]['Tahun_ajaran'] + 1); ?></option>
                                    </select>
                                    <?= form_error('Kode_kelas', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <input type="number" name="Tahun_ajaran" value="<?= $duabelas[0]['Tahun_ajaran']; ?>" hidden>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-12">NIS</label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control" placeholder="Nomor induk Siswa" name="Nomor_induk" value="<?= set_value('Nomor_induk'); ?>">
                                    <?= form_error('Nomor_induk', '<small class="text-danger pl-3">', '</small>'); ?></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-12">NISN</label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control" name="NISN" placeholder="NISN" value="<?= set_value('NISN'); ?>">
                                    <?= form_error('NISN', '<small class="text-danger pl-3">', '</small>'); ?></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-12">Nama siswa</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="Nama_siswa" placeholder="Nomor induk Siswa Nasional" value="<?= set_value('Nama_siswa'); ?>">
                                    <?= form_error('Nama_siswa', '<small class="text-danger pl-3">', '</small>'); ?></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-12">Jenis kelamin</label>
                                <div class="col-md-12">
                                    <select class="form-control" name="Jenis_kelamin" id="Jenis_kelamin">
                                        <option value="">--Pilih--</option>
                                        <option value="L" <?= set_select('Jenis_kelamin', 'L'); ?>>Pria</option>
                                        <option value="P" <?= set_select('Jenis_kelamin', 'P'); ?>>Wanita</option>
                                    </select>
                                    <?= form_error('Jenis_kelamin', '<small class="text-danger pl-3">', '</small>'); ?></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-12">Tempat lahir</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="Tempat_lahir" placeholder="Tempat lahir" value="<?= set_value('Tempat_lahir'); ?>">
                                    <?= form_error('Tempat_lahir', '<small class="text-danger pl-3">', '</small>'); ?></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-12">Tanggal lahir</label>
                                <div class="col-md-12">
                                    <input type="date" class="form-control" name="Tanggal_lahir" placeholder="Tanggal lahir" value="<?= set_value('Tanggal_lahir'); ?>">
                                    <?= form_error('Tanggal_lahir', '<small class="text-danger pl-3">', '</small>'); ?></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-12">Agama</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="Agama" placeholder="Agama" value="<?= set_value('Agama'); ?>">
                                    <?= form_error('Agama', '<small class="text-danger pl-3">', '</small>'); ?></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-12">Nama ayah</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="Nama_ayah" placeholder="Nama ayah" value="<?= set_value('Nama_ayah'); ?>">
                                    <?= form_error('Nama_ayah', '<small class="text-danger pl-3">', '</small>'); ?></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-12">Nama ibu</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="Nama_ibu" placeholder="Nama ibu" value="<?= set_value('Nama_ibu'); ?>">
                                    <?= form_error('Nama_ibu', '<small class="text-danger pl-3">', '</small>'); ?></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-12">Pekerjaan ortu</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="Pekerjaan_ortu" placeholder="Pekerjaan ortu" value="<?= set_value('Pekerjaan_ortu'); ?>">
                                    <?= form_error('Pekerjaan_ortu', '<small class="text-danger pl-3">', '</small>'); ?></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-12">Alamat</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="Alamat" placeholder="Alamat" value="<?= set_value('Alamat'); ?>">
                                    <?= form_error('Alamat', '<small class="text-danger pl-3">', '</small>'); ?></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-12">Asal sekolah</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="Asal_sekolah" placeholder="Asal sekolah" value="<?= set_value('Asal_sekolah'); ?>">
                                    <?= form_error('Asal_sekolah', '<small class="text-danger pl-3">', '</small>'); ?></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-12">Status keuangan</label>
                                <div class="col-md-12">
                                    <select class="form-control" name="Status_keuangan" id="Status_keuangan">
                                        <option value="">--Pilih--</option>
                                        <option value="Mampu" <?= set_select('Status_keuangan', 'Mampu'); ?>>Mampu</option>
                                        <option value="Tidak mampu" <?= set_select('Status_keuangan', 'Tidak mampu'); ?>>Tidak Mampu</option>
                                    </select>
                                    <?= form_error('Status_keuangan', '<small class="text-danger pl-3">', '</small>'); ?></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-12">Tahun masuk</label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control" name="Tahun_masuk" placeholder="Tahun masuk (<?= date('Y'); ?>)" value="<?= set_value('Tahun_masuk', date('Y')); ?>">
                                    <?= form_error('Tahun_masuk', '<small class="text-danger pl-3">', '</small>'); ?></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-12">Nomor ijazah</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="Nomor_ijazah" placeholder="Nomor ijazah" value="<?= set_value('Nomor_ijazah'); ?>">
                                    <?= form_error('Nomor_ijazah', '<small class="text-danger pl-3">', '</small>'); ?></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-12">Nomor skhun</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="Nomor_skhun" placeholder="Nomor skhun" value="<?= set_value('Nomor_skhun'); ?>">
                                    <?= form_error('Nomor_skhun', '<small class="text-danger pl-3">', '</small>'); ?></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-12">Nomor peserta</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="Nomor_peserta" placeholder="Nomor peserta" value="<?= set_value('Nomor_peserta'); ?>">
                                    <?= form_error('Nomor_peserta', '<small class="text-danger pl-3">', '</small>'); ?></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-12">keterangan</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="keterangan" placeholder="keterangan" value="<?= set_value('keterangan'); ?>">
                                    <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-12">Nomor telp</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="Nomor_telp" placeholder="Nomor telp" value="<?= set_value('Nomor_telp'); ?>">
                                    <?= form_error('Nomor_telp', '<small class="text-danger pl-3">', '</small>'); ?></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="Email" placeholder="Email" value="<?= set_value('Email'); ?>">
                                    <?= form_error('Email', '<small class="text-danger pl-3">', '</small>'); ?></div>
                            </div>
                            <div id="divlola5">

                                <button type="submit" class="btn btn-success" id="btnlola5">
                                    <i class="fa fa-check"></i> Simpan</button>
                                <button type="reset" class="btn btn-dark">
                                    <i class="fa fa-times m-r-5"></i> Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-xs-12">
            <!-- Start an Alert -->
            <div id="alerttopright" class="myadmin-alert myadmin-alert-img alert-success myadmin-alert-top-right" style="z-index:1002;"> <img src="<?= base_url(); ?>assets/BackEnd/img/loader.gif" class="img" alt="img" style="opacity: 0.5;">
                <h4>Sisetem sedang memproses untuk memulai Tahun Ajaran Baru <?= ($duabelas[0]['Tahun_ajaran'] + 1) . "/" . ($duabelas[0]['Tahun_ajaran'] + 2); ?></h4> <b> Proses membutuhkan waktu.</b>
            </div>

            <div class="jq-toast-wrap top-right">
                <div id="simepen" class="jq-toast-single jq-has-icon jq-icon-success" style="text-align: left; display: none;">
                    <h2 class="jq-toast-heading">Sistem sedang menyimpan</h2><img height="14px" src="<?= base_url(); ?>assets/BackEnd/img/loader.gif" class="img" alt="img"> Menyimpan...
                </div>
            </div>
        </div>
        <div id="bg"></div>
        <div id="modal-kotak"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="white-box">
                    <!-- <a href="<?= base_url('Kelas/tahunajaranbaru'); ?>"> -->
                    <div class="col-md-12" id="divbtntahunbaru">
                        <button class="btn btn-block btn-outline btn-success" data-id="<?= ($duabelas[0]['Tahun_ajaran'] + 1) . "/" . ($duabelas[0]['Tahun_ajaran'] + 2); ?>" id="btntahunbaru">Mulai Tahun Ajaran Baru</button>
                    </div>
                    <!-- </a> -->
                    <hr id="handap">
                </div>
            </div>
        </div>

    </div>
</div>