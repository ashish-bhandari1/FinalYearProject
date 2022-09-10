<?php
  include_once("common/authorize.php");
  // Create database connection
  $mysqli = new mysqli("localhost","root","","movie_project");
  if(mysqli_connect_errno()){
  
      die("Error 01: cannot connect to Database <a href='#'>Report this error</a>". mysqli_connect_error());      
  }
  
  if( isset($_SESSION['admin_user'])){
     $theatre_id = $_SESSION['admin_tid'];
     $seatResult = $mysqli->query("SELECT * FROM seat WHERE theatre_id = '$theatre_id'");
     $printResult = $mysqli->query("SELECT * FROM seat WHERE theatre_id = '$theatre_id'");
  
  }
  if(isset($_SESSION['super_user'])){                
  $seatResult = $mysqli->query("SELECT * FROM seat");
  $printResult = $mysqli->query("SELECT * FROM seat");
  
  }
  
  $printRow = mysqli_fetch_assoc($printResult);                              
  
  ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Seat</title>
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
    <h3>Seat detail</h3>
    <?php if (isset($_GET['msg'])){
      echo $_GET['msg'];
      }    
      ?>
    <div style = "overflow:scroll">
      <table class="table" style="background-color:#fff">
        <thead class="thead-light">
          <tr>
            <th>#</th>
            <th>Hall Name</th>
            <th>Theatre Id</th>
            <th>Seat Row</th>
            <th>Seat Column</th>
            <th>Available</th>
            <th>Operation</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if($seatResult->num_rows >0){
                while($row = mysqli_fetch_assoc($seatResult)){
            ?>
          <tr>
            <th scope="row"><?php echo $row['id']; ?></th>
            <?php  
              $sql = "SELECT * FROM screening WHERE id = '$row[screening_id]'";
              $result = $mysqli->query($sql);
              while($hlRow = mysqli_fetch_assoc($result)){
              ?>
            <td>
              <?php  echo $hlRow['name'];
                } 
                ?> 
            </td>
            <td><?php echo $row['theatre_id']; ?></td>
            <td><?php echo $row['seat_row']; ?></td>
            <td><?php echo $row['seat_column']; ?></td>
            <td><?php echo $row['seat_availability']; ?></td>
            <td><a class="edit" href="functions/seat_update.php?ID=<?php echo $row['id']?>" title="Click here to edit this data"> <i class="fas fa-edit"></i>Edit data</a>
            </td>
          </tr>
          <?php  }} ?>
        </tbody>
      </table>
    </div>
    <!-- *************** Start Seat Select *************** -->
    <section id="seat-select-wrap">
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
                  for ($i = 0; $i<$printRow['seat_row']; $i++){
                      echo '<div class="seat-row">
                       <div class = "left"></div>';
                  
                      for($j = 1; $j<=$printRow['seat_column']; $j++ ){
                       $seatid = ('1'.$i.''.$j);
                       $bookResult = $mysqli->query("SELECT * FROM seat_booking WHERE seat_id = '$seatid' ");
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
  </body>
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
</html>