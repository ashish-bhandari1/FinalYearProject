<?php
   include_once('common/authorize.php');
   
   // Create database connection
   $mysqli = new mysqli("localhost", "root", "", "movie_project");
   
   
   if( isset($_SESSION['admin_user'])){
   $theatre_id = $_SESSION['admin_tid'];
   $sql = "SELECT * FROM movie  WHERE theatre_id = '$theatre_id'";
   $scResult = $mysqli -> query("SELECT * FROM screening WHERE theatre_id = '$theatre_id' ");
   }

   if(isset($_SESSION['super_user'])){                
   $sql = "SELECT * FROM movie";
   $scResult = $mysqli -> query("SELECT * FROM screening  ");
   }
   
   $result = $mysqli -> query($sql);
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Movies</title>
      <?php
         include_once("common/link.php");
         ?>
      <link rel="stylesheet" type="text/css" href="css/body.css">
   </head>
   <body onload=printdate();>
      <!-- top nav end -->
      <!-- NEW IMAGE UPLOAD FILE  _________________ START -->
      <div class="UploadFrom" id="formWrap">
         <div class="formWrapper grid">
            <h3><span class="close" id="closeform" onclick="closeFrom();" >&times;</span></h3>
            <h1> add new movie form</h1>
            <i style="color:red">*Please add movie detail carefully*</i>
            <form method="POST" enctype="multipart/form-data" action="functions/obj.php">
               <div class="inputWrapper">
                  <div class="input">
                     <label>*Choose Movie Image</label>
                     <input type="text" name="theatre_id" required="required" value="<?php echo $theatre_id; ?>" style = "display:none">
                     <input type="file" name="image" id="fileInput" required="required" accept=".jpg,.png">
                     <i style="color:green">Upload Square size movie card for better view</i>
                  </div>
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
                     <input type="text" name="name" placeholder="Enter movie name" required="required">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>*Director Name</label>
                     <input type="text" name="director" placeholder="Enter Director Name" >
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>*Movie language</label>
                     <input type="text" name="language" placeholder="Enter movie language" required="required">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>*Movie genre</label>
                     <input type="text" name="genre" placeholder="e.g. Love, Family, Drama" required="required">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>*Movie Hour</label>
                     <input type="text" name="hour" placeholder="eg. 2:10:00 hour" required="required">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>*Show Time</label>
                     <input type="text" name="time" placeholder="eg. 2:10 AM, 12:00 PM" required="required">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>Actor/Actress</label>
                     <input type="text" name="casts" placeholder="Enter casts of movie">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>Movie Trailer Url</label>
                     <input type="text" name="url" placeholder="https://www.youtube.com/embed/">
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>Short description</label>
                     <textarea rows="3" cols="40" name="desc">
                     </textarea>
                  </div>
               </div>
               <div class="radioWrapper">
                  <div class="input">
                     <label>*Status: </label>
                     <input type="radio" name="status" value="1" checked="checked">
                     <label> Active</label>
                     <input type="radio" name="status" value="0">
                     <label> Inactive</label>
                  </div>
                  <p><i>On choosing active will show up image in home page <span>And On choosing inactive will just upload image, it won't be shown</span> </i></p>
               </div>
               <div class="button d-flex justify-content-end">
                  <button type="submit" name="uploadMovie">Upload</button>
               </div>
            </form>
         </div>
      </div>
      <!-- NEW IMAGE UPLOAD FILE  _________________ END -->
      <!-- <div class="row"> -->
      <?php
         include_once("common/header.php");
         ?>
      <div class="col-md-10">
         <h3>Movie  detail</h3>
         <?php if (isset($_GET['msg'])){
            echo $_GET['msg'];
            }    
            ?>
         <div class="buttoms">
            <a class="addMovie" href="javascript:addForm();" title="Click here to add new Movie"><i class="fas fa-upload"></i>Addnew movie</a>
            <?php if(isset($_SESSION['super_user'])){  ?>           
            <form method="POST" action="functions/obj.php" style="display:inline-block">
               <button style="border:none; background:none" type="submit" name="truncateMovie">
               <a class="dltAll" onclick="return confirm('Are you sure you want to delete this hall?');" title="Click here to delete all movies">
               <i class="fas fa-trash-alt" style="color:red"></i>Truncate form</a>
               </button>
            </form>
            <?php } ?>
         </div>
         <div style = "overflow:scroll">
            <table class="table table-bordered" >
               <thead class="thead-light">
                  <tr>
                     <th scope="col">#</th>
                     <th scope="col">Hall ID</th>
                     <th scope="col">Movie image</th>
                     <th scope="col">Movie Name</th>
                     <th scope="col">Show Time</th>
                     <th scope="col">Trailer URL</th>
                     <th scope="col">Director Name</th>
                     <th scope="col">language</th>
                     <th scope="col">genre</th>
                     <th scope="col">hour</th>
                     <th scope="col">casts</th>
                     <th scope="col">description</th>
                     <th scope="col">Status</th>
                     <th>Operation</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     if($result->num_rows >0){
                         while($row = mysqli_fetch_assoc($result)){
                     ?>   
                  <tr>
                     <th scope='row'> <?php echo $row['id'] ?> </th>
                     <td> <?php echo $row['screening_id'] ?> </td>
                     <td><img src="../dbimage/<?php echo $row['image'] ?>  "></td>
                     <td>  <?php echo $row['name'] ?> </td>
                     <td>  <?php echo $row['show_time'] ?> </td>
                     <td>  <?php echo $row['link'] ?> </td>
                     <td>  <?php echo $row['director'] ?> </td>
                     <td>  <?php echo $row['language'] ?> </td>
                     <td>  <?php echo $row['genre'] ?> </td>
                     <td>  <?php echo $row['movie_hour'] ?> </td>
                     <td>  <?php echo $row['casts'] ?> </td>
                     <td>  <?php echo $row['description'] ?> </td>
                     <td>  <?php
                        if ($row['status'] == 1)
                        {
                            echo "Active";
                        } 
                        else{echo "Inactive"; }?> 
                     </td>
                     <td>
                        <a class="edit" href="functions/movie_update.php?ID=<?php echo $row['id']?>" title="Click here to edit this data"> <i class="fas fa-edit"></i>Edit</a>
                        <form method="POST" action="functions/obj.php" style="display:block; margin:0px; padding:0px"> 
                           <input type = "text" name = "id" value = "<?php echo $row['id']?>" style="display:none">
                           <button style="border:none; background:none" type="submit" name="deleteMovie" onclick="return confirm('Are you sure you want to delete this Movie?');" title="Click here to delete this data"> 
                           <i class="fas fa-trash-alt" style="color:red"></i>Delete
                           </button>
                        </form>
                     </td>
                  </tr>
                  <?php }} ?> 
               </tbody>
            </table>
         </div>
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