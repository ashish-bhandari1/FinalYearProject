<?php
   include_once('common/authorize.php');
   
   // Create database connection
   $mysqli = new mysqli("localhost", "root", "", "movie_project_admin");
      // Create database connection
      
      $sql = "SELECT * FROM banner";
      
      $result = $mysqli -> query($sql);
     
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Banner</title>
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
            <h1> add new banner form</h1>
            <i style="color:red">*Please add banner detail carefully*</i>
            <form method="POST" enctype="multipart/form-data" action="functions/obj.php">
               <div class="inputWrapper">
                  <div class="input">
                     <label>*Choose Image</label>
                     <input type="text" name="theatre_id" required="required" value="<?php echo $theatre_id; ?>" style = "display:none">
                     <input type="file" name="image" id="fileInput" required="required" accept=".jpg,.png">
                     <i style="color:green">Upload landscape size image for better view</i>
                  </div>
               </div>
               <div class="inputWrapper">
                  <div class="input">
                     <label>Image Title</label>
                     <input type="text" name="title" placeholder="Enter image title" required="required">
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
                  <button type="submit" name="uploadBanner">Upload</button>
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
         <h3>Banner  detail</h3>
         <?php if (isset($_GET['msg'])){
            echo $_GET['msg'];
            }    
            ?>
         <div class="buttoms">
            <a class="addMovie" href="javascript:addForm();" title="Click here to add new Movie"><i class="fas fa-upload"></i>Addnew Baner</a>
            <?php if(isset($_SESSION['super_user'])){  ?>           
            <form method="POST" action="functions/obj.php" style="display:inline-block">
               <button style="border:none; background:none" type="submit" name="truncateBanner">
               <a class="dltAll" onclick="return confirm('Are you sure you want to clear all banner?');" title="Click here to delete all banner">
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
                     <th scope="col">Banner image</th>
                     <th scope="col">Banner title</th>
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
                     <td><img src="../appimage/<?php echo $row['image'] ?>  "></td>
                     <td>  <?php echo $row['text'] ?> </td>
                     <td>  <?php
                        if ($row['status'] == 1)
                        {
                            echo "Active";
                        } 
                        else{echo "Inactive"; }?> 
                     </td>
                     <td>
                        <a class="edit" href="functions/banner_update.php?ID=<?php echo $row['id']?>" title="Click here to edit this data"> <i class="fas fa-edit"></i>Edit</a>
                        <form method="POST" action="functions/obj.php" style="display:block; margin:0px; padding:0px"> 
                           <input type = "text" name = "id" value = "<?php echo $row['id']?>" style="display:none">
                           <button style="border:none; background:none" type="submit" name="deleteBanner" onclick="return confirm('Are you sure you want to delete this Banner?');" title="Click here to delete this data"> 
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