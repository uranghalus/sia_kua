<?php
session_start();
define('BASEPATH', true);
require '../config/connection.php';


$username = $_POST['username'];
$password = $_POST['password'];
$sql = "SELECT * FROM tbl_user WHERE nik= '$username' OR email= '$username'";

$stmt = $connectdb->query($sql);


// row count
$count = $stmt->num_rows;
if ($count > 0) {
    //Fetch row.
    $user = mysqli_fetch_array($stmt);
    //Compare and decrypt passwords.
    $isValid = password_verify($password, $user['password']);
    if ($isValid) {
        $_SESSION['user-data'] = $user;
        $_SESSION['status'] = "LOGGEDIN";
        $response = array(
            'info'      =>  1,
            'messages'      =>  "Anda Berhasil Masuk",
        );
    } else {
        $response = array(
            'info'      =>  0,
            'messages'      =>  "Password Anda Salah",
        );
    }
} else {
    $response = array(
        'info'      =>  0,
        'messages'      =>  "Username/Nip Tidak Terdaftar",
    );
}
echo json_encode($response);
