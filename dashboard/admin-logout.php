<?php
session_start();
unset($_SESSION["user_email"]);
header("Location:admin_login.php");
?>