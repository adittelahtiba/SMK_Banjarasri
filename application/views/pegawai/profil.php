<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title"><?= $title ?></h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="<?= base_url('Dashboard') ?>">Dashboard </a></li>
                    <li class="active"><?= $title ?></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <!-- Nav tabs -->
                    <ul class="nav customtab2 nav-tabs" role="tablist">
                        <li role="presentation" class="<?php if ($active == '1') echo 'active'; ?>"><a href="#home6" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Profil</span></a></li>
                        <li role="presentation" class="<?php if ($active == '2') echo 'active'; ?>"><a href="#profile6" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Edit Profil</span></a></li>
                        <li role="presentation" class="<?php if ($active == '3') echo 'active'; ?>"><a href="#messages6" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Ubah Password</span></a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade <?php if ($active == '1') echo 'active in'; ?>" id="home6">

                            <div class="user-bg"> <img width="100%" alt="user" src="<?= base_url('assets/BackEnd/') ?>img/profile/<?= $this->session->userdata('foto'); ?>">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)"><img src="<?= base_url('assets/BackEnd/') ?>img/profile/<?= $this->session->userdata('foto'); ?>" class="thumb-lg img-circle" alt="img"></a>
                                        <h4 class="text-white"><?= $pegawai['Nama']; ?></h4>
                                        <h5 class="text-white"><?= $pegawai['Email']; ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="user-btm-box">
                                <h2 class="text-center">NIP.<?= $pegawai['NIP']; ?></h2>

                                <div class="col-md-8 col-xs-12">
                                    <form class=" form-material" action="<?= base_url('Pegawai/editprofile/') . $pegawai['Id_peg']; ?>" enctype="multipart/form-data" method="post">

                                        <div class="form-group">
                                            <label class="col-md-12">Tempat / Tanggal Lahir</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="Tempatlahir" name="Tempatlahir" placeholder="Tempat Lahir" value="<?= $pegawai['Tempat_lahir']; ?>" readonly>

                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" class="form-control" id="Tanggalahir" name="Tanggalahir" value="<?= $pegawai['Tanggal_lahir']; ?>" readonly>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Jenis Kelamin</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="Tanggalahir" name="Tanggalahir" value="<?= $pegawai['Jenis_kelamin']; ?>" readonly>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Pendidikan</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="Pendidikan" name="Pendidikan" value="<?= $pegawai['Pendidikan']; ?>" readonly>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Jurusan</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="Jurusan" name="Jurusan" value="<?= $pegawai['Jurusan']; ?>" readonly>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">NUPTK</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="NUPTK" name="NUPTK" value="<?= $pegawai['NUPTK']; ?>" readonly>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Jabatan</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="Jabatan" name="Jabatan" value="<?= $pegawai['Jabatan']; ?>" readonly>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Tugas Tambahan</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="Tugastambah" name="Tugastambah" value="<?= $pegawai['Tugas_tambah']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Status</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="Tanggalahir" name="Tanggalahir" value="<?= $pegawai['Status']; ?>" readonly>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Email</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="Email" name="Email" value="<?= $pegawai['Email']; ?>" readonly>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">No Telp</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="NoHp" name="NoHp" value="<?= $pegawai['Nomor_telp']; ?>" readonly>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade <?php if ($active == '2') echo 'active in'; ?>" id="profile6">
                            <?= $this->session->flashdata('message'); ?>
                            <form class="form-material" action="<?= base_url('Pegawai/editprofile/'); ?>" enctype="multipart/form-data" method="post">
                                <div class="col-sm-6 ol-md-6 col-xs-12">
                                    <div class="white-box">
                                        <h2 class="box-title"><?= set_value('Nama', $pegawai['Nama']); ?></h2>
                                        <input type="file" name="Foto" id="input-file-now-custom-3" class="dropify" data-height="500" value="" data-default-file="<?= base_url('assets/BackEnd/') ?>img/profile/<?= $this->session->userdata('foto'); ?>" />
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
                                <a style="color: white" href="<?= base_url('Dashboard'); ?>" type="button" class="btn btn-inverse waves-effect waves-light m-r-10">
                                    <i class="fa fa-times m-r-5"></i>
                                    <span>Batal</span>
                                </a>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane fade <?php if ($active == '3') echo 'active in'; ?>" id="messages6">
                            <?= $this->session->flashdata('message'); ?>
                            <form class="form-material" action="<?= base_url('Pegawai/ubahpass/'); ?>" enctype="multipart/form-data" method="post">
                                <div class="form-group">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="password" name="passlama" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password Lama">
                                        <?= form_error('passlama', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" name="password1" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password Baru">
                                            <small class="text-danger pl-3">*</small><?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" name="password2" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Ulangi Password Baru">

                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <br>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-check"></i> Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>