<?php
include "../../koneksi.php";

$id = $_GET['id'];
$token = hash('sha256', md5(date('Y-m-d-H-i-s')));

$query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$id' OR email = '$id'");
$count = mysqli_num_rows($query);

if ($count > 0) {

    $posts = array();
    if (mysqli_num_rows($query)) {
        while ($get = mysqli_fetch_assoc($query)) {
            $posts[] = $get;
        }
    }
    $data = json_encode($posts, JSON_PRETTY_PRINT);
    header('Content-Type: application/json');
    // echo $data;

    $query2 = mysqli_query($conn, "SELECT * FROM user WHERE username = '$id' OR email = '$id'");
    $row = mysqli_fetch_array($query2);

    $dataUser = $row['username'];
    $email = $row['email'];

    mysqli_query($conn, "UPDATE user SET token = '$token' WHERE username = '$dataUser'");

    include "mail_forget.php";
    exit();
} else {
    $posts = array(
        "response" => "Response Gagal",
    );
    $data = json_encode($posts, JSON_PRETTY_PRINT);
    header('Content-Type: application/json');
    echo $data;
}
