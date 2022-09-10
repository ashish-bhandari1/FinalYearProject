<?php
   session_start();
   // Set session variables
   if(!isset($_SESSION["super_user"])){
       header("Location:../index.php?msg=<i class='errorMsg' id = 'ermsg'> You are not logged in as Super admin <span  id = 'errorClose'> close</span> </i>");
   }
    $mysqli = new mysqli("localhost","root","","movie_project_admin");
   if(mysqli_connect_errno()){
   
       die("Error 01: cannot connect to Database <a href='#'>Report this error</a>". mysqli_connect_error());      
   }
  
   $id = $_GET['ID'];

   $qry = $mysqli->query("SELECT * FROM menu WHERE id = '$id'");
   $row = mysqli_fetch_assoc($qry);    

          
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
            <h3><a href="../menu.php" style="text-decoration:none" onclick="return confirm('Are you exit current form?');" ><span>&times;</span></a></h3>
            <h1> Update Menu Detail</h1>
            <br>
            <?php if (isset($_GET['msg'])){
            echo $_GET['msg'];
            }    
            ?>
            <i style="color:red; ">*Please update detail carefully*</i>
            <form method="POST" action="obj.php">
               <div class="inputWrapper">
                  <div class="input" style = "display:none">
                     <label>ID</label>
                     <input type="text" name="id" id="screening" required="required" value="<?php echo $id; ?>">
                  </div>
               </div>

               <div class="inputWrapper">
                  <div class="input">
                     <label>Name</label>
                     <input type="text" name="name" value=" <?php echo $row['name'] ?> " required="required">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>Link</label>
                     <input type="text" name="link" value=" <?php echo $row['link'] ?> " required="required">
                  </div>
               </div>
               <div class="radioWrapper">
                  <div class="input">
                     <label>Status: </label>
                     <input type="radio" name="status" value="Active" <?php if($row['active'] == 'Active'){ echo 'checked="checked"';  } ?> >
                     <label> Active</label>
                     <input type="radio" name="status" value="Inactive" <?php if($row['active'] == 'Inactive'){ echo 'checked="checked"';  } ?>>
                     <label> Inactive</label>
                  </div>
 

               <div class="button d-flex justify-content-end">
                  <a href="../menu.php" onclick="return confirm('Are you exit current form?');" >Back</a>
                  <button type="submit" id="screeningBtn" name="editMenu" >Update</button>
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
