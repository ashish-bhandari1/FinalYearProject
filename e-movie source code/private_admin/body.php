<?php
   include_once("common/authorize.php");
   
   // Create database connection
   $mysqli = new mysqli("localhost", "root", "", "movie_project");
   
   if(mysqli_connect_errno()){
   die("Error 01: cannot connect to Database 
   <a href='#'>
   Report this error</a>" . mysqli_connect_error());
   }
   
   $user = $mysqli-> query( "SELECT id from customer");
   $movie = $mysqli-> query( "SELECT id   from movie");
   $booking = $mysqli-> query( "SELECT id from seat_booking");
   
   //count data
   $user_count = mysqli_num_rows($user);
   $movie_count = mysqli_num_rows($movie);
   $booking_count = mysqli_num_rows($booking);
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Home</title>
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
         <div class="total_user">
            <i class="fas fa-users"></i>
            <h4>total user registered: <span> <?php echo $user_count; ?> </span></h4>
         </div>
         <div class="total_movie">
            <i class="fas fa-film"></i>
            <h4>total movie added: <span> <?php echo $movie_count ; ?></span></h4>
         </div>
         <div class="total_booking">
            <i class="fas fa-coins"></i>
            <h4>total booking made: <span> <?php echo $booking_count ;?></span></h4>
         </div>
         <br>
         <p style="text-align:left; color:red;">*Note: This data is not based on any particular Thratre. This is data of all registered theatres</p>
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