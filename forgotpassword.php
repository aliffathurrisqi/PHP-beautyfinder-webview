<?php
session_start();
include "koneksi.php";
include_once "header.php";

$token = $_GET["t"];

$cekToken = mysqli_query($conn, "SELECT * FROM user WHERE token = '$token'");
$data = mysqli_fetch_array($cekToken);
$jml = mysqli_num_rows($cekToken);
if (isset($_GET['t']) && $jml > 0) {
?>
  <form method="POST">
    <div class="row align-items-center">
      <div class="col-md-3 mt-5">
      </div>
      <div class="col-md-6 mt-5">
        <div class="panel panel-info panel-dashboard">
          <div class="panel-body">
            <center>
              <img src="img/beautyfinder_logo.png" height="40px" class="mt-5 mb-5">
              <p> Perubahan Password akun <?php echo $data['username']; ?></p>
            </center>
            <div class="form-group">
              <label class="control-label">Password Baru</label>
              <input class="form-control" type="password" name="password" placeholder="Masukan password baru" autofocus autocomplete="off" required>
            </div>
            <div class="form-group">
              <label class="control-label">Password</label>
              <input class="form-control" type="password" name="konfirmasi" placeholder="Ulangi password baru" autofocus autocomplete="off" required>
            </div>
            <hr>
            <button class="btn btn-primary w-100 mb-3" name="btnUbah" style="width: 100%;">UBAH PASSWORD</button>
          </div>
        </div>
      </div>
      <div class="col-md-3 mt-5">
      </div>
    </div>
  </form>
  </div>
  </div>

<?php
} else {
  $_GET['t'] = "";
  $data = "";
  $jml = "";
  echo '<script> alert("Invalid Action"); </script>';
}

if (isset($_POST["btnUbah"])) {
  $password = $_POST["password"];
  $konfirmasi = $_POST["konfirmasi"];

  if ($password == $konfirmasi) {
    mysqli_query($conn, "UPDATE user SET password = md5('$password') WHERE token = '$token'");
    echo '<script> alert("Password Berhasil diubah"); </script>';
  } else {
    echo '<script> alert("Konfirmasi password berbeda"); </script>';
  }
}

?>