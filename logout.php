<?php  
session_start();
unset($_SESSION['login']);
session_destroy();
session_start();
$_SESSION['msg']='logged Out';
header("location:login.php");
?>