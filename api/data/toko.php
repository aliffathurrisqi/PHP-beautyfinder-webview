<?php
include "../../koneksi.php";

$query = mysqli_query($conn, "SELECT toko.id,toko.nama_toko,kategori.nama_kategori,toko.alamat,
    toko.latitude,toko.longitude,kategori.simbol,toko.img
    FROM toko INNER JOIN kategori ON toko.id_kategori = kategori.id_kategori 
    WHERE toko.verifikasi = 'Ya'");


if ($query) {
    $posts = array();
    if (mysqli_num_rows($query)) {
        while ($get = mysqli_fetch_assoc($query)) {
            $posts[] = $get;
        }
    }
    $data = json_encode($posts, JSON_PRETTY_PRINT);
    header('Content-Type: application/json');
    echo $data;
}
