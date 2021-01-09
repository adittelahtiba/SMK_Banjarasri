<?php if ($this->session->userdata('level') < 4) {
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
                    <form class="form-material" action="<?= base_url('Pegawai/editsave/') . $pegawai['Id_peg']; ?>" enctype="multipart/form-data" method="post">

                        <div class="form-group">
                            <label class="col-md-12">NIP</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="NIP" name="NIP" value="<?= set_value('NIP', $pegawai['NIP']); ?>">
                                <?= form_error('NIP', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Nama</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="Nama" name="Nama" value="<?= set_value('Nama', $pegawai['Nama']); ?>">
                                <?= form_error('Nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Tempat / Tanggal Lahir</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="Tempatlahir" name="Tempatlahir" placeholder="Tempat Lahir" value="<?= set_value('Tempatlahir', $pegawai['Tempat_lahir']); ?>">
                                <?= form_error('Tempatlahir', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <input type="date" class="form-control" id="Tanggalahir" name="Tanggalahir" value="<?= set_value('Tanggalahir', $pegawai['Tanggal_lahir']); ?>">
                                <?= form_error('Tanggalahir', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Jenis Kelamin</label>
                            <div class="col-md-12">
                                <select class="form-control" name="Jk" id="Jk">
                                    <option value="">--Pilih--</option>
                                    <option value="L" <?= $pegawai['Jenis_kelamin'] == 'L' ? 'selected' : '' ?> <?= set_select('Jk', 'L'); ?>>Pria</option>
                                    <option value="P" <?= $pegawai['Jenis_kelamin'] == 'P' ? 'selected' : '' ?> <?= set_select('Jk', 'P'); ?>>Wanita</option>
                                </select>
                                <?= form_error('Jk', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Pendidikan</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="Pendidikan" name="Pendidikan" value="<?= set_value('Pendidikan', $pegawai['Pendidikan']); ?>">
                                <?= form_error('Pendidikan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Jurusan</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="Jurusan" name="Jurusan" value="<?= set_value('Jurusan', $pegawai['Jurusan']); ?>">
                                <?= form_error('Jurusan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">NUPTK</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="NUPTK" name="NUPTK" value="<?= set_value('NUPTK', $pegawai['NUPTK']); ?>">
                                <?= form_error('NUPTK', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Jabatan</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="Jabatan" name="Jabatan" value="<?= set_value('Jabatan', $pegawai['Jabatan']); ?>">
                                <?= form_error('Jabatan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Tugas Tambahan</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="Tugastambah" name="Tugastambah" value="<?= set_value('Tugastambah', $pegawai['Tugas_tambah']); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Status</label>
                            <div class="col-md-12">
                                <select class="form-control" name="Status" id="Status">
                                    <option value="">--Pilih--</option>
                                    <option value="GTY" <?= $pegawai['Status'] == 'GTY' ? 'selected' : '' ?> <?= set_select('Status', 'GTY'); ?>>GTY</option>
                                    <option value="GTT" <?= $pegawai['Status'] == 'GTT' ? 'selected' : '' ?> <?= set_select('Status', 'GTT'); ?>>GTT</option>
                                </select>
                                <?= form_error('Status', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Level</label>
                            <div class="col-md-12">
                                <select class="form-control" name="Level" id="Level">
                                    <option value="0" <?= $pegawai['Level'] == '0' ? 'selected' : '' ?> <?= set_select('Level', '0'); ?>>Level 0 (Guru)</option>
                                    <option value="1" <?= $pegawai['Level'] == '1' ? 'selected' : '' ?> <?= set_select('Level', '1'); ?>>Level 1 (Bursa Kerja Khusus)</option>
                                    <option value="2" <?= $pegawai['Level'] == '2' ? 'selected' : '' ?> <?= set_select('Level', '2'); ?>>Level 2 (Pks. Hubin)</option>
                                    <option value="3" <?= $pegawai['Level'] == '3' ? 'selected' : '' ?> <?= set_select('Level', '3'); ?>>Level 3 (Kepala Sekolah)</option>
                                </select>
                                <?= form_error('Level', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="Email" name="Email" value="<?= set_value('Email', $pegawai['Email']); ?>">
                                <?= form_error('Email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">No Telp</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="NoHp" name="NoHp" value="<?= set_value('NoHp', $pegawai['Nomor_telp']); ?>">
                                <?= form_error('NoHp', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> Simpan</button>
                        <a style="color: white" href="<?= base_url('Pegawai'); ?>" type="button" class="btn btn-inverse waves-effect waves-light m-r-10">
                            <i class="fa fa-times m-r-5"></i>
                            <span>Batal</span>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>