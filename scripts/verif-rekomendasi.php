<?php
define('BASEPATH', true);
require '../config/connection.php';

$id = $_GET['n'];
$jenis = $_GET['j'];



if ($jenis == "tolak") {
    $status = "Pengajuan Ditolak";
} elseif ($jenis == "terima") {
    $status = "Pengajuan Di Proses";
} elseif ($jenis == "kirim-surat") {
    $status = "Pengajuan Selesai";
}
$sql = "UPDATE tbl_rekomendasi SET status= '$status' WHERE id='$id'";
$stmt = $connectdb->query($sql);
if ($stmt) {
    echo '<script>alert("Data Berhasil Di Verifikasi");window.location="../dashboard?pages=rekomendasi"</script>';
}
