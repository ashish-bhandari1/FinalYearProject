<?php 
  if(isset($_GET['id'])){
     $movie = $_GET['id'];
  } 
 
  $mysqli = new mysqli('localhost' , 'root', '', 'movie_project');
  
  if(!$mysqli){
     die("<br>Error 01: cannot connect to Database <a href='#'>Report this error</a>". mysqli_connect_error());
     }
  
     $qry = $mysqli-> query("SELECT * FROM movie WHERE id = '$movie'");
     if(!$qry){
        echo 'Can not connect to table <a href = "index.php">Back Home</a>';
     }
     $row = mysqli_fetch_assoc($qry);
  
  ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> <?php echo $row['name']; ?> </title>
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

    <?php if(isset($_GET['token']))
    { ?>
    <!-- token number start -->
     <div class = "token-wrapper">
      <div class = "token">
        <div class = "border1">
          <div class = "b">
          <button onclick = "print()" class = "btn btn-primary" >Print</button>
          </div>
          <div class = "head"> <img src = "images/logo.png" alt = "logo">
            <p>Token Code: <span><?php echo $_GET['token']; ?></span></p>
            <i>Note*: Please print out your token number or save it. Incase you lost it, company won't be Eligible </i>
          </div>
          <div class = "sign-wrapper"> 
          <div class = "sign"> 
            <p><u>CEO</u></p>
            <img src = "images/signature.png" alt = "verify">
            </div>
          </div>
        </div>
        <div class = "down-b">
          <a href = "movies.php?id= <?php echo $_GET['id']; ?>" class = "btn btn-primary" >I saved it</a>
          </div>
      </div>
     </div>
    <!-- token mumber _____________end -->
    <?php } ?>

    <div class = "detail-wrapper">
      <div class = "top-wrapper">
        <div class = "row">
          <div class = "col-md-5 flim">
            <iframe class="embed-responsive-item " src="<?php  echo $row['link']; ?>" allowfullscreen></iframe>
          </div>
          <div class = "col-md-6 detail" >
            <h1>   <?php  echo $row['name']; ?>   </h1>
            <p class="card-topic"><span>Flim by:</span>
              <?php  echo $row['director']; ?>
            </p>
            <p class="card-topic"><span>Length:</span>
              <?php  echo $row['movie_hour']; ?>
            </p>
            <p class="card-topic"><span>Language:</span>
              <?php  echo $row['language']; ?>
            </p>
            <p class="card-topic"><span>Casts:</span>
              <?php  echo $row['casts']; ?>
            </p>
            <p class="card-topic"><span>Genre:</span>
              <?php  echo $row['genre']; ?>
            </p>
            <p class="card-topic"><span>Hall Name:</span>
              <?php
                $hallid = $row['screening_id'];
                $scResult = $mysqli -> query("SELECT * FROM screening WHERE id = '$hallid'");
                if($scResult->num_rows >0){
                    while($scRow = mysqli_fetch_assoc($scResult)){
                    echo $scRow['name'];
                    }
                }
                
                ?>
            </p>
            <p class="card-topic"><span>Rating:</span>
              <?php 
                $rating = $mysqli -> query("SELECT * FROM rating WHERE mid = '$movie'");
                if($rating->num_rows >0){
                
                   $sum_qry = $mysqli -> query(" SELECT SUM(movie_rating) AS value_sum from rating WHERE mid = '$movie'");
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
            <p class="card-topic back-home" ><a class="card-text"  href = "index.php #movie-section"> <i class="fas fa-arrow-left"></i>Back Home  </a></p>
          </div>
        </div>
        <p class="card-topic" style = "margin:4px 10px; padding:5px 8px"> <?php  echo $row['description']; ?>
        </p>
        <div class = "book-now">
          <div class = "show-time">
            <?php 
              $timelist = $row['show_time'];
              $times = explode(',' , $timelist);
              foreach($times as $time){
                 echo '<p>'.$time.'</p>';
              }
               ?> 
          </div>
          <div class = "show-book">
            <form method = "post" action = "book.php"> 
              <label>Select Time</label>
              <select name = "time">
              <?php 
                $timelist = $row['show_time'];
                $times = explode(',' , $timelist);
                foreach($times as $time){
                   echo '<option value = "'.$time.'">'.$time.'</option>';
                }
                 ?> 
              </select>
              <input type = "text" name = "id" value = "<?php echo $movie ?>" style = "display:none">
              <button  class="btn btn-primary" name = "moviebtn" type = "submit"> Book Now</button>  
            </form>
          </div>
        </div>
      </div>
      <div class = "rating-wrapper">
        <h4> Rate This Movie  </h4>
        <form method = "post" action = "function/obj.php">
          <p> 
            <span class="fa fa-star " id = "rate-1" onclick="rating('rate-1')"></span> 
            <span class="fa fa-star " id = "rate-2" onclick="rating('rate-2')"></span> 
            <span class="fa fa-star " id = "rate-3"onclick="rating('rate-3')" ></span> 
            <span class="fa fa-star " id = "rate-4" onclick="rating('rate-4')"></span> 
            <span class="fa fa-star " id = "rate-5" onclick="rating('rate-5')"></span> 
          </p>
          <input type = "text"  name = "movie"  value = "<?php echo $movie; ?>">
          <input type = "number" id = "star" name = "star" >
          <label> Your Opinion </label>
          <textarea rows="3" cols="40" name="desc">
                     </textarea>
          <button name = "rating" type = "submit " style = "<?php if(isset($_GET['style'])){ echo $_GET['style']; } ?>"> Submit </button> 
        </form>
      </div>
      <div class = "show-rating">
        <h4> Viewers review  </h4>
        <?php 
          $review = $mysqli-> query("SELECT * FROM rating WHERE mid = '$movie'");
          if(!$review){
             echo 'Can not connect to rating table <a href = "index.php">Back Home</a>';
          }
          while($review_row = mysqli_fetch_assoc($review)){
             echo '<div class = "split">
                    <div class = "row"> 
                       <div class = "col-md-2">
                       <i class="fas fa-user"></i>
                       </div>
                       <div class = "col-md-9">';
             $sum = $row_rating['value_sum'];
             $total = mysqli_num_rows($rating);
             $istar = $review_row['movie_rating'];
             echo '<p>';
             for($i = 0; $i < $istar; $i++ ){
                echo '<span class="fa fa-star checked"></span>';
             }
             for($i = 0; $i < (5 - $istar); $i++){
                echo '<span class="fa fa-star "></span>';
             }
             echo '</p>';
             echo '<p>'. $review_row['description'] .'</p>';
              echo '     </div>
                      </div>
                   </div>';
          
          }
          ?>
      </div>
    </div>
    <!-- movie  end -->
  </body>
  <script src="js/script.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <?php include_once('common/footer.php'); ?>
</html>