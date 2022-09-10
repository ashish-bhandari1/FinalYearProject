<!DOCTYPE html>
<html>
   <title>Login</title>
   <head>
      <link href="../fontawesome/css/all.css" rel="stylesheet">
      <!--load all styles -->
      <!-- local links -->
      <link rel = "stylesheet" type ="text/css" href="../css/login.css">
   </head>
   <body>
      <div class = "form-wrapper">
         <div class = "header"><img src = "../images/hall.jpg" alt ="header"></div>
         <form method = "post" action= "../function/obj.php">
            <h1 class = "home"> <a href="../"><i class="fas fa-chevron-circle-left"></i>Back Home</a></h1>
            <h1 class = "heading">Account Setting </h1>
            <div class = "input">
               <input  name = "pw" id = "password" required = "required" type = "password" placeholder = "Enter Current Password">
               <input onkeyup = "password_valid()" name = "pw1" id = "password1" required = "required" type = "password" placeholder = "Enter New Password">
               <input onkeyup = "password_valid()" name = "pw2" id = "password2" required = "required" type = "password" placeholder = "Confirm Password">
               <?php if (isset($_GET['msg'])){
                  echo $_GET['msg'];
                  }    
                  ?>           
               <div >
                  <label style = "color:red; display:none" id = "error"> </label>
               </div>
               <button type = "submit" name = "changePw" class = "login" id = "passwordBtn" >Change </button>
               <a href = "#" style = "margin-top:-4vh; font-size: 13px" >Forget password?</a>
            </div>
         </form>
      </div>
      <script src="../js/script.js"></script>
      <script>
         var error = document.getElementById('ermsg');
         
         function errorfunction(){
             error.style.display = "none";    
         }
         
              
         function password_valid(){
         var  pw, repw, btn;
         pw = document.getElementById('password1').value;
         repw = document.getElementById('password2').value;
         btn = document.getElementById('passwordBtn');
         msg = document.getElementById('error');
         
         if(pw != repw){
             msg.innerHTML = "<br>* Password does not match";
             btn.disabled = true;
             btn.style.cursor = 'not-allowed';  
             msg.style.display = "block";
             btn.style.backgroundColor = 'rgba(255, 0, 0, 0.432)';
                 }
         else{
             msg.innerHTML = "";
             btn.disabled = false;
             btn.style.cursor = 'pointer';
             msg.style.display = "none";
             btn.style.backgroundColor = 'rgb(56, 192, 202)'; 
         }
         
         }
         
      </script>
   </body>
</html>