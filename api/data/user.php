<?php
include "../../koneksi.php";

$query = mysqli_query($conn, "SELECT * FROM user");


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
?>
