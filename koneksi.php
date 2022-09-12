<?php
$servername = "localhost";
$database   = "db_beautyfinder";
$username   = "root";
$password   = "";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
mysqli_query($conn, "SET time_zone = '+07:00'");
