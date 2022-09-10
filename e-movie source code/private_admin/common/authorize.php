<?php
session_start();
// Set session variables
if(!isset($_SESSION["admin_user"])){
    if(!isset($_SESSION["super_user"]) ){
    header("Location:index.php?msg=<i class='errorMsg' id = 'ermsg'> Please login first! <span  id = 'errorClose'> close</span> </i>");
    }
}

?>