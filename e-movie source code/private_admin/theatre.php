<?php
  include_once("common/authorize.php"); 
  
  $mysqli = new mysqli("localhost","root","","movie_project");
  if(mysqli_connect_errno()){
  
     die("Error 01: cannot connect to Database <a href='#'>Report this error</a>". mysqli_connect_error());      
  }
  
  if( isset($_SESSION['admin_user'])){
     $theatre_id = $_SESSION['admin_tid'];
     $sql = "SELECT * FROM theatre WHERE id = '$theatre_id'";
  }
  if(isset($_SESSION['super_user'])){                
     $sql = "SELECT * FROM theatre";
  }
  
  $result = $mysqli-> query($sql);
  
  // }
  
  ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Theatre</title>
    <?php include_once("common/link.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/body.css">
  </head>
  <body onload=printdate();>
    <!-- top nav end -->
    <!-- THEATRE UPDATE FORM  _________________ START -->
    <div class="UploadFrom" id="formWrap">
      <div class="formWrapper grid">
        <h3><span class="close" id="closeform" onclick="closeFrom();" >&times;</span></h3>
        <h1> Add New theatre</h1>
        <i style="color:red">*Please update data carefully*</i>
        <form method="POST" enctype="multipart/form-data" action="functions/obj.php">
          <div class="inputWrapper">
            <div class="input">
              <label>*Choose Image</label>
              <input type="file" name="image" id="fileInput" required="required" accept=".jpg,.png">
              <i style="color:green">Upload Square size image card for better view</i>
            </div>
          </div>
          <div class="inputWrapper">
            <div class="input">
              <label>Theatre name</label>
              <input type="text" name="name" id="theatrename" required="required">
            </div>
          </div>
          <div class="inputWrapper">
            <div class="input">
              <label>Contact number</label>
              <input type="number" name="number" required="required">
            </div>
          </div>
          <div class="inputWrapper">
            <div class="input">
              <label>Theatre email </label>
              <input type="email" name="email" required="required">
            </div>
          </div>
          <div class="inputWrapper">
            <div class="input">
              <label> City </label>
              <input type="text" name="city" required="required">
            </div>
          </div>
          <div class="inputWrapper">
            <div class="input">
              <label> Country </label>
              <input type="text" name="country" required="required">
            </div>
          </div>
          <div class="inputWrapper">
            <div class="input">
              <label> Postal Code </label>
              <input type="text" name="postal" required="required">
            </div>
          </div>
          <div class="button d-flex justify-content-end">
            <button type="submit" name="theatreAdd">Upload</button>
          </div>
        </form>
      </div>
    </div>
    <!-- THEATRE UPDATE FORM  _________________ END -->
    <!-- <div class="row"> -->
    <?php
      include_once("common/header.php");
      ?>
    <div class="col-md-10">
      <h3>Theatre detail</h3>
      <div class="theatreWrapper ">
        <?php        
          if (isset($_GET['msg'])){
              echo $_GET['msg'];
          }
          if($result->num_rows >0){
              while($row = mysqli_fetch_assoc($result)){
          ?>
        <div class="tableWrapper">
          <img id="theatreimg" src="../dbimage/<?php echo $row['image'] ?>  ">
          <table class="theatreTable">
            <tr>
              <th>theatre name</th>
              <td>
                <?php   echo $row['name']; ?>
              </td>
            </tr>
            <tr>
              <th> Address</th>
              <td>
                <?php   echo $row['city'].','.$row['country']; ?>
              </td>
            </tr>
            <tr>
              <th> zip code</th>
              <td>
                <?php   echo $row['postal_code']; ?>
              </td>
            </tr>
            <tr>
              <th>theatre phone</th>
              <td>
                <?php   echo $row['phone']; ?>
              </td>
            </tr>
            <tr>
              <th>theatre email</th>
              <td>
                <?php   echo $row['email']; ?>
              </td>
            </tr>
          </table>
          <a class="addData" href="functions/theatre_update.php?ID=<?php echo $row['id'] ?>" title="Click here to edit theatre detail"> <i class="fas fa-edit"></i> Update Detail</a>
          <?php 
            if(isset($_SESSION['super_user'])){  ?>                        
          <form method="POST" action="functions/obj.php" style="display:inline-block"> 
            <input type = "text" name = "id" value = "<?php echo $row['id']?>" style="display:none">
            <button style="border:none; background:none" type="submit" name="deleteTheatre" onclick="return confirm('Are you sure you want to delete this Theatre?');" title="Click here to delete this data"> 
            <i class="fas fa-trash-alt" style="color:red"></i>Delete
            </button>
          </form>
          <?php } ?>
        </div>
        <?php }} ?>
      </div>
      <?php 
        if(isset($_SESSION['super_user'])){  ?>                        
      <button class="addData" onclick="addForm();" title="Click here to add hall"> <i class="fas fa-plus-square"></i> Add Hall</button>
      <?php } ?>
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