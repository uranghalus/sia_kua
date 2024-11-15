<?php
define('BASEPATH', true);
if (!session_id()) @session_start();
// // Check user login or not
if ($_SESSION['status'] != "LOGGEDIN") {
    header("Location: index");
    exit();
    die();
}
$role = $_SESSION['user-data']['level'];
if (isset($_GET['pages'])) {
    if ($_GET['pages'] == "konsultasi") {
        $page = "Konsultasi Nikah";
        $file = "NON";
    } elseif ($_GET['pages'] == "pendaftaran") {
        $page = "Pendaftaran Nikah";
        $file = "XCRUD";
    } elseif ($_GET['pages'] == "pranikah") {
        $page = "Bimbingan Pranikah";
        $file = "XCRUD";
    } elseif ($_GET['pages'] == "view-bimbingan") {
        $page = "Bimbingan Pranikah";
        $file = "XCRUD";
    } elseif ($_GET['pages'] == "peserta-bimbingan") {
        $page = "Bimbingan Pranikah";
        $file = "XCRUD";
    } elseif ($_GET['pages'] == "rekomendasi") {
        $page = "Surat Rekomendasi Nikah";
        $file = "XCRUD";
    } elseif ($_GET['pages'] == "M-Kua") {
        $page = "Master Data Daftar KUA";
        $file = "XCRUD";
    } elseif ($_GET['pages'] == "M-Penghulu") {
        $page = "Master Data Penghulu";
        $file = "XCRUD";
    } elseif ($_GET['pages'] == "upload-bayar-r") {
        $page = "Upload Bukti Pembayaran Pendaftaran Nikah";
        $file = "XCRUD";
    } elseif ($_GET['pages'] == "tolak-daftar") {
        $page = "Penolakan Pendaftaran Nikah";
        $file = "XCRUD";
    } elseif ($_GET['pages'] == "jadwal") {
        $page = "Jadwal Nikah";
        $file = "XCRUD";
    } elseif ($_GET['pages'] == "l-daftar") {
        $page = "Laporan Pendaftaran Nikah";
        $file = "NON";
    } elseif ($_GET['pages'] == "l-rekomendasi") {
        $page = "Laporan Rekomendasi Nikah";
        $file = "NON";
    } elseif ($_GET['pages'] == "balas-pesan") {
        $page = "Balas Pesan";
        $file = "NON";
    } elseif ($_GET['pages'] == "pesan-keluar") {
        $page = "Pesan Keluar";
        $file = "NON";
    } elseif ($_GET['pages'] == "detail-pesan-masuk") {
        $page = "Baca Email";
        $file = "NON";
    } elseif ($_GET['pages'] == "detail-pesan-keluar") {
        $page = "Baca Email";
        $file = "NON";
    }
} else {
    $page = "Dashboard";
    $file = "NON";
}
require_once "config/connection.php";
$nik = $_SESSION['user-data']['nik'];
$sql = "SELECT * FROM user_detail WHERE nik= $nik";
$stmt = $connectdb->query($sql);



//Fetch row.
$user = $stmt->fetch_assoc();
$year = date('Y');
?>
<html>

<?php include 'partials/header.php' ?>

<body class="hold-transition skin-green-light sidebar-mini">
    <div class="wrapper">

        <!-- Main Header -->
        <?php include 'partials/navigation.php' ?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php include 'partials/sidebar.php' ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php include 'partials/content-header.php' ?>

            <!-- Main content -->
            <section class="content">

                <?php
                if (isset($_GET['pages'])) {
                    if ($_GET['pages'] == "konsultasi") {
                        include 'pages/konsultasi.php';
                    } elseif ($_GET['pages'] == "pendaftaran") {
                        include 'pages/pendaftaran.php';
                    } elseif ($_GET['pages'] == "pranikah") {
                        include 'pages/pranikah.php';
                    } elseif ($_GET['pages'] == "view-bimbingan") {
                        include 'pages/view-bimbingan.php';
                    } elseif ($_GET['pages'] == "peserta-bimbingan") {
                        include 'pages/peserta-bimbingan.php';
                    } elseif ($_GET['pages'] == "rekomendasi") {
                        include 'pages/rekomendasi.php';
                    } elseif ($_GET['pages'] == "M-Kua") {
                        include 'pages/m_kua.php';
                    } elseif ($_GET['pages'] == "M-Penghulu") {
                        include 'pages/m_penghulu.php';
                    } elseif ($_GET['pages'] == "upload-bayar-r") {
                        include 'pages/upload-bayar.php';
                    } elseif ($_GET['pages'] == "tolak-daftar") {
                        include 'pages/tolak-daftar.php';
                    } elseif ($_GET['pages'] == "jadwal") {
                        include 'pages/jadwal.php';
                    } elseif ($_GET['pages'] == "l-daftar") {
                        include 'pages/lap-pendaftaran.php';
                    } elseif ($_GET['pages'] == "l-rekomendasi") {
                        include 'pages/lap-rekomendasi.php';
                    } elseif ($_GET['pages'] == "create-pesan") {
                        include 'pages/create-pesan.php';
                    } elseif ($_GET['pages'] == "pesan-keluar") {
                        include 'pages/pesan-keluar.php';
                    } elseif ($_GET['pages'] == "detail-pesan-keluar") {
                        include 'pages/detail-pesan.php';
                    } elseif ($_GET['pages'] == "detail-pesan-masuk") {
                        include 'pages/detail-pesan-masuk.php';
                    } elseif ($_GET['pages'] == "balas-pesan") {
                        include 'pages/balas-pesan.php';
                    }
                } else {
                    include 'pages/home.php';
                }
                ?>

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
                App Version 1.0.0
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; <?= $year ?> <a href="#">SIA KUA</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <?php include 'partials/footer.php' ?>


</body>

</html>