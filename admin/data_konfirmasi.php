<?php
include "koneksi.php";
$id = $_GET['id'];

$confirm = mysqli_query($conn, "UPDATE toko SET verifikasi = 'Ya' WHERE id = $id");
echo '<script> location.replace("rekomendasi.php"); </script>';
?>
