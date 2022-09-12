<?php
include "koneksi.php";
$Q = mysqli_query($conn, "SELECT toko.id,toko.nama_toko,kategori.nama_kategori,toko.alamat,
toko.latitude,toko.longitude,kategori.simbol,toko.img
FROM toko INNER JOIN kategori ON toko.id_kategori = kategori.id_kategori WHERE toko.verifikasi = 'Ya'");

if ($Q) {
        $posts = array();
        if (mysqli_num_rows($Q)) {
                while ($post = mysqli_fetch_assoc($Q)) {
                        $posts[] = $post;
                }
        }
        $data = json_encode(array('results' => $posts));
}
