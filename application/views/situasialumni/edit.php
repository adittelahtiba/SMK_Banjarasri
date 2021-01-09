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
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="text-center"><?= $alumni['Nomor_induk']; ?> - <?= $alumni['Nama_siswa']; ?>
                    </h3>
                    <hr>
                    <form class="form-material" action="<?= base_url('Situasialumni/editsave/') . $alumni['Nomor_induk']; ?>" method="POST">
                        <div class="col-md-12">
                            <?= $this->session->flashdata('message'); ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Bekerja:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="Bekerja" value="<?= $alumni['Bekerja']; ?>" placeholder=""> </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Wiraswasta:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="Wiraswasta" value="<?= $alumni['Wiraswasta']; ?>" placeholder=""> </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kuliah:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="Kuliah" value="<?= $alumni['Kuliah']; ?>" placeholder=""> </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pencaker:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="Pencaker" value="<?= $alumni['Pencaker']; ?>" placeholder=""> </div>

                        </div>

                        <div class="col-md-8">
                            <p class="text-muted m-b-30 font-13"> Detail pekerjaan </p>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Gaji Pertama:</label>
                                <div class="col-sm-7">
                                    <div class="input-group"><span class="input-group-addon">Rp.</span>
                                        <input type="number" name="Gaji_pertama" value="<?= $alumni['Gaji_pertama']; ?>" class="form-control" id="inputEmail3" placeholder="Masukan nominal gaji"> </div>
                                    <br>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Waktu Tunggu:</label>
                                <div class="col-sm-7">
                                    <input type="text" name="Waktu_tunggu" class="form-control" value="<?= $alumni['Waktu_tunggu']; ?>" id="inputEmail3" placeholder="Contoh : 0-3 Bulan"> </div>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Sesuai Linear Kompetensi :</label>
                                <div class="col-sm-7">
                                    <div class="radio radio-success">
                                        <input type="radio" name="Linear_kompetensi" id="radio4" value="Y" <?php if ($alumni['Linear_kompetensi'] == 'Y')  echo "checked"; ?>>
                                        <label for="radio4"> Ya</label>
                                    </div>
                                    <div class="radio radio-danger">
                                        <input type="radio" name="Linear_kompetensi" id="radio6" value="T" <?php if ($alumni['Linear_kompetensi'] == 'T')  echo "checked"; ?>>
                                        <label for="radio6"> Tidak </label>
                                    </div>
                                    <div class="radio radio-warning">
                                        <input type="radio" name="Linear_kompetensi" id="radio8" value="">
                                        <label for="radio4"> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Kepuasan Bekerja :</label>
                                <div class="col-sm-7">

                                    <div class="radio radio-success">
                                        <input type="radio" name="Kepuasan_kerja" id="radio4" value="Y" <?php if ($alumni['Kepuasan_kerja'] == 'Y')  echo "checked"; ?>>
                                        <label for="radio4"> Ya</label>
                                    </div>
                                    <div class="radio radio-danger">
                                        <input type="radio" name="Kepuasan_kerja" id="radio6" value="T" <?php if ($alumni['Kepuasan_kerja'] == 'T')  echo "checked"; ?>>
                                        <label for="radio6"> Tidak </label>
                                    </div>

                                    <div class="radio radio-warning">
                                        <input type="radio" name="Kepuasan_kerja" id="radio7" value="">
                                        <label for="radio4"> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>



                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Keterangan :</label>
                                <textarea class="form-control" name="Keterangan" id="exampleInputEmail1" placeholder="Keterangan.." rows="4"><?= $alumni['Keterangan']; ?></textarea> </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>


                        <div class="col-sm-12 col-xs-12">
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Simpan</button>
                            <a style="color: white" href="<?= base_url('Situasialumni/alumni'); ?>" type="button" class="btn btn-inverse waves-effect waves-light m-r-10">
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