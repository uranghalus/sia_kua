<?php
define('BASEPATH', true);
require '../config/connection.php';
if (!session_id()) @session_start();
$nik = $_SESSION['user-data']['nik'];

$penerima = $_POST['penerima'];
$pengirim = $nik;
$judul = $_POST['judul'];
$pesan = $_POST['pesan'];

$tgl_pesan = date('Y-m-d');
$jenis = "KELUAR";
$status = 0;

$query = $connectdb->query("INSERT INTO tbl_pesan (id_k, nama_pengirim, id_penerima, pesan, judul_pesan, tgl_pesan, jenis, status) 
            VALUES (null, '$pengirim', '$penerima', '$pesan', '$judul', '$tgl_pesan', '$jenis', $status)");
if ($query) {
    $response = array(
        'info'      =>  1,
        'messages'      =>  "Pesan Terkirim",
    );
} else {
    $response = array(
        'info'      =>  0,
        'messages'      =>  mysqli_error($connectdb),
    );
}
echo json_encode($response);
