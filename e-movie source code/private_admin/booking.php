<?php
   include_once("common/authorize.php"); 
   
   $mysqli = new mysqli("localhost","root","","movie_project");
   if(mysqli_connect_errno()){
   
      die("Error 01: cannot connect to Database <a href='#'>Report this error</a>". mysqli_connect_error());      
   }
   
   if( isset($_SESSION['admin_user'])){
      $theatre_id = $_SESSION['admin_tid'];
      $sql = "SELECT * FROM movie WHERE theatre_id = '$theatre_id'";
   }
   if(isset($_SESSION['super_user'])){                
      $sql = "SELECT * FROM movie";
   }
   
   $result = $mysqli-> query($sql);
   
   // }
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Theatre</title>
      <?php include_once("common/link.php"); ?>
      <link rel="stylesheet" type="text/css" href="css/body.css">
   </head>
   <body onload=printdate();>
      <!-- top nav end -->
      <!-- <div class="row"> -->
      <?php
         include_once("common/header.php");
         ?>
      <div class="col-md-10">
         <h3>Movie Bookings</h3>
         <div class="theatreWrapper ">
            <?php        
               if (isset($_GET['msg'])){
                   echo $_GET['msg'];
               }
               if($result->num_rows >0){
                   while($row = mysqli_fetch_assoc($result)){
               ?>
            <div class="tableWrapper">
               <img id="theatreimg" src="../dbimage/<?php echo $row['image'] ?>  ">
               <table class="theatreTable">
                  <tr>
                     <th>Movie name</th>
                     <td>
                        <?php   echo $row['name']; ?>
                     </td>
                  </tr>
                  <tr>
                     <th> Show Time</th>
                     <td>
                        <?php   echo $row['show_time']; ?>
                     </td>
                  </tr>
               </table>
               <form  id = "booking_form" method="POST" action="functions/obj.php" style="display:inline-block"> 
                  <input type = "text" name = "id" value = "<?php echo $row['id']?>" style="display:none">
                  <label>Show Time</label>
                  <select name = "time">
                  <?php 
                     $timelist = $row['show_time'];
                     $times = explode(',' , $timelist);
                     foreach($times as $time){
                         echo '<option value = "'.$time.'">'.$time.'</option>';
                     }
                     ?> 
                  </select>
                  <button style="border:none; " type="submit" name="bookingClear" onclick="return confirm('Are you sure you want to Clear booking of this movie?');" title="Click here to delete this data"> 
                  <i class="fas fa-trash-alt" style="color:red"></i>Clear Booking
                  </button>
               </form>
            </div>
            <?php }} ?>
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