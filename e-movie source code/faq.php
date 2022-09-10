<?php
   session_start();
   // Create database connection
   $mysqli = new mysqli("localhost", "root", "", "movie_project");
   if(!$mysqli){
   die("<br>Error 01: cannot connect to Database <a href='#'>Report this error</a>". mysqli_connect_error());
   }
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>FAQ</title>
      <link rel = "icon" type = "image/png" href = "images/icon.png">
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
      <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah|Lobster&display=swap|Alatsi&display=swap" rel="stylesheet">
      <!-- Link Swiper's CSS -->
      <link rel="stylesheet" href="package/css/swiper.min.css">
      <!-- local link -->
      <link href="fontawesome/css/all.css" rel="stylesheet">
      <!--load all styles -->
      <link rel="stylesheet" type="text/css" href="css/style.css">
   </head>
   <body>
      <!-- head nav _____________ start -->
      <?php include_once("common/mainNav.php"); ?>
      <!-- head nav _____________end -->
      <!-- theatre echo END-->
      <section id="about-section" class="hero">
         <div class = "faq-wrapper">
            <h2>Frequently Asked Question</h2>
            <ul>
            <li>
               <p class = "bullet">What is e-Movie Booking</p><p>
               e-Movie is Golden Screen Cinemas’ flagship ultra-luxe boutique cinema. Designed to deliver true cinematic luxury, it features opulent halls with luxury recliners, private cabins, bespoke service, contemporary dining and more. It sets a gold standard in extravagant cinema experiences and is a treat for special occasions or moments of indulgence. 
                </p>
            </li>
            <li>
            <p class = "bullet">Is there any discounts if I have a credit card? </p><p>
            There are presently no promotions or discounts available for credit card. </P>
            </li>
            <li>
            <p class = "bullet">Can I bring my child to Theatre? </p><p>
            Yes, children are allowed into Theatre. Children under the age of 3 years old may enter for free, however, those above 3 years old will require an Aurum Pass of their own to enter.                </P>
            </li>
         </div>
      </section>

      <script src="js/script.js"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   </body>
   <?php include_once('common/footer.php'); ?>
</html>