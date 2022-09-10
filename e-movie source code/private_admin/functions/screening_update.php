<?php
   include_once('../common/authorize.php');
   $mysqli = new mysqli("localhost","root","","movie_project");
   if(mysqli_connect_errno()){
   
       die("Error 01: cannot connect to Database <a href='#'>Report this error</a>". mysqli_connect_error());      
   }
   $id = $_GET['ID'];
   
   if( isset($_SESSION['admin_user'])){
       $theatre_id = $_SESSION['admin_tid'];
       $theatreSQl = "SELECT * FROM theatre WHERE id = '$theatre_id'";
       $screening = "SELECT * FROM screening WHERE id = '$id'";
   
   }
   if(isset($_SESSION['super_user'])){                
       $theatreSQl = "SELECT * FROM theatre";
       $screening = "SELECT * FROM screening WHERE id = '$id'";
   
   }
   
   $thResult = $mysqli-> query($theatreSQl);
   
   $scResult = $mysqli-> query($screening);
   
   $row = mysqli_fetch_assoc($scResult);    
          
   // }
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <?php include_once("../common/link.php"); ?>
      <link rel="stylesheet" type="text/css" href="../css/body.css">
   </head>
   <body>
      <!-- top nav end -->
      <!-- SCREENING EDIT FORM  _________________ START -->
      <div class="editForm" id="formWrap">
         <div class="formWrapper grid ediTformWrapper">
            <h3><a href="../screening.php" style="text-decoration:none" onclick="return confirm('Are you exit current form?');" ><span>&times;</span></a></h3>
            <h1> Update Screening Detail</h1>
            <br>
            <i style="color:red; ">*Please update detail carefully*</i>
            <form method="POST" action="obj.php">
               <div class="inputWrapper">
                  <div class="input" style = "display:none">
                     <label>ID</label>
                     <input type="text" name="id" id="screening" required="required" value="<?php echo $row['id']?>">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>Select Theatre</label>
                     <select name="theatreName">
                     <?php
                        if($thResult->num_rows >0){
                            while($thRow = mysqli_fetch_assoc($thResult)){
                            echo " <option value='". $thRow['id']."' >".$thRow['name']." </option> ";
                            }
                        }
                          
                        ?>
                     </select>
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>Hall name</label>
                     <input type="text" name="hallName" value=" <?php echo $row['name'] ?> " required="required">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>Hall type </label>
                     <select name="type" value="php"  required="required">
                        <option  selected value="<?php echo $row['type'] ?>" ><?php echo $row['type'] ?></option>
                        <option value="AC" >AC</option>
                        <option value="Non-AC" >Non-AC</option>
                     </select>
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                  <label> Total seat number  </label>
                  <label id="error" style="color:red; text-transform: none;">  </label>
                     <input onkeyup="seatError('error')" id = "seats" type="number" name="totalSeat" value="<?php echo $row['seat_number'] ?>"  required="required">
                  </div>
               </div>
               <div class="button d-flex justify-content-end">
                  <a href="../screening.php" onclick="return confirm('Are you exit current form?');" >Back</a>
                  <button type="submit" id="screeningBtn" name="screeningEdit" >Update</button>
               </div>
            </form>
         </div>
      </div>
      <!-- SCREENING EDIT FORM  _________________ END -->
      <!-- <div class="row"> -->
      </body>
      <script src="../js/admin.js"></script>  
      <script src="../bootstrap/js/bootstrap.min.js"></script>
  
</html>
