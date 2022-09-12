<?php
include "koneksi.php";
$id = $_GET['id'];

$del = mysqli_query($conn, "DELETE FROM toko WHERE id = $id");
    echo '<script> location.replace("data.php"); </script>';
?>