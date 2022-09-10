<?php
   include_once('common/authorize.php');
    $mysqli = new mysqli("localhost","root","","movie_project");
   if(mysqli_connect_errno()){
   
       die("Error 01: cannot connect to Database <a href='#'>Report this error</a>". mysqli_connect_error());      
   }
   
   $sql = "SELECT * FROM complains";
   
   
   $result = $mysqli-> query($sql);
   
       
          
   // }
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Message</title>
      <?php
         include_once("common/link.php");
         ?>
      <link rel="stylesheet" type="text/css" href="css/body.css">
   </head>
   <body onload=printdate();>
      <!-- top nav end -->
      <!-- <div class="row"> -->
      <?php
         include_once("common/header.php");
         ?>
      <div class="col-md-10">
         <div class="theatreWrapper ">
            <h3>Messages</h3>
            <form method="POST" action="functions/obj.php" style="display:inline-block"> 
            <button style="border:none; background:#e7c6c6; margin:2px 0px; padding:8px 5px;" type="submit" name="clearMessage" onclick="return confirm('All Message will be cleared, this can not be undo.');" title="Click here to delete this data"> 
            <i class="fas fa-trash-alt" style="color:red"></i>Clear All Message
            </button>
          </form>
            <table class="table" style="background-color:#fff">
               <thead class="thead-light">
                  <tr>
                     <th>#</th>
                     <th>Phone</th>
                     <th>Email id</th>
                     <th>Message</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     if($result->num_rows >0){
                         while($row = mysqli_fetch_assoc($result)){
                     ?>
                  <tr>
                     <th scope="row"><?php echo $row['id']; ?></th>
                     <td><?php echo $row['phone']; ?></td>
                     <td><?php echo $row['email']; ?></td>
                     <td><?php echo $row['complain']; ?></td>
               
                  </tr>
                  <?php  }} ?>
               </tbody>
            </table>
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