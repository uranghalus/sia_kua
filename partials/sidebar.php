<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="assets/dist/img/Logo-KUA.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Kantor Urusan Agama</p>
                <!-- Status -->
                <a href="#">Kec. Banjarmasin Timur</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu Utama</li>
            <!-- Optionally, you can add icons to the links -->
            <li <?php if ($page == "Dashboard") : ?>class="active" <?php endif ?>>
                <a href="dashboard">
                    <i class="fa fa-tachometer"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <?php if ($role == "ADMIN") : ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-database"></i> <span>Master Data</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="dashboard?pages=M-Kua"><i class="fa fa-circle-o"></i> Master Kua</a></li>
                        <li><a href="dashboard?pages=M-Penghulu"><i class="fa fa-circle-o"></i> Master Penghulu</a></li>
                    </ul>
                </li>
            <?php endif ?>
            <li <?php if ($page == "Konsultasi Nikah") : ?>class="active" <?php endif ?>>
                <a href="dashboard?pages=konsultasi">
                    <i class="fa fa-envelope"></i>
                    <span>Konsultasi Nikah</span>
                </a>
            </li>
            <li <?php if ($page == "Pendaftaran Nikah") : ?>class="active" <?php endif ?>>
                <a href="dashboard?pages=pendaftaran">
                    <i class="fa fa-user"></i>
                    <span>Pendaftaran Nikah</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i><span>Data Pranikah</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php if ($role == "ADMIN") : ?>
                        <li><a href="dashboard?pages=pranikah"><i class="fa fa-circle-o"></i> Data Bimbingan</a></li>
                    <?php endif ?>
                    <li><a href="dashboard?pages=absensi-bimbingan"><i class="fa fa-circle-o"></i> Absensi Bimbingan</a></li>
                    <li><a href="dashboard?pages=jadwal-bimbingan"><i class="fa fa-circle-o"></i> Jadwal Bimbingan</a></li>
                </ul>
            </li>
            <li <?php if ($page == "Rekomendasi Nikah") : ?>class="active" <?php endif ?>>
                <a href="dashboard?pages=rekomendasi">
                    <i class="fa fa-envelope"></i>
                    <span>Rekomendasi Nikah</span>
                </a>
            </li>
            <li <?php if ($page == "Jadwal Nikah") : ?>class="active" <?php endif ?>>
                <a href="dashboard?pages=jadwal">
                    <i class="fa fa-clock-o"></i>
                    <span>Jadwal Nikah</span>
                </a>
            </li>
            <?php if ($role == "ADMIN") : ?>
                <li class="header">Laporan</li>
                <li <?php if ($page == "Laporan Data Penghulu") : ?>class="active" <?php endif ?>>
                    <a href="dashboard?pages=l-penghulu">
                        <i class="fa fa-file"></i>
                        <span>Laporan Data Penghulu</span>
                    </a>
                </li>
                <li <?php if ($page == "Laporan Status Pembayaran") : ?>class="active" <?php endif ?>>
                    <a href="dashboard?pages=l-keuangan">
                        <i class="fa fa-file"></i>
                        <span>Laporan Status Pembayaran</span>
                    </a>
                </li>
                <!-- <li <?php if ($page == "Laporan Usia Pasangan") : ?>class="active" <?php endif ?>>
                    <a href="dashboard?pages=l-usia">
                        <i class="fa fa-file"></i>
                        <span>Laporan Usia Pasangan</span>
                    </a>
                </li> -->
                <li <?php if ($page == "Laporan Jadwal Nikah") : ?>class="active" <?php endif ?>>
                    <a href="dashboard?pages=l-jadwal">
                        <i class="fa fa-file"></i>
                        <span>Laporan Jadwal Nikah</span>
                    </a>
                </li>
                <li <?php if ($page == "Laporan Kehadiran Bimbingan Pranikah") : ?>class="active" <?php endif ?>>
                    <a href="dashboard?pages=l-absensi-pranikah">
                        <i class="fa fa-file"></i>
                        <span>Laporan Kehadiran Pranikah</span>
                    </a>
                </li>
                <li <?php if ($page == "Laporan Bimbingan Pranikah") : ?>class="active" <?php endif ?>>
                    <a href="dashboard?pages=l-bimbingan">
                        <i class="fa fa-file"></i>
                        <span>Laporan Bimbingan Pranikah</span>
                    </a>
                </li>
                <li <?php if ($page == "Laporan Pendaftaran Nikah") : ?>class="active" <?php endif ?>>
                    <a href="dashboard?pages=l-daftar">
                        <i class="fa fa-file"></i>
                        <span>Laporan Pendaftaran Nikah</span>
                    </a>
                </li>
                <li <?php if ($page == "Laporan Rekomendasi Nikah") : ?>class="active" <?php endif ?>>
                    <a href="dashboard?pages=l-rekomendasi">
                        <i class="fa fa-file"></i>
                        <span>Laporan Rekomendasi Nikah</span>
                    </a>
                </li>
            <?php endif ?>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>