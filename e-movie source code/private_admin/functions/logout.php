<?php 
session_start();
 unset($_SESSION['adminuser']);
 unset($_SESSION['adminpw']);
 session_destroy();
 session_start();
 header("Location:../index.php");
 ?>