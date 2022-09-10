<?php 
  session_start();
  if(!isset($_SESSION['pw'])){
     header("location:register/login.php?msg= <i class='errorMsg' id = 'ermsg' style='color:red'>  Please login first to book movie <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
  }
  
  if(isset($_POST['moviebtn'])){
     $id = $_POST['id'];
     $time = $_POST['time'];
  
     $showtime = str_replace(' ', '', $time);
  }
  if(!isset($_POST['moviebtn'])){
     echo '<script>
     alert("Please, Select Movie First");
     window.location = "index.php";
     </script>';
  }
  
  
  date_default_timezone_set('Asia/Kathmandu');
  
  $mysqli = new mysqli('localhost' , 'root', '', 'movie_project');
  
  if(!$mysqli){
     die("<br>Error 01: cannot connect to Database <a href='#'>Report this error</a>". mysqli_connect_error());
     }
  
     $movieqry = $mysqli-> query("SELECT * FROM movie WHERE id = '$id'");
     if(!$movieqry){
        echo 'Can not connect to table <a href = "index.php">Back Home</a>';
     }
     $movieresult = mysqli_fetch_assoc($movieqry);
     $screenid = $movieresult['screening_id'];
  
     $seat = $mysqli-> query("SELECT * FROM seat WHERE screening_id = '$screenid'");
     if(!$seat){
        echo 'Can not connect to table <a href = "index.php">Back Home</a>';
     }      
     $row = mysqli_fetch_assoc($seat);
  
  
     $screeningqry = $mysqli-> query("SELECT * FROM screening WHERE id = '$screenid'");
     if(!$screeningqry){
        echo 'Can not connect to table <a href = "index.php">Back Home</a>';
     }
     $screeningresult = mysqli_fetch_assoc($screeningqry);
     
  
  ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> <?php echo $movieresult['name']; ?> </title>

    <link rel = "icon" type = "image/png" href = "images/icon.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah|Lobster&display=swap|Alatsi&display=swap" rel="stylesheet">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="package/css/swiper.min.css">
    <!-- local link -->
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <!--load all styles -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://khalti.com/static/khalti-checkout.js"></script>

  </head>
  <body>
    <!-- head nav _____________ start -->
    <?php include_once("common/mainNav.php"); ?>
    <!-- head nav _____________end -->
    <!-- *************** Start Seat Select *************** -->
    <div class = "booking-section-wrap">
      <section id="seat-select-wrap" class = "seat-section">
        <input type="hidden" id="transaction" value="0" />
        <div class="container clearfix">
          <div class="ticket-booking-wrapper">
            <div class="auditorium-layout-wrapper">
              <div class="screenSide">
                <h4>Screen</h4>
              </div>
              <!-- echo " <button class='Normal'>1</button> "; -->
              <div class="overflow-x-scroll">
                <div class="seat-layout">
                  <?php 
                    for ($i = 0; $i<$row['seat_row']; $i++){
                        echo '<div class="seat-row">
                         <div class = "left"></div>';
                    
                        for($j = 1; $j<=$row['seat_column']; $j++ ){
                         $seatid = ('1'.$i.''.$j);
                         $bookResult = $mysqli->query("SELECT * FROM seat_booking WHERE seat_id = '$seatid' AND m_id = '$id' AND show_time = '$showtime'");
                         $count = mysqli_num_rows($bookResult);
                    
                             if($count == 1){
                                 echo '<button class="seat-btn color Booked" id="'.($seatid).'" onclick="selectSeat('.($seatid).')" >'.($i.''.$j).'</button>';
                             }
                             else{
                                 echo '<button class="seat-btn color Normal" id="'.($seatid).'" onclick="selectSeat('.($seatid).')" >'.($i.''.$j).'</button>';
                             }
                         
                        }
                    echo '
                    <div class="left"></div>
                    <span class="seat-row-letter">'.($i+1).'</span>
                    </div>';
                    }
                    ?>
                </div>
              </div>
              <div class="seatInfo">
                <div class="reserved"></div>
                <span>Reserved</span>
                <div class="booked"></div>
                <span>Booked</span>
                <div class="available"></div>
                <span>Available</span>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class = "seat-section">
        <form  method="POST" action="function/obj.php">
          <input type = "text" name = "movieid" value = "<?php echo $id; ?>" style = "display:none">
          <input type = "text" name = "screenid" value = "<?php echo $screenid; ?>" style = "display:none">
          <div class = "billing">
            <div class = "bill">
              <div>
                <label> Movie Name: </label> 
                <p> <?php echo $movieresult['name']; ?> </p>
              </div>
              <div>
                <label> Hall Name: </label> 
                <p> <?php echo $screeningresult['name']; ?> </p>
              </div>
              <div><label> Seat: </label> <input type = "text" name = "seat_id" id="seat_id" required = "required" > </div>
              <div><label> Date: </label> <input type = "text" name = "date" value = "<?php echo date("F j, Y, g:i a");  ?>"  > </div>
              <div> <i style = "text-align:center">Nepal time </i> </div>
              <div><label> Movie time: </label> <input type = "text" name = "time" value = "<?php echo $showtime; ?>" > </div>
              <div>
                <label> Total Cost: </label> 
                <p> Rs: <p id = "total-cost">00</p> </p>
              </div>
            </div>
          </div>
          <input  id="count"  style = "display:none" type = "text" name = "seat" value = "0"  >
          <div class = "seat-button-wrapper"> 
            <button type="submit" onclick = "bookclick()" id = "bookbtn" name="bookSeat" class = "btn btn-primary"> Book </button>
            <a href = "index.php"> Cancel </a>
          </div>
        </form>
        <button id="payment-button" onclick = "pay()">Check Out</button>
      </section>
    </div>
    <!-- movie  end -->
  </body>
  <script src="js/script.js"></script>
  <script src="js/booking.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 
    <!-- Place this where you need payment button -->
    <!-- Place this where you need payment button -->
    <!-- Paste this code anywhere in you body tag -->
    <script>
    function pay(){
        var input = document.getElementById("seat_id").value;
        var amount  = document.getElementById("total-cost").textContent;
        var money = amount+'00';

        var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_dc74e0fd57cb46cd93832aee0a390234",
            "productIdentity": "1234567890",
            "productName": "Dragon",
            "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
            "eventHandler": {
                onSuccess (payload) {
                    // hit merchant api for initiating verfication
                    console.log(payload);
                },
                onError (error) {
                    console.log(error);
                },
                onClose () {
                    console.log('widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);


        if( input == ""){
            alert("Please Select Seat First");
        }
        else{
            checkout.show({amount: money});   
        }
    }
  
    </script>
    
 
  <?php include_once('common/footer.php'); ?>
</html>