<?php 
session_start();
 unset($_SESSION['email']);
 unset($_SESSION['pw']);
 unset($_SESSION['id']);
 unset( $_SESSION["city"]);
 session_destroy();

 header("Location:../index.php");
 ?>