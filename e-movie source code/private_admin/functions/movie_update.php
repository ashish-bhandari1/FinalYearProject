<?php
   include_once('../common/authorize.php');
   $mysqli = new mysqli("localhost","root","","movie_project");
   if(mysqli_connect_errno()){
   
       die("Error 01: cannot connect to Database <a href='#'>Report this error</a>". mysqli_connect_error());      
   }
   $id = $_GET['ID'];   
   
   
   if( isset($_SESSION['admin_user'])){
    $theatre_id = $_SESSION['admin_tid'];
    $screening = "SELECT * FROM screening WHERE theatre_id = '$theatre_id'";
}
    if(isset($_SESSION['super_user'])){                
        $screening = "SELECT * FROM screening";
    }
    
   $seat = "SELECT * FROM movie WHERE id ='$id'";
   
   $scResult = $mysqli-> query($screening);
   
   $result = $mysqli-> query($seat);
   
   $row = mysqli_fetch_assoc($result);    
          
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
      <!-- NEW IMAGE EDIT FILE  _________________ START -->
      <div class="editForm" id="formWrap">
         <div class="formWrapper grid ediTformWrapper">
            <h3><a href="../movies.php" style="text-decoration:none" onclick="return confirm('Are you exit current form?');"><span class="close" id="closeform" onclick="closeFrom();" >&times;</span></a></h3>
            <h1> Update movie form</h1>
            <br>
            <i style="color:red">*Please add movie detail carefully*</i>
            <form method="POST" enctype="multipart/form-data" action="obj.php">
               <div class="inputWrapper">
                  <div class="input" style="display:none">
                     <label>ID</label>
                     <input type="text" name="id" required="required" value="<?php echo $row['id']?>">
                     <input type="text" name="theatre_id" required="required" value="<?php echo $theatre_id; ?>" style = "display:none">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label> Movie Image</label>
                  </div>
                  <img  class = "formimg" src="../../dbimage/<?php echo $row['image'] ?>  ">
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>Hall Name</label>
                     <select name="hallname">
                     <?php
                                    if($scResult->num_rows >0){
                                        while($scRow = mysqli_fetch_assoc($scResult)){
                                        echo " <option value='". $scRow['id']."' >".$scRow['name']." </option> ";
                                        }
                                    }
                        
                                    ?>
                     </select>
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>*Movie Name</label>
                     <input type="text" value = " <?php echo $row['name'] ?> " name="name" placeholder="Enter movie name" required="required">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>*Director Name</label>
                     <input type="text" name="director" value = " <?php echo $row['director'] ?> " placeholder="Enter Director Name" >
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>*Movie language</label>
                     <input type="text" name="language" value = " <?php echo $row['language'] ?> " placeholder="Enter movie language" required="required">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>*Movie genre</label>
                     <input type="text" name="genre" value = " <?php echo $row['genre'] ?> " placeholder="e.g. Love, Family, Drama" required="required">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>*Movie Hour</label>
                     <input type="text" name="hour" value = " <?php echo $row['movie_hour'] ?> " placeholder="Select movie hour" required="required">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>*Show Time</label>
                     <input type="text" name="time" value = " <?php echo $row['show_time'] ?> " placeholder="Select movie hour" required="required">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>Actor/Actress</label>
                     <input type="text" name="casts" value = " <?php echo $row['casts'] ?> " placeholder="Enter casts of movie">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>Movie Trailer Url</label>
                     <input type="text" name="url" value = " <?php echo $row['link'] ?>"  placeholder="Https//:www.youtube.com/watch''">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>Short description</label>
                     <input type="text" name="desc" value =" <?php echo $row['description'] ?>" >
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
                  <a href="../movies.php"onclick="return confirm('Are you exit current form?');" >Back</a>
                  <button type="submit" name="movieEdit" >Update</button>
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