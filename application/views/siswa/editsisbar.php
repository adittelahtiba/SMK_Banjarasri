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
        <div class="row">
            <div class="col-sm-12">
                <form class="form-material" action="<?= base_url('Siswa/editsisbar/') . $siswa['id']; ?>" method="post">

                    <div class="form-group col-md-6 white-box">
                        <label class="col-md-12">NIS</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="Nomor_induk" name="Nomor_induk" value="<?= set_value('Nomor_induk', $siswa['Nomor_induk']); ?>">
                            <?= form_error('Nomor_induk', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <input type="text" name="Nomor_induk2" value="<?= $siswa['Nomor_induk']; ?>" hidden>
                    <input type="text" name="Kode_jurusan" value="<?= $siswa['Kode_jurusan']; ?>" hidden>
                    <div class="form-group col-md-6 white-box">
                        <label class="col-md-12">NISN</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="NISN" name="NISN" value="<?= set_value('NISN', $siswa['NISN']); ?>">
                            <?= form_error('NISN', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group col-md-12 white-box">
                        <label class="col-md-12">Nama siswa</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="Nama_siswa" name="Nama_siswa" value="<?= set_value('Nama_siswa', $siswa['Nama_siswa']); ?>">
                            <?= form_error('Nama_siswa', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-12 white-box">
                        <label class="col-md-12">Jenis kelamin</label>
                        <div class="col-md-12">
                            <select class="form-control" name="Jenis_kelamin" id="Jenis_kelamin">
                                <option value="">--Pilih--</option>
                                <option value="L" <?= $siswa['Jenis_kelamin'] == 'L' ? 'selected' : '' ?> <?= set_select('Jenis_kelamin', 'L'); ?>>Pria</option>
                                <option value="P" <?= $siswa['Jenis_kelamin'] == 'P' ? 'selected' : '' ?> <?= set_select('Jenis_kelamin', 'P'); ?>>Wanita</option>
                            </select>
                            <?= form_error('Jenis_kelamin', '<small class="text-danger pl-3">', '</small>'); ?></div>
                    </div>
                    <div class="form-group col-md-6 white-box">
                        <label class="col-md-12">Tempat lahir</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="Tempat_lahir" placeholder="Tempat lahir" value="<?= set_value('Tempat_lahir', $siswa['Nama_siswa']); ?>">
                            <?= form_error('Tempat_lahir', '<small class="text-danger pl-3">', '</small>'); ?></div>
                    </div>
                    <div class="form-group col-md-6 white-box">
                        <label class="col-md-12">Tanggal lahir</label>
                        <div class="col-md-12">
                            <input type="date" class="form-control" name="Tanggal_lahir" placeholder="Tanggal lahir" value="<?= set_value('Tanggal_lahir', $siswa['Tanggal_lahir']); ?>">
                            <?= form_error('Tanggal_lahir', '<small class="text-danger pl-3">', '</small>'); ?></div>
                    </div>
                    <div class="form-group col-md-12 white-box">
                        <label class="col-md-12">Agama</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="Agama" placeholder="Agama" value="<?= set_value('Agama', $siswa['Agama']); ?>">
                            <?= form_error('Agama', '<small class="text-danger pl-3">', '</small>'); ?></div>
                    </div>
                    <div class="form-group col-md-12 white-box">
                        <label class="col-md-12">Nama ayah</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="Nama_ayah" placeholder="Nama ayah" value="<?= set_value('Nama_ayah', $siswa['Nama_ayah']); ?>">
                            <?= form_error('Nama_ayah', '<small class="text-danger pl-3">', '</small>'); ?></div>
                    </div>
                    <div class="form-group col-md-12 white-box">
                        <label class="col-md-12">Nama ibu</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="Nama_ibu" placeholder="Nama ibu" value="<?= set_value('Nama_ibu', $siswa['Nama_ibu']); ?>">
                            <?= form_error('Nama_ibu', '<small class="text-danger pl-3">', '</small>'); ?></div>
                    </div>
                    <div class="form-group col-md-12 white-box">
                        <label class="col-md-12">Pekerjaan ortu</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="Pekerjaan_ortu" placeholder="Pekerjaan ortu" value="<?= set_value('Pekerjaan_ortu', $siswa['Pekerjaan_ortu']); ?>">
                            <?= form_error('Pekerjaan_ortu', '<small class="text-danger pl-3">', '</small>'); ?></div>
                    </div>
                    <div class="form-group col-md-12 white-box">
                        <label class="col-md-12">Alamat</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="Alamat" placeholder="Alamat" value="<?= set_value('Alamat', $siswa['Alamat']); ?>">
                            <?= form_error('Alamat', '<small class="text-danger pl-3">', '</small>'); ?></div>
                    </div>
                    <div class="form-group col-md-12 white-box">
                        <label class="col-md-12">Asal sekolah</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="Asal_sekolah" placeholder="Asal sekolah" value="<?= set_value('Asal_sekolah', $siswa['Asal_sekolah']); ?>">
                            <?= form_error('Asal_sekolah', '<small class="text-danger pl-3">', '</small>'); ?></div>
                    </div>
                    <div class="form-group col-md-12 white-box">
                        <label class=" col-md-12">Status keuangan</label>
                        <div class="col-md-12">
                            <select class="form-control" name="Status_keuangan" id="Status_keuangan">
                                <option value="">--Pilih--</option>
                                <option value="Mampu" <?= $siswa['Status_keuangan'] == 'Mampu' ? 'selected' : '' ?> <?= set_select('Status_keuangan', 'Mampu'); ?>>Mampu</option>
                                <option value="Tidak mampu" <?= $siswa['Status_keuangan'] == 'Tidak mampu' ? 'selected' : '' ?> <?= set_select('Status_keuangan', 'Tidak mampu'); ?>>Tidak Mampu</option>
                            </select>
                            <?= form_error('Status_keuangan', '<small class="text-danger pl-3">', '</small>'); ?></div>
                    </div>
                    <div class="form-group col-md-12 white-box">
                        <label class="col-md-12">Tahun masuk</label>
                        <div class="col-md-12">
                            <input type="number" class="form-control" name="Tahun_masuk" placeholder="Tahun masuk (<?= date('Y'); ?>)" value="<?= set_value('Tahun_masuk',  $siswa['Tahun_masuk']); ?>">
                            <?= form_error('Tahun_masuk', '<small class="text-danger pl-3">', '</small>'); ?></div>
                    </div>
                    <div class="form-group col-md-12 white-box">
                        <label class="col-md-12">Nomor ijazah</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="Nomor_ijazah" placeholder="Nomor ijazah" value="<?= set_value('Nomor_ijazah', $siswa['Nomor_ijazah']); ?>">
                            <?= form_error('Nomor_ijazah', '<small class="text-danger pl-3">', '</small>'); ?></div>
                    </div>
                    <div class="form-group col-md-12 white-box">
                        <label class="col-md-12">Nomor skhun</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="Nomor_skhun" placeholder="Nomor skhun" value="<?= set_value('Nomor_skhun', $siswa['Nomor_skhun']); ?>">
                            <?= form_error('Nomor_skhun', '<small class="text-danger pl-3">', '</small>'); ?></div>
                    </div>
                    <div class="form-group col-md-12 white-box">
                        <label class="col-md-12">Nomor peserta</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="Nomor_peserta" placeholder="Nomor peserta" value="<?= set_value('Nomor_peserta', $siswa['Nomor_peserta']); ?>">
                            <?= form_error('Nomor_peserta', '<small class="text-danger pl-3">', '</small>'); ?></div>
                    </div>
                    <div class="form-group col-md-12 white-box">
                        <label class="col-md-12">Keterangan</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" value="<?= set_value('keterangan', $siswa['keterangan']); ?>">
                            <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?></div>
                    </div>

                    <div class="form-group col-md-12 white-box">
                        <label class="col-md-12">Nomor telp</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="Nomor_telp" placeholder="Nomor telp" value="<?= set_value('Nomor_telp', $siswa['Nomor_telp']); ?>">
                            <?= form_error('Nomor_telp', '<small class="text-danger pl-3">', '</small>'); ?></div>
                    </div>
                    <div class="form-group col-md-12 white-box">
                        <label class="col-md-12">Email</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="Email" placeholder="Email" value="<?= set_value('Email', $siswa['Email']); ?>">
                            <?= form_error('Email', '<small class="text-danger pl-3">', '</small>'); ?></div>
                    </div>
                    <div class="form-group col-md-12 white-box">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> Simpan</button>
                        <a style="color: white" href="<?= base_url('Kelas/kelolasiswa'); ?>" type="button" class="btn btn-inverse waves-effect waves-light m-r-10">
                            <i class="fa fa-times m-r-5"></i>
                            <span>Batal</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>