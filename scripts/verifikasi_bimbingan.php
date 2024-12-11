<?php
define('BASEPATH', true);
require '../config/connection.php';

if (isset($_GET['id_bimbingan']) && isset($_GET['jenis'])) {
    $id_bimbingan = $_GET['id_bimbingan'];
    $jenis = $_GET['jenis'];

    // Tentukan status berdasarkan jenis
    if ($jenis == 'tolak') {
        $status_pendaftaran = 'Ditolak';
    } else {
        $status_pendaftaran = 'Diterima';  // Misalnya jika jenis 'terima'
    }

    // Query untuk update status pendaftaran
    $sql = "UPDATE peserta_bimbingan SET status_pendaftaran = '$status_pendaftaran' WHERE id_sesi = '$id_bimbingan'";

    // Menjalankan query
    if ($connectdb->query($sql)) {
        echo '<script>alert("Data Berhasil Di Verifikasi");window.location="../dashboard?pages=peserta-bimbingan"</script>';
    } else {
        echo "error";    // Mengirimkan respons error jika gagal
    }
} else {
    echo "Invalid parameters.";
}
