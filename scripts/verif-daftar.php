<?php
define('BASEPATH', true);
require '../config/connection.php';

$id = $_GET['n'];
$status = "Pendaftaran Berhasil";
$sql = "UPDATE tbl_daftar_nikah SET status= '$status' WHERE id_daftar='$id'";
$stmt = $connectdb->query($sql);
if ($stmt) {
    $bulan = date('n');
    $tahun    = date('Y');
    $bln = date('m');
    $tgl_daftar = date('Y-m-d');
    // caridata
    $query = mysqli_query($connectdb, "SELECT MAX(kode_transaksi)as maxNo FROM tbl_penerimaan_pendaftaran WHERE month(tanggal)='$bulan'");
    $result = mysqli_fetch_array($query);
    $no = $result['maxNo'];
    // set nomor
    $noUrut = $no + 1;
    $kode =  sprintf("%02s", $noUrut);
    $nomorbaru = $kode . "/Kua.17.01-2/PN.01/" . $bln . "/" . $tahun;

    $inserData = $connectdb->query("INSERT INTO tbl_penerimaan_pendaftaran (nomor_surat_penerimaan, id_pendaftaran_nikah, tanggal ,kode_transaksi) 
             VALUES ('$nomorbaru','$id', '$tgl_daftar','$noUrut')");
    if ($inserData) {
        echo '<script>alert("Data Berhasil Di Verifikasi");window.location="../dashboard?pages=pendaftaran"</script>';
    }
}
