<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../../vendor/autoload.php";
$mail = new PHPMailer(true);
$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
//ganti dengan email dan password yang akan di gunakan sebagai email pengirim
$mail->Username = "beautyfinder.id@gmail.com";
$mail->Password = "wthjyiidmxbfrmyu";
$mail->SMTPSecure = "ssl";
$mail->Port = 465;
//ganti dengan email yg akan di gunakan sebagai email pengirim
$mail->setFrom("beautyfinder.id@gmail.com", "Beautyfinder");
$mail->addAddress($email, $email);
$mail->isHTML(true);
$mail->Subject = "Aktivasi Akun";
$mail->Body = "Untuk melakukan verifikasi akun di Beautyfinder silakan klik tombol dibawah ini.
<br><br>
<a href='http://localhost:8080/beautyfinder/activation.php?t=" . $token . "' 
style='background-color: #BC53ED;
color: white;
padding: 14px 25px;
text-align: center;
width : 100%;
text-decoration: none;
display: inline-block;'>Aktivasi Akun</a>";
$mail->send();
