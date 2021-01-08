<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<input type="text" id="tautan" value="<?= base_url(); ?>" hidden>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
        </div>
        <ul class="nav" id="side-menu">
            <li class="user-pro">
                <a href="#" class="waves-effect">
                    <img src="<?= base_url('assets/BackEnd/img/profile') ?>/<?= $this->session->userdata('foto'); ?>" alt="user-img" class="img-circle">
                    <span class="hide-menu"><?php echo substr($this->session->userdata('name'), 0, 17); ?><span class="fa arrow"></span><span class="label label-rouded label-inverse pull-right">2</span></span>
                </a>
                <ul class="nav nav-second-level collapse" aria-expanded="true">
                    <li>
                        <a href="<?= base_url() ?>pegawai/Profile"><i class="ti-user fa-fw">
                            </i><span class="hide-menu">Profil</span></a>
                    </li>


                    <li><a href="<?= base_url('Login/logout') ?>"><i class="fa fa-power-off fa-fw"></i> <span class="hide-menu">Logout</span></a></li>
                </ul>
            </li>

            <li class="devider"></li>
            <li><a href="<?= base_url('Dashboard') ?>" class="waves-effect"><i class="mdi mdi-av-timer fa-fw"></i> <span class="hide-menu">Dashboard</span></a></li>

            <li class="devider"></li>

            <!-- tabel data -->
            <!-- <li> <a href="tables.html" class="waves-effect"><i class="fa fa-table"></i> <span class="hide-menu">Isi Raport<span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">2</span></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?= base_url('Isinilai/manual') ?>"><i class="fa fa-pencil-square-o">&nbsp;&nbsp;</i><span class="hide-menu">Isi Manual</span></a></li>
                    <li><a href="<?= base_url('Isinilai/import') ?>"><i class="fa fa-file-excel-o">&nbsp;&nbsp;</i><span class="hide-menu">Import Excel</span></a></li>
                </ul>
            </li>
            <li><a href="<?= base_url('Printraport') ?>" class="waves-effect"><i class="fa fa-book"></i> <span class="hide-menu">Print Raport</span></a></li>
            <li> <a href="tables.html" class="waves-effect"><i class="mdi mdi-table fa-fw"></i> <span class="hide-menu">Mata Pelajaran<span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">3</span></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?= base_url('Mapel/index/TAV') ?>"><span class="hide-menu">TAV</span></a></li>
                    <li><a href="<?= base_url('Mapel/index/TKJ') ?>"><span class="hide-menu">TKJ</span></a></li>
                    <li><a href="<?= base_url('Mapel/index/TKR') ?>"><span class="hide-menu">TKR</span></a></li>
                </ul>
            </li> -->
            <!-- tabel data -->

            <li class="devider"></li>
            <?php if (($this->session->userdata('level') == 2) or ($this->session->userdata('level') == 4)) { ?>
                <li>
                    <a href="#" class="waves-effect"><i class="fa fa-bar-chart-o"></i> <span class="hide-menu"> Pangsa Pasar <span class="fa arrow"></span> <span class="label label-rouded label-inverse pull-right">2</span></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="true">
                        <li>
                            <a href="<?= base_url('Analisis/pangsapasar') ?>"><i class="fa fw">
                                </i><span class="hide-menu">Analisis Pasar</span></a>
                        </li>
                        <li>
                            <a href="<?= base_url('Analisis/rasiosiswa') ?>"><i class="fa fw"></i><span class="hide-menu">Analisis Rasio Siswa</span></a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
            <?php if ($this->session->userdata('level') > 0) { ?>
                <li><a href="<?= base_url('Analisis/hasilanalisis') ?>" class="waves-effect"><i class="mdi mdi-file-document fa-fw"></i> <span class="hide-menu">Hasil Analisis</span></a></li>
            <?php } ?>
            <li><a href="<?= base_url('Situasialumni/alumni') ?>" class="waves-effect"><i class="fa fa-graduation-cap"></i> <span class="hide-menu">Situasi Alumni</span></a></li>
            <li><a href="<?= base_url('Pegawai') ?>" class="waves-effect"><i class="mdi mdi-tie fa-fw"></i> <span class="hide-menu">Pegawai / Guru</span></a></li>
            <li> <a href="tables.html" class="waves-effect"><i class="fa fa-institution"></i> <span class="hide-menu">Perusahaan<span class="fa arrow"></span><span class="label label-rouded label-inverse pull-right">2</span></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?= base_url('Perusahaan/index') ?>"><i class="fa-fw">A</i><span class="hide-menu">Perusahaan Patner</span></a></li>
                    <li><a href="<?= base_url('Perusahaan/nonpatner') ?>"><i class="fa-fw">B</i><span class="hide-menu">Perusahaan non Patner</span></a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="waves-effect"><i class="fa fa-group" data-icon="v"></i> <span class="hide-menu"> Kelas Siswa <span class="fa arrow"></span> <span class="label label-rouded label-inverse pull-right">4</span></span></a>

                <ul class="nav nav-second-level" aria-expanded="true">
                    <li>
                        <a href="<?= base_url('Kelas/kelas/10') ?>"><i class="ti-user fa-fw">
                            </i><span class="hide-menu">Kelas X</span></a>
                    </li>
                    <li>
                        <a href="<?= base_url('Kelas/kelas/11') ?>"><i class="ti-user fa-fw">
                            </i><span class="hide-menu">Kelas XI</span></a>
                    </li>
                    <li>
                        <a href="<?= base_url('Kelas/kelas/12') ?>"><i class="ti-user fa-fw">
                            </i><span class="hide-menu">Kelas XII</span></a>
                    </li>
                    <li>
                        <a href="<?= base_url('Kelas/kelas/13') ?>"><i class="ti-user fa-fw">
                            </i><span class="hide-menu">Lulusan</span></a>
                    </li>
                </ul>
            </li> -->

            <?php if ($this->session->userdata('level') > 3) { ?>

                <li class="devider"></li>

                <!-- tabel data -->
                <li> <a href="tables.html" class="waves-effect"><i class="mdi mdi-table fa-fw"></i> <span class="hide-menu">Admin<span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">3</span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?= base_url('Siswa/index') ?>"><i class="fa-fw">S</i><span class="hide-menu">Siswa</span></a></li>
                        <li><a href="<?= base_url('Kelas/kelolasiswa') ?>"><i class="fa-fw">K</i><span class="hide-menu">Kelola Siswa</span></a></li>
                        <li><a href="<?= base_url('Siswa/tahunajaran') ?>"><i class="fa-fw">T</i><span class="hide-menu">Tahun Ajaran</span></a></li>
                    </ul>
                </li>
                <!-- tabel data -->

            <?php } ?>
            <li class="devider"></li>

        </ul> -->
    </div>
</div>

<!-- end sidebar -->