<?php
include "koneksi.php";

$search = $_GET['search'];

if ($search != NULL) {
        $Q = mysqli_query($conn, "SELECT toko.id,toko.nama_toko,kategori.nama_kategori,toko.alamat,
toko.latitude,toko.longitude,kategori.simbol,toko.img
FROM toko INNER JOIN kategori ON toko.id_kategori = kategori.id_kategori 
WHERE toko.verifikasi = 'Ya' AND kategori.nama_kategori = '$search'");
} else {
        $Q = mysqli_query($conn, "SELECT toko.id,toko.nama_toko,kategori.nama_kategori,toko.alamat,
        toko.latitude,toko.longitude,kategori.simbol,toko.img
        FROM toko INNER JOIN kategori ON toko.id_kategori = kategori.id_kategori AND toko.verifikasi = 'Ya'");
}

if (isset($_POST["btnCari"])) {
        $cari = $_POST["p_cari"];
        $Q = mysqli_query($conn, "SELECT toko.id,toko.nama_toko,kategori.nama_kategori,toko.alamat,
toko.latitude,toko.longitude,kategori.simbol,toko.img
FROM toko INNER JOIN kategori ON toko.id_kategori = kategori.id_kategori 
WHERE toko.verifikasi = 'Ya' AND toko.nama_toko LIKE '%$cari%'");
}

if ($Q) {
        $posts = array();
        if (mysqli_num_rows($Q)) {
                while ($post = mysqli_fetch_assoc($Q)) {
                        $posts[] = $post;
                }
        }
        $data = json_encode(array('results' => $posts), JSON_PRETTY_PRINT);
}
?>