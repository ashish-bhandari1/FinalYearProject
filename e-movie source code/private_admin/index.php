<!DOCTYPE html>
<html>
   <head>
      <title>Private</title>
      <!-- !-- local links --> 
      <link rel = "stylesheet" type="text/css" href="css/style.css">
      <?php include_once("common/link.php"); ?>
   </head>
   <body>
      <div class = "form_wrapper">
         <form method="post" action="functions/obj.php">
            <h1 class = "formHeading">Admin login form </h1>
            <?php 
               if(isset($_GET['msg'])){
                echo $_GET['msg'];
                }
               
                 ?> 
            <div><input type = "text" name = "username" id = "username"placeholder = "Enter Username" required = "required">
            </div>
            <div>
               <input type = "password" name = "password" id  = "password" placeholder = "Enter password" required = "required">
            </div>
            <div style="display:inline-flex">
               <label>Login as:</label>
               <Select name = "role"  required = "required">
                  <option value="admin">Admin</option>
                  <option value="superadmin">Super Admin</option>
               </select>
            </div>
            <button type = "submit" name="adminLogin" >Login</button>
            <div class = "links">
               <a href = "#"> froget password!</a>
               <a href = "javascript:display();" id="open"  ><span id="blink">?</span>help</a>
            </div>
         </form>
      </div>
      <div class="help_Wrapper" id = "helpBox" >
         <div class="help">
            <span aria-hidden="true" id = "close">&times;</span>
            <a href = "#"> Forget password, want to reset password?</a>
            <a href = "#"> Doesn't know how to login?</a>
            <a href = "#"> Password is correct but still have problem on login?</a>
            <a href = "#"> Report problem!</a>
         </div>
      </div>
   </body>
   <script src="js/script.js"></script>
</html>