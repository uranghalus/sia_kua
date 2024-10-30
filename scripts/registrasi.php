<?php
session_start();
define('BASEPATH', true);
require '../config/connection.php';

$nama = $_POST['nama'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$job = $_POST['job'];
$nik = $_POST['nik'];
$level = "MASYARAKAT";


// validasi email
$sql = "SELECT (email) FROM tbl_user WHERE email='$email'";
$stmt = $connectdb->query($sql);

$count = $stmt->num_rows;

if ($count > 0) {
    $response = array(
        'info'      =>  0,
        'messages'      =>  "Email Sudah Terdaftar",
    );
} else {
    $stmt_user = $connectdb->query("INSERT INTO tbl_user (nik, email, password ,level) 
             VALUES ('$nik','$email', '$password','$level')");
    if ($stmt_user) {
        $stmt_detail = $connectdb->query("INSERT INTO user_detail (nik, nama, alamat, pekerjaan) 
            VALUES ('$nik', '$nama', '$alamat', '$job')");
        if ($stmt_detail) {
            $response = array(
                'info'      =>  1,
                'messages'      =>  "Anda Berhasil Daftar",
            );
        } else {
            $response = array(
                'info'      =>  0,
                'messages'      =>  mysqli_error($connectdb),
            );
        }
    } else {
        $response = array(
            'info'      =>  0,
            'messages'      => mysqli_error($connectdb),
        );
    }
}
echo json_encode($response);
