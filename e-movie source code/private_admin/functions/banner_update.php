<?php
   include_once('../common/authorize.php');
   $mysqli = new mysqli("localhost", "root", "", "movie_project_admin");
   if(mysqli_connect_errno()){
   
       die("Error 01: cannot connect to Database <a href='#'>Report this error</a>". mysqli_connect_error());      
   }
   $id = $_GET['ID'];   
   
   
   $sql = "SELECT * FROM banner WHERE id = '$id'"; 
   $result = $mysqli -> query($sql);
   $row = mysqli_fetch_assoc($result);    

   ?>

<!DOCTYPE html>
<html>
   <head>
      <?php include_once("../common/link.php"); ?>
      <link rel="stylesheet" type="text/css" href="../css/body.css">
   </head>
   <body>
      <!-- top nav end -->
      <!-- NEW IMAGE EDIT FILE  _________________ START -->
      <div class="editForm" id="formWrap">
         <div class="formWrapper grid ediTformWrapper">
            <h3><a href="../banner.php" style="text-decoration:none" onclick="return confirm('Are you exit current form?');"><span class="close" id="closeform" onclick="closeFrom();" >&times;</span></a></h3>
            <h1> Update menu form</h1>
            <br>
            <form method="POST"  action="obj.php">
               <div class="inputWrapper">
                  <div class="input" style="display:none">
                     <label>ID</label>
                     <input type="text" name="id" required="required" value="<?php echo $row['id']?>">
                  </div>
               </div>
               <div class="inputWrapper">
                  <img  class = "formimg" src="../../appimage/<?php echo $row['image'] ?>  ">
               </div>

               <div class="inputWrapper">
                  <div class="input">
                     <label>Banne title</label>
                     <input type="text" value = " <?php echo $row['text'] ?> " name="text" placeholder="Enter banner title" required="required">
                  </div>
               </div>
              
               <div class="radioWrapper">
                  <div class="input">
                     <label>*Status: </label>
                     <input type="radio" name="status" value="1"  <?php if ($row['status'] == 1) { echo 'checked="checked"'; }?> >
                     <label> Active</label>
                     <input type="radio" name="status" value="0"  <?php if ($row['status'] == 0) { echo 'checked="checked"'; }?> >
                     <label> Inactive</label>
                  </div>
                  <p><i>On choosing active will show up image in home page <span>And On choosing inactive will just upload image, it won't be shown</span> </i></p>
               </div>
               <div class="button d-flex justify-content-end">
                  <a href="../banner.php"onclick="return confirm('Are you exit current form?');" >Back</a>
                  <button type="submit" name="bannerEdit" >Update</button>
               </div>
            </form>
         </div>
      </div>
      <!-- NEW IMAGE UPLOAD FILE  _________________ END -->
      </div>
      </div>
      <!-- SEAT EDIT FORM  _________________ END -->
      <!-- <div class="row"> -->
      <script src="js/admin.js"></script>  
      <script src="bootstrap/js/bootstrap.min.js"></script>
   </body>
</html>