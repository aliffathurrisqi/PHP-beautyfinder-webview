<?php
session_start();
include "koneksi.php";
include_once "header.php"; ?>
<form method="POST">
    <div class="row align-items-center">
        <div class="col-md-3 mt-5">
        </div>
        <div class="col-md-6 mt-5">
            <div class="panel panel-info panel-dashboard">
                <div class="panel-body">
                    <center>
                        <img src="img/beautyfinder_logo.png" height="40px" class="mt-5 mb-5">
                    </center>
                    <div class="form-group">
                        <label class="control-label">Username</label>
                        <input class="form-control" type="text" name="username" placeholder="Masukan username" autofocus autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <input class="form-control" type="password" name="password" placeholder="Masukan password" autofocus autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Ulangi Password</label>
                        <input class="form-control" type="password" name="konfirmasi" placeholder="Masukan password sekali lagi" autofocus autocomplete="off" required>
                    </div>
                    <hr>
                    <button class="btn btn-primary w-100 mb-3" name="btnRegist" style="width: 100%;">MENDAFTAR</button>
                    <a class="btn btn-danger w-100 mb-3" href="login.php" style="width: 100%;">KEMBALI</a>
                    <div class="mb-5"></div>
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

//daftar
if (isset($_POST["btnRegist"])) {
    $userReg = $_POST["username"];
    $passwordReg = $_POST["password"];
    $konfirmasiReg = $_POST["konfirmasi"];

    $login = mysqli_query($conn, "SELECT * FROM user WHERE username = '$userlog'");
    $row = mysqli_num_rows($login);
    if ($row == 0) {
        if ($passwordReg == $konfirmasiReg) {
            $regist = mysqli_query(
                $conn,
                "INSERT INTO user VALUES('$userReg','$passwordReg','$userReg',NULL,'User')"
            );
            echo '<script> location.replace("login.php"); </script>';
        }
    } else {
        echo '<script> alert("Username sudah terdaftar"); </script>';
        echo '<script> location.replace("register.php"); </script>';
    }
}
?>