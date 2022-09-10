<?php
session_start();
// Set session variables
if(!isset($_SESSION["user"]) ){
    header("Location:index.php?msg=<i class='errorMsg' id = 'ermsg'> Please login first! <span  id = 'errorClose'> close</span> </i>");
}

?>
