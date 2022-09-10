<?php
   session_start();
   if(!isset($_SESSION["super_user"]) ){
   header("Location:index.php?msg=<i class='errorMsg' id = 'ermsg'> Please login As SuperAdmin! <span  id = 'errorClose'> close</span> </i>");
   }
   
   // Create database connection
   $mysqli = new mysqli('localhost', 'root', '', 'movie_project');
   if(mysqli_connect_errno()){
       die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
   }
   $query = $mysqli->query("SELECT * from theatre");
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>add admin</title>
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
         <h3>Admin Manage</h3>
         <?php if (isset($_GET['msg'])){
            echo $_GET['msg'];
            }    
            ?>
         <!-- NEW IMAGE UPLOAD FILE  _________________ START -->
         <div class="formWrapper grid">
            <h1> Add New Admin</h1>
            <br>
            <i style="color:red">*Please add movie detail carefully*</i>
            <form action="functions/obj.php" method = "post">
               <div class="inputWrapper">
                  <div class="input">
                     <label> Select Theatre</label>
                     <select name="id"> 
                     <?php while($row = mysqli_fetch_assoc($query)){ 
                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                        } ?>
                     </select>                  
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label> Username</label>
                     <input type="text" name = "username" placeholder="Enter Username">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label> Password</label>
                     <input type="password" name="password"placeholder="Enter Password">
                  </div>
               </div>
               <div class="button d-flex justify-content-end">
                  <label style = "color:red" id = "error"> </label>
                  <button name="add_admin" type="submit">Submit</button>
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