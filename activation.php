<!DOCTYPE html>
<html lang="en">
<?php
include "koneksi.php";
include "header.php";
?>

<body>
  <div class="container" align="center">
    <br>
    <?php
    $token = $_GET['t'];
    $sql_cek = mysqli_query($conn, "SELECT * FROM user WHERE token = '$token' AND verifikasi = 'Tidak'");

    $jml_data = mysqli_num_rows($sql_cek);
    if ($jml_data > 0) {
      //update data users aktif
      $data = mysqli_fetch_array($sql_cek);
      mysqli_query($conn, "UPDATE user SET verifikasi = 'Ya' WHERE token = '$token' AND verifikasi = 'Tidak'");
      // echo '<div class="alert alert-success">
      //                   Akun anda ' . $data['username'] . ' sudah aktif, silahkan Login
      //                   </div>';
      echo "<script>alert('Akun " . $data['username'] . " sudah aktif');</script>";
    } else {
      //data tidak di temukan
      echo "<script>alert('Token tidak valid');</script>";
    }
    ?>
  </div>
</body>

</html>