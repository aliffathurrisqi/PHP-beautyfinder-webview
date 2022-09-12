<?php
include "../../koneksi.php";

$username = $_GET['username'];
$password = $_GET['password'];
$konfirmasi = $_GET['konfirmasi'];
$email = $_GET['email'];
$token = hash('sha256', md5(date('Y-m-d-H-i-s')));

if ($password == $konfirmasi) {

    $cekUser = mysqli_query($conn, "SELECT username,email FROM user WHERE email = '$email' OR username = '$username'");
    $jml = mysqli_num_rows($cekUser);

    if ($jml < 1) {

        $posts = array(
            "username" => $username,
            "email" => $email,
            "password" => $password,
            "konfirmasi" => $konfirmasi,
            "response" => "200",
            "result" => "Data Berhasil Ditambah"
        );
        $data = json_encode($posts);
        header('Content-Type: application/json');
        echo $data;

        include "mail_regist.php";

        $regist = mysqli_query(
            $conn,
            "INSERT INTO user VALUES('$username',md5($password),'$email','$username',NULL,'$token','User','Tidak')"
        );
    }
} else {
    $posts = array(
        "username" => $username,
        "password" => $password,
        "konfirmasi" => $konfirmasi,
        "response" => "400",
        "result" => "Proses Registrasi Gagal"
    );
    $data = json_encode($posts);
    header('Content-Type: application/json');
    echo $data;
}
