<?php 
   // Create database connection
   $mysqli = new mysqli("localhost", "root", "", "movie_project");
   if(!$mysqli){
   die("<br>Error 01: cannot connect to Database <a href='#'>Report this error</a>". mysqli_connect_error());
   }
   $sql = "SELECT * FROM movie";
   $mresult = $mysqli -> query($sql);
   ?>
    <!DOCTYPE html>
    <html>

    <head>
       <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah|Lobster&display=swap|Alatsi&display=swap" rel="stylesheet">
        <!-- Link Swiper's CSS -->
        <link rel="stylesheet" href="../package/css/swiper.min.css">
        <!-- local link -->
        <link href="../fontawesome/css/all.css" rel="stylesheet">
        <!--load all styles -->
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>

    <body>
        
            <!-- Swiper -->
            <div class="swiper-container">
                <div class="swiper-wrapper " id="content">
                    <!-- Slide 1 -->
                    <div class="swiper-slide ">
                        <div class="second-nav">
                            <div class="second-navcontent container-fluid">
                                <ul class="nav nav-tabs">

                                    <li class="nav-item">
                                        <a class="nav-link active" href="javascript:now_showing();">Now Showing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="javascript:whatshot();">What's Hot</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript:comming_soon();">Comming soon</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="hall-dropdown">
                            <label> Choose Theatre</label>
                                <select name="hall-choose">
                                    <option value="#"> echo Theatre </option>
                                </select>
                                <label> Choose Hall</label>
                                <select name="hall-choose">
                                    <option value="#"> echo hall </option>
                                </select>
                            </div>
                        </div>
                        <!-- movie card start-->
                        <div class="movieWrapper">
                            <div class="cardWrapper">
                                <?php
               if($mresult->num_rows >0){
                   while($mrow = mysqli_fetch_assoc($mresult)){
               ?>
                                    <div class="card">
                                        <img class="card-img-top" src="../dbimage/<?php echo $mrow['image']; ?> " alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title"><?php  echo $mrow['name']; ?>       </h4>
                                            <p class="card-topic"><span>Flim by:</span>
                                                <?php  echo $mrow['director']; ?>
                                            </p>
                                            <p class="card-topic"><span>Length:</span>
                                                <?php  echo $mrow['movie_hour']; ?>
                                            </p>
                                            <p class="card-topic"><span>Language:</span>
                                                <?php  echo $mrow['language']; ?>
                                            </p>
                                            <p class="card-topic"><span>Casts:</span>
                                                <?php  echo $mrow['casts']; ?>
                                            </p>
                                            <p class="card-topic"><span>Genre:</span>
                                                <?php  echo $mrow['genre']; ?>
                                            </p>
                                            <p class="card-topic"><span>Hall Name:</span>
                                                <?php
                        $hallid = $mrow['screening_id'];
                         $scResult = $mysqli -> query("SELECT * FROM screening WHERE screening_id = '$hallid'");
                        if($scResult->num_rows >0){
                            while($scRow = mysqli_fetch_assoc($scResult)){
                            echo $scRow['name'];
                            }
                        }

                        ?>
                                            </p>
                                            <p class="card-text"><i>
                     <?php  echo $mrow['description']; ?>                           
                     </i>
                                            </p>
                                            <div class="trailer-frame" style="display:none; margin:5px auto" id="<?php  echo $mrow['movie_id']; ?>">
                                                <div class="embed-responsive embed-responsive-16by9 ">
                                                    <!-- yOUTUBE trailer frame -->
                                                    <iframe class="embed-responsive-item " src="https://www.youtube.com/embed/v64KOxKVLVg" allowfullscreen></iframe>
                                                </div>
                                            </div>
                                            <hr>
                                            <a href="#!" class="btn btn-primary" id="book-now">Buy</a>
                                            <a href="javascript:openFrame(<?php  echo $mrow['movie_id']; ?>)" class="btn btn-primary " id="watch-trailer"><i class="fab fa-youtube" style="color:#c4302b"></i>Watch Trailer</a>
                                        </div>
                                    </div>
                                    <?php }} ?>
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
            <!-- sliding banner end -->

          
            </div>
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
            <script src="../js/script.js"></script>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
 

    </html>