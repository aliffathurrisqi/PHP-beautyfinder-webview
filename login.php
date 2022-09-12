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
                    <hr>
                    <button class="btn btn-primary w-100 mb-3" name="btnLogin" style="width: 100%;">MASUK</button>
                    <!-- <a class="btn btn-success w-100 mb-3" href="register.php" style="width: 100%;">MENDAFTAR</a> -->
                    <!-- <a class="btn btn-danger w-100 mb-3" href="index.php?search=" style="width: 100%;">KEMBALI</a> -->
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

// Melakukan login
if (isset($_POST["btnLogin"])) {
    $userlog = $_POST["username"];
    $passwordlog = $_POST["password"];

    $login = mysqli_query($conn, "SELECT * FROM user WHERE username = '$userlog'");
    $row = mysqli_num_rows($login);
    $data = mysqli_fetch_array($login);
    if ($row > 0) {
        if ($data['password'] == md5($passwordlog)) {
            if ($data['akses'] == 'User') {
                $_SESSION['username'] = $userlog;
                echo '<script> location.replace("index.php?search="); </script>';
            }
            if ($data['akses'] == 'Admin') {
                $_SESSION['username'] = $userlog;
                echo '<script> location.replace("admin/"); </script>';
            }
        } else {
            echo '<script> alert("Username dan password tidak cocok"); </script>';
        }
    } else {
        echo '<script> alert("Username tidak ditemukan"); </script>';
        echo '<script> location.replace("login.php"); </script>';
    }
}

?>