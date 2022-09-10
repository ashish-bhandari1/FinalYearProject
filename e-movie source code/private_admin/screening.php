<?php
   include_once("common/authorize.php");
   $mysqli = new mysqli("localhost","root","","movie_project");
   if(mysqli_connect_errno()){
   
       die("Error 01: cannot connect to Database <a href='#'>Report this error</a>". mysqli_connect_error());      
   }
   
   if( isset($_SESSION['admin_user'])){
       $theatre_id = $_SESSION['admin_tid'];
       $theatreSQl = "SELECT * FROM theatre WHERE id = '$theatre_id'";
       $screening = "SELECT * FROM screening WHERE theatre_id = '$theatre_id'";
   
   }
   if(isset($_SESSION['super_user'])){                
       $theatreSQl = "SELECT * FROM theatre";
       $screening = "SELECT * FROM screening";
   
   }
   
   
   
   $thResult = $mysqli-> query($theatreSQl);
   
   $scResult = $mysqli-> query($screening);
   
       
          
   // }
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Screening</title>
      <?php include_once("common/link.php"); ?>
      <link rel="stylesheet" type="text/css" href="css/body.css">
   </head>
   <body onload=printdate();>
      <!-- top nav end -->
      <!-- SCREENING ADD FORM  _________________ START -->
      <div class="UploadFrom" id="formWrap">
         <div class="formWrapper grid">
            <h3><span class="close" id="closeform" onclick="closeFrom();" >&times;</span></h3>
            <h1> Add new screening hall</h1>
            <i style="color:red">*Please add data carefully*</i>
            <form method="POST" action="functions/obj.php">
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
                     <input type="text" name="hallName" required="required">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>Hall type </label>
                     <select name="type"  required="required">
                        <option  selected></option>
                        <option value="AC" >AC</option>
                        <option value="Non-AC" >Non-AC</option>
                     </select>
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label> Total seat number  </label>                   
                     <label id="error" style="color:red; text-transform: none;">  </label>
                     <input onkeyup="seatError('error')" id = "seats" type="number" name="totalSeat" required="required">
                  </div>
               </div>
               <div class="button d-flex justify-content-end">
                  <button type="submit" id="screeningBtn" name = "screeningAdd">Add data</button>
               </div>
            </form>
         </div>
      </div>
      <!-- SCREENING ADD FORM  _________________ END -->
      <!-- <div class="row"> -->
      <?php
         include_once("common/header.php");
         ?>
      <div class="col-md-10">
         <?php if (isset($_GET['msg'])){
            echo $_GET['msg'];
            }    
            ?> 
         <h3>Screening detail</h3>
         <div class="theatreWrapper ">
            <?php
               if($scResult->num_rows >0){
                   while($scRow = mysqli_fetch_assoc($scResult))
               {                          
               ?>
            <div class="tableWrapper">
               <div class="buttoms">
                  <a class="edit" href="functions/screening_update.php?ID= <?php echo $scRow['id']; ?>" title="Click here to edit this form">  <i class="fas fa-edit"></i>Edit form</a>
                  <form method="POST" action="functions/obj.php" style="display:inline-block"> 
                     <input type = "text" name = "id" value = "<?php echo $scRow['id']?>" style="display:none">
                     <button style="border:none; background:none" type="submit" name="deleteHall" onclick="return confirm('Are you sure you want to delete this Hall?');" title="Click here to delete this data"> 
                     <i class="fas fa-trash-alt" style="color:red"></i>Delete
                     </button>
                  </form>
               </div>
               <table class="theatreTable">
                  <tr>
                     <th> Hall name</th>
                     <td> <?php echo $scRow['name']; ?> </td>
                  </tr>
                  <tr>
                     <th>theatre name</th>
                     <td> 
                        <?php  
                           $sql = "SELECT name FROM theatre WHERE id = '$scRow[theatre_id]'";
                           $result = $mysqli->query($sql);
                           while($row = mysqli_fetch_assoc($result)){
                               echo $row['name'];
                           }
                           ?> 
                     </td>
                  </tr>
                  <tr>
                     <th> hall type</th>
                     <td> <?php echo $scRow['type']; ?> </td>
                  </tr>
                  <tr>
                     <th>seat number</th>
                     <td> <?php echo $scRow['seat_number']; ?> </td>
                  </tr>
               </table>
            </div>
            <?php
               } } ?>
         </div>
         <button class="addData" onclick="addForm();" title="Click here to add hall"> <i class="fas fa-plus-square"></i> Add Hall</button>
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