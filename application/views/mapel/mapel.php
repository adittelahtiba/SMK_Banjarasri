<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Data <?= $title ?></h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="<?= base_url('Dashboard') ?>">Dashboard </a></li>
                    <li class="active"><?= $title ?></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="example23" class="table table-striped table color-bordered-table info-bordered-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">KODE MAPEL</th>
                                            <th class="text-center">JURUSAN</th>
                                            <th class="text-center">KELAS</th>
                                            <th class="text-center">SEMESTER</th>
                                            <th class="text-center">NAMA MAPEL</th>
                                            <th class="text-center">KATEGORI</th>
                                            <th class="text-center">STATUS</th>
                                            <th class="text-center">KKM</th>
                                            <th class="text-center">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($mapel as $mpl) { ?>
                                            <tr>

                                                <td class="text-center"><?= $i++ ?></td>
                                                <td class="text-center"><?= $mpl['Kode_mapel'] ?></td>
                                                <td class="text-center"><?= $mpl['Kode_jurusan'] ?></td>
                                                <td class="text-center"><?= $mpl['Kelas'] ?></td>
                                                <td class="text-center"><?= $mpl['Semester'] ?></td>
                                                <td><?= $mpl['Nama_mapel'] ?></td>
                                                <td><?= $mpl['Kategori'] ?></td>
                                                <td class="text-center"><?= $mpl['Status'] ?></td>
                                                <td class="text-center"><?= $mpl['KKM'] ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('Mapel/edit'); ?>/<?= $mpl['Kode_mapel']; ?>"><button type="button" class="btn btn-warning btn-circle">
                                                            <i class=" fa fa-edit"></i>
                                                        </button></a>

                                                </td>
                                            </tr>
                                        <?php } ?>
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