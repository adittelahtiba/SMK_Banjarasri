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
            <div class="col-md-12">
                <div class="white-box">
                    <div class="panel-body">
                        <?= $this->session->flashdata('message') ?>
                        <div class="col-sm-6">
                            <h4>Tabel Perusahaan Alumni</h4>
                        </div>
                        <form method="POST" action="<?= base_url('Perusahaan/nonpatner'); ?>">
                            <div class="col-sm-4">
                                <select class="form-control" id="kodejurusan" name="kodejurusan">
                                    <?php
                                    foreach ($jurusan as $jur) {
                                        echo "<option value='" . $jur['Kode_jurusan'] . "'";
                                        if ($jur['Kode_jurusan'] == $kodejurusan) echo 'Selected';
                                        echo ">Jurusan " . $jur['Nama_jurusan'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-block btn-info">Tampilkan</button>
                            </div>
                        </form>
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="example23" class="table table-striped table color-bordered-table danger-bordered-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nama Perusahaan</th>
                                            <th class="text-center">Jumlah Alumni Bekerja</th>
                                            <th class="text-center">Sesuai Linear Kompetensi</th>
                                            <th class="text-center">Tidak Sesuai Linear Kompetensi</th>
                                            <th class="text-center">Merasa Puas</th>
                                            <th class="text-center">Tidak Merasa Puas</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                            </div>
                            <?php
                            $i = 1;
                            foreach ($situasiperu as $peru) {
                                echo "<tr>";
                                echo "<td class='text-center'>" . $i++ . "</td>";
                                echo "<td class='text-center'>" . $peru['Bekerja'];
                                echo "<td class='text-center'>" . $peru['Jumlah'];
                                echo "<td class='text-center'>" . $peru['LinearY'];
                                echo "<td class='text-center'>" . $peru['LinearT'];
                                echo "<td class='text-center'>" . $peru['PuasY'];
                                echo "<td class='text-center'>" . $peru['PuasT'];
                            }
                            ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>