<?php
include "../../koneksi.php";

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT toko.id,toko.nama_toko,kategori.nama_kategori,toko.alamat,
    toko.latitude,toko.longitude,kategori.simbol,toko.img
    FROM toko INNER JOIN kategori ON toko.id_kategori = kategori.id_kategori 
    WHERE toko.verifikasi = 'Ya' AND toko.id = '$id'");


if ($query) {
    $posts = array();
    if (mysqli_num_rows($query)) {
        while ($get = mysqli_fetch_assoc($query)) {
            $posts[] = $get;
        }
    }
    $data = json_encode($posts);
    header('Content-Type: application/json');
    echo $data;
}
