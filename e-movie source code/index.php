<?php
   session_start();
   // Create database connection
   $mysqli = new mysqli("localhost", "root", "", "movie_project");
   if(!$mysqli){
   die("<br>Error 01: cannot connect to Database <a href='#'>Report this error</a>". mysqli_connect_error());
   }
   
   
   if(isset($_POST['pokhara'])){
   $_SESSION["city"] = "pokhara";
   }
   elseif(isset($_POST['ktm'])){
       $_SESSION["city"] = "kathmandu";
   }    
   elseif(isset($_POST['butwal'])){
       $_SESSION["city"] = "butwal";
   
   }elseif(isset($_POST['hetauda'])){
       $_SESSION["city"] = "hetauda";
   }

   //menu bar
   $mysqliAdmin = new mysqli("localhost", "root", "", "movie_project_admin");
   if(!$mysqliAdmin){
   die("<br>Error 01: cannot connect to Database <a href='#'>Report this error</a>". mysqli_connect_error());
   }
   

   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Home</title>
      <link rel = "icon" type = "image/png" href = "images/icon.png">
    <!-- For apple devices -->
      <link rel = "apple-touch-icon" type = "image/png" href = "images/icon.png"/>
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
      <!-- choose city start -->
      <?php if(!isset($_SESSION['city'])){ ?>
      <div class="city-wrapper" style="display:block">
         <?php } 
            if(isset($_SESSION['city'])){ ?>
         <div class="city-wrapper" style="display:none">
            <?php } ?>
            <form method="post" action="index.php">
               <h2>Choose your prefered city</h2>
               <button name="pokhara" type="submit">Pokhara</button>
               <button name="ktm" type="submit">Kathmandu</button>
               <button name="butwal" type="submit">Butwal</button>
               <button name="hetauda" type="submit">Hetauda</button>
            </form>
         </div>
      </div>

         <!-- choose city end -->
         <div class="jumbotron-fluid">
            <div class="galleryContainer">
               <div class="slideShowContainer">
                  <div id="playPause" onclick="playPauseSlides()"></div>
                  <div onclick="plusSlides(-1)" class="nextPrevBtn leftArrow"><span class="arrow arrowLeft"></span></div>
                  <div onclick="plusSlides(1)" class="nextPrevBtn rightArrow"><span class="arrow arrowRight"></span></div>
                  <div class="captionTextHolder">
                     <p class="captionText slideTextFromTop"></p>
                  </div>
                  <?php
                      $bannerResult = $connAdmin->query("SELECT * FROM banner WHERE status = '1'");
                     if($bannerResult->num_rows >0){
                     while($bannerRow = mysqli_fetch_assoc($bannerResult)){
                        echo '
                     <div class="imageHolder">
                        <img src="appimage/'. $bannerRow['image'] .'">
                        <p class="captionText" style = "font-size:40px">'. $bannerRow['text'] .'</p>
                     </div>
                     ';
                     }
                     }
                     ?>
               </div>
               <div id="dotsContainer"></div>
            </div>
         </div>
         <!-- theatre echo START-->
         <section id="theatre-section" class="hero">
         <div class="designBody " >
            <h2>Our Theatres</h2>
            <div class = "theatre-wrapper">
               <?php
                  $hallresult = $mysqli->query("SELECT * FROM theatre");
                     if($hallresult->num_rows >0){
                     while($hallRow = mysqli_fetch_assoc($hallresult)){
                        echo '
                  <div class = "theatre">
                        <div class="contain">
                        <img src="dbimage/'. $hallRow['image'] .'" alt="theatre" >
                     </div>
                     <div class = "link">
                     <h4>'. $hallRow['name'] .'</h4>
                        <a href = "#" ><i class="fas fa-phone"></i>'.$hallRow['phone'] .'</a>
                        <a href = "#" ><i class="fas fa-map-marker-alt" style = "color: rgb(98, 104, 105);"></i>'. $hallRow['city'] .','. $hallRow['country'] .'</a>
                     </div>
                  </div>
                     ';
                     }
                  }          
                  ?>
            </div>
         </div>
         </section>
         <!-- theatre echo END-->
         
         <hr style = " margin-bottom:3%;">
         <section id="movie-section" class="hero">
         <!-- Swiper -->
         <div class="swiper-container">
            <div class="swiper-wrapper " id="content">
               <!-- Slide 1 -->
               <div class="swiper-slide ">
                  <div class="second-nav">
                     <div class="second-navcontent container-fluid">
                        <ul class="nav nav-tabs">
                           <li class="nav-item">
                              <a class="nav-link active" href="javascript:ow_showing();">Now Showing</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link " href="javascript:hatshot();">What's Hot</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="javascript:omming_soon();">Comming soon</a>
                           </li>
                        </ul>
                     </div>
                     <div class="hall-dropdown">
                        <form method = "post" target = "index.php" >
                           <label> Choose Theatre</label>
                           <select name="hall-choose">
                              <option value="ALL"> ALL Theatre </option>
                              <?php
                                 $thResult = $mysqli->query("SELECT * FROM theatre");
                                  if($thResult->num_rows >0){
                                  while($thRow = mysqli_fetch_assoc($thResult)){
                                  echo " <option value='". $thRow['id']."' >".$thRow['name']." </option> ";
                                  }
                                 }
                                 
                                 ?>
                           </select>
                           <button name = "filter" type = "submit"> Filter </button>
                        </form>
                     </div>
                  </div>
                  <!-- movie card start-->
                  <?php 
                     if(isset($_POST['filter'])){
                        $theatrename = $_POST['hall-choose'];
                        if($theatrename == "ALL"){
                           $sql = "SELECT * FROM movie WHERE status = '1'";
                        }
                        else{
                           $sql = "SELECT * FROM movie WHERE theatre_id = '$theatrename' and status = '1'";
                        }
                     }else{
                        $sql = "SELECT * FROM movie WHERE status = '1'";
                     }
                     
                     $mresult = $mysqli -> query($sql);
                      ?>
                  <div class="movieWrapper">
                     <div class="cardWrapper">
                        <?php
                           if($mresult->num_rows >0){
                              $count = 0;
                               while($mrow = mysqli_fetch_assoc($mresult)){
                                 if($count == 4){
                                    echo '<div id="split"></div>';
                                    $count = 0;
                                 }
                              else{
                              $id = $mrow['id'];
                           ?>
                        <a href = "movies.php?id=<?php echo $id ?>" style = "color:#414141; text-decoration: none;">
                           <div class="card">
                              <div class="flip-card">
                                 <div class="flip-card-inner">
                                    <div class="flip-card-front">
                                       <img class="card-img-top" src="dbimage/<?php echo $mrow['image']; ?> " alt="Card image cap">
                                    </div>
                                    <div class="flip-card-back">
                                       <h3>Show Time</h3>
                                       <div>  <?php 
                                          $timelist = $mrow['show_time'];
                                          $times = explode(',' , $timelist);
                                          foreach($times as $time){
                                             echo '<p>'.$time.'</p>';
                                          }
                                          ?> 
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="card-body">
                                 <h4 class="card-title"><?php  echo $mrow['name']; ?>       </h4>
                                 <p class="card-topic"><span>Flim by:</span>
                                    <?php  echo $mrow['director']; ?>
                                 </p>
                     
                                 <p class="card-topic"><span>Language:</span>
                                    <?php  echo $mrow['language']; ?>
                                 </p>
                                 <p class="card-topic"><span>Casts:</span>
                                    <?php  echo $mrow['casts']; ?>
                                 </p>
                  
                                 <p class="card-topic" style = "background-image: linear-gradient(to right,  rgb(221, 221, 221),rgb(233, 233, 233));"><span>Theatre Name:</span>
                                    <?php
                                       $thid = $mrow['theatre_id'];
                                       $thResult = $mysqli -> query("SELECT * FROM theatre WHERE id = '$thid'");
                                       if($thResult->num_rows >0){
                                           while($thRow = mysqli_fetch_assoc($thResult)){
                                           echo $thRow['name'];
                                           }
                                       }
                                       
                                       ?>
                                 </p>
                                 <p class="card-topic"><span>Rating:</span>
                                    <?php 
                                       $rating = $mysqli -> query("SELECT * FROM rating WHERE mid = '$id'");
                                       if($rating->num_rows >0){
                                       
                                          $sum_qry = $mysqli -> query(" SELECT SUM(movie_rating) AS value_sum from rating WHERE mid = '$id'");
                                          $row_rating = mysqli_fetch_assoc($sum_qry);
                                          $sum = $row_rating['value_sum'];
                                          $total = mysqli_num_rows($rating);
                                          $average = round($sum/$total);
                                       
                                             for($i = 0; $i < $average; $i++ ){
                                             echo '<span class="fa fa-star checked"></span>';
                                          }
                                          for($i = 0; $i < (5 - $average); $i++){
                                             echo '<span class="fa fa-star "></span>';
                                          }
                                       
                                       }
                                          ?>
                                 </p>
                                 <p class="card-text view-more"> View More <i class="fas fa-arrow-right"></i> </p>
                                 <div class="trailer-frame" style="display:none; margin:5px auto" id="<?php  echo $mrow['id']; ?>">
                                    <div class="embed-responsive embed-responsive-16by9 ">
                                       <!-- yOUTUBE trailer frame -->
                                       <iframe class="embed-responsive-item " src="<?php  echo $mrow['link']; ?>" allowfullscreen></iframe>
                                    </div>
                                 </div>
                                 <br>
                        <a href="movies.php?id=<?php  echo $mrow['id']; ?> && time=12" class="btn btn-primary" id="book-now">Book</a>
                        <a href="javascript:openFrame(<?php  echo $id; ?>)" class="btn btn-primary " id="watch-trailer"><i class="fab fa-youtube" style="color:#c4302b"></i><span id = "trailer-vid<?php echo $id; ?>">Watch Trailer</span></a>
                        </div>
                        </div>
                        <?php 
                           $count = $count+1;
                           }
                        }
                     } ?>
                        </a>
                     </div>
                  </div>
                  <!-- movie card end-->
               </div>
               <!-- Slide 2 -->
               <div class="swiper-slide ">
                  <div class="second-nav">
                     <div class="second-navcontent container-fluid">
                        <ul class="nav nav-tabs">
                           <li class="nav-item">
                              <a class="nav-link " href="javascript:now_showing();">Now Showing</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link active" href="javascript:whatshot();">What's Hot</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="javascript:comming_soon();">Comming soon</a>
                           </li>
                        </ul>
                     </div>
                     <div class="hall-dropdown">
                        <label> Choose Hall</label>
                        <select name="hall-choose">
                           <option value="#"> echo hall </option>
                        </select>
                     </div>
                  </div>
               </div>
               <!-- Slide 3 -->
               <div class="swiper-slide ">
                  <div class="second-nav">
                     <div class="second-navcontent container-fluid">
                        <ul class="nav nav-tabs">
                           <li class="nav-item">
                              <a class="nav-link " href="javascript:now_showing();">Now Showing</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link " href="javascript:whatshot();">What's Hot</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link active" href="javascript:comming_soon();">Comming soon</a>
                           </li>
                        </ul>
                     </div>
                     <div class="hall-dropdown">
                        <label> Choose Hall</label>
                        <select name="hall-choose">
                           <option value="#"> echo hall </option>
                        </select>
                     </div>
                  </div>
               </div>
               <!-- Slide 4 -->
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
         </div>
         </section>
         <!-- sliding banner end -->
         
         <h1>
         </h1>
         <section id="about-section" class="hero">
            <div class = "about-wrapper">
            <h2>About Us</h2>
            <p> 
            Cinema-going is one of the most popular out-of-home cultural activities, affecting a serious of social, economic and cultural phenomena in modern societies. Cinemas are considered to be an integral part of cities and they contribute to the definition of a local geography and identity. They also contribute to the preservation of the collective memory, since they constitute a significant social and cultural practice linked to a specific place, which acts as a common reference or landmark for many individuals.            </p>
            <p>
            It is with the same mantras that he laid the foundation stone of his dream project, Right from day one, the idea was not to sell movie tickets or raise rental revenue, but rather to create a destination for people to celebrate life’s achievements. We do not claim to provide you with the absolute necessities. We are more about spending quality time with your loved ones and providing you with products which make a statement far louder than its utility. This idea has been the guiding principle for us in designing our spaces, planning our operations, choosing our clients and deciding what facilities that we should provide our clients and customers.
            </p>
            <p>
            This project is to compliment the new wave of excitement cinemas like QFX Cinema have generated in the society, so that people can sit in the comfort of their homes or internet cafes or even use their Smartphones and book their tickets and be assured   that their seats have been reserved. An online tickets system will encourage more movie fans and ultimately increase revenue for both film producers and cinema operators. The system also provide advertising opportunity for organizations and individuals to advertise their products on the website, the vouchers or the cinema tickets.
            </p>
            <p>
            Located in the heart of Pokhara, Zero KM is spread over 50,000 sq. ft., and houses some of the best brands in the country selling gadgets, apparels, shoes, cosmetics, designer wear and so on. Anchored by two state of the art movie theaters, we also have spaces allotted for restaurants, coffee shop, ice cream parlor, ATM lounge and a beauty salon. We are proud to say that we are one of the first (if not the first) differently-abled friendly commercial building in the city.
            </p>
            </div>
         </section>
         <section id="promotion-section" class="hero">
         </section>

      <!-- Add Pagination -->
      <!-- Swiper JS -->
      <script src="package/js/swiper.min.js"></script>
      <!-- Initialize Swiper -->
      <script>
         var swiper = new Swiper('.swiper-container', {
             pagination: {
                 el: '.swiper-pagination',
             },
         });
      </script>
      <script src="js/script.js"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   </body>
   <?php include_once('common/footer.php'); ?>
</html>