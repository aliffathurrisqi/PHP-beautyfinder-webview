<?php

session_destroy();
session_start();
$_SESSION['username'] = NULL;
echo '<script> location.replace("../login.php"); </script>';
