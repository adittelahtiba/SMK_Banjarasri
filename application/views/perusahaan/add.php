<?php if ($this->session->userdata('level') < 1) {
    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Anda tidak memiliki hak akses ke halaman tersebut!</div>');
    redirect('Dashboard');
} ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Data <?= $title ?></h4>
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
                    <h3 class="box-title m-b-30">Form</h3>
                    <form class="form-material" action="<?= base_url('Perusahaan/addsave'); ?>" enctype="multipart/form-data" method="post">

                        <div class="form-group">
                            <label class="col-md-12">Nama Perusahaan</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="Nama" name="Nama_perusahaan" placeholder="Nama perusahaan" value="<?= set_value('Nama_perusahaan'); ?>">
                                <?= form_error('Nama_perusahaan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Kontrak</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="Tempatlahir" name="Lama_kontrak" placeholder="Lama Kontrak (dalam tahun)" value="<?= set_value('Lama_kontrak'); ?>">
                                <?= form_error('Lama_kontrak', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Tanggal Kontrak</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" id="Tanggalahir" name="Tanggal_kontrak" value="<?= set_value('Tanggal_kontrak'); ?>">
                                <?= form_error('Tanggal_kontrak', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Pihak Kedua</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="Pendidikan" name="Pihak_kedua" value="<?= set_value('Pihak_kedua'); ?>">
                                <?= form_error('Pihak_kedua', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Penyerapan</label>
                            <div class="col-md-12">
                                <input type="number" class="form-control" id="Penyerapan" name="Penyerapan" placeholder="Jumlah Penyerapan" value="<?= set_value('Penyerapan'); ?>">
                                <?= form_error('Penyerapan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Jurusan</label>
                            <div class="col-md-12">
                                <select class="form-control" name="Kode_jurusan" id="Kode_jurusan">
                                    <option value="">--Pilih--</option>
                                    <option value="TAV" <?= set_select('Kode_jurusan', 'TAV'); ?>>Teknik Audio Video</option>
                                    <option value="TKJ" <?= set_select('Kode_jurusan', 'TKJ'); ?>>Teknik Komputer Jaringan</option>
                                    <option value="TKR" <?= set_select('Kode_jurusan', 'TKR'); ?>>Teknik Kendaraan Ringan</option>
                                    <option value="-" <?= set_select('Kode_jurusan', '-'); ?>>Tanapa jurusan</option>
                                </select>
                                <?= form_error('Kode_jurusan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <?php if (($this->session->userdata('level') == 2) or ($this->session->userdata('level') == 4)) { ?>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-2 control-label">Status Kontrak</label>
                                <div class="col-sm-7">
                                    <div class="radio radio-success">
                                        <input type="radio" name="Aktif" id="radio4" value="Aktif" checked <?= set_radio('Aktif', 'Aktif'); ?>>
                                        <label for="radio4"> Aktif</label>
                                    </div>
                                    <div class="radio radio-danger">
                                        <input type="radio" name="Aktif" id="radio6" value="Tidak Aktif" <?= set_radio('Aktif', 'Tidak Aktif'); ?>>
                                        <label for="radio6"> Tidak Aktif</label>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        <?php } else { ?>
                            <input type="text" name="Aktif" value="Tidak Aktif" hidden>
                        <?php } ?>

                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> Simpan</button>
                        <a style="color: white" href="<?= base_url('Perusahaan'); ?>" type="button" class="btn btn-inverse waves-effect waves-light m-r-10">
                            <i class="fa fa-times m-r-5"></i>
                            <span>Batal</span>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>