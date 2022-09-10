<?php
   include_once('common/authorize.php');
   
   // Create database connection
   
   ?>
<!DOCTYPE html>
<html>
   <head>
   <title>Password</title>
      <?php
         include_once("common/link.php");
         ?>
      <link rel="stylesheet" type="text/css" href="css/body.css">
   </head>
   <body onload=printdate();>
      <!-- top nav end -->

      <!-- NEW IMAGE UPLOAD FILE  _________________ END -->
      <!-- <div class="row"> -->
      <?php
         include_once("common/header.php");
         ?>
      <div class="col-md-10">
         <h3>Password Manage</h3>
         <?php if (isset($_GET['msg'])){
            echo $_GET['msg'];
            }    
            ?>
   <!-- NEW IMAGE UPLOAD FILE  _________________ START -->
         <div class="formWrapper grid">
            <h1> Change Your Password</h1>
            <br>
            <i style="color:red">*Make sure your password is hard to guess by other*</i>
            <form method="POST" action="functions/obj.php">
               <div class="inputWrapper">
                  <div class="input">
                     <label> Current Password</label>
                     <input type="password" id="current_pw" name="currentpw"  required="required" placeholder="Enter Password" >
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label> New Password</label>
                     <input type="password" id="new_pw" onkeyup="password_valid()" name="newpw"  required="required" placeholder="Type Password">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label> ReEnter Password</label>
                     <input type="password" id="renew_pw" name="repw" onkeyup="password_valid()" required="required" placeholder="Retype Password" >
                  </div>
               </div>
               <div class="button d-flex justify-content-end">
               <label style = "color:red" id = "error"> </label>
                  <button id="passwordBtn" type="submit" name="changePw">Change</button>
               </div>
            </form>
         </div>
    
 
      </div>
      </div>
      <script src="js/admin.js"></script>
      <script>
         var icon = document.getElementById('menu');
         var Menu = document.getElementById('dropdownMenu');
         icon.onclick = function() {
             if (Menu.className === "col-md-2") {
                 Menu.classList.add("menuActive");
             } else {
                 Menu.className = "col-md-2";
             }
         }
      </script>
      <script src="bootstrap/js/bootstrap.min.js"></script>
   </body>
</html>