<?php
include "../../koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$id'");
$count = mysqli_num_rows($query);

if ($count > 0) {
    $posts = array();
    if (mysqli_num_rows($query)) {
        while ($get = mysqli_fetch_assoc($query)) {
            $posts[] = $get;
        }
    }
    $data = json_encode($posts);
    header('Content-Type: application/json');
    echo $data;
} else {
    $posts = array("username" => NULL, "password" => NULL, "nama_lengkap" => NULL, "img" => NULL, "akses" => NULL);
    $data = json_encode($posts);
    header('Content-Type: application/json');
    echo $data;
}
?>