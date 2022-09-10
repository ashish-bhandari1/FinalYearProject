<!DOCTYPE html>
<html>
   <title>Registration</title>
   <head>
      <!-- local links -->
      <link href="../fontawesome/css/all.css" rel="stylesheet">
      <!--load all styles -->
      <link rel = "stylesheet" type ="text/css" href="../css/register.css">
   </head>
   <body>
      <h1 class = "top-heading">customer registration form</h1>
      <div class = "form-wrapper">
         <form method = "post" action= "../function/obj.php">
            <h1>account information</h1>
            <?php if (isset($_GET['msg'])){
               echo $_GET['msg'];
               }    
               ?>
            <div class = "row">
               <div class = "input">
                  <i class="fas fa-user"></i><input name = "Fname" id = "firstName" required = "required" type = "text" placeholder = "First Name">
               </div>
               <div class = "input">
                  <i class="fas fa-user"></i><input name = "Lname" id = "lastName" required = "required" type = "text" placeholder = "Last Name">
               </div>
            </div>
            <div class = "row">
               <div class = "input">
                  <i class="fas fa-phone-alt"></i><input name = "phone" id = "phoneid" onkeyup = "phone_valid()" type = "number" placeholder = "Phone">
               </div>
               <div class = "input">
                  <i class="fas fa-envelope"></i> <input name = "email" id = "Email" required = "required" type = "email" placeholder = "Email (as username)">
               </div>
               
               <label style = "color:red" id = "phoneError"> </label>
            </div>
            <div class = "row">
               <div class = "input">
                  <i class="fas fa-globe"></i><?php include_once("../common/countryList.php") ?>
               </div>
               <div class = "input">
                  <i class="fas fa-map-marked-alt"></i><input name = "provenience" id = "Provenience" required = "required" type = "text" placeholder = "Provenience">
               </div>
            </div>
            <div class = "row">
               <div class = "input">
                  <i class="fas fa-city"></i></i><input name = "city" id = "City" required = "required" type = "text" placeholder = "City">
               </div>
               <div class = "input">
                  <i class="fas fa-map-marker-alt"></i><input name = "zipCode" id = "zip"  type = "text" placeholder = "Zip Code">
               </div>
            </div>
            <div class = "row">
               <div class = "input">
                  <p style = "color:red; font-size:10px">* Citizen form Nepal are not required to enter passport no.</P>
                  <i class="fas fa-passport"></i><input name = "passport" id = "Passport" type = "text" placeholder = "Passport Number">
               </div>
               <div class = "input" style = " border-bottom:none">
                  <i class="fas fa-venus-mars"></i>                     <input type="radio" name="gender" id="male" value="male" checked>
                  <label for="male">Male</label>
                  <input type="radio" name="gender" id="female" value="female">
                  <label for="female">Female</label>
                  <input type="radio" name="gender" id="other" value="other">
                  <label for="female">Other</label>
               </div>
            </div>
            <div class = "row">
               <div class = "input">
                  <i class="fas fa-unlock-alt"></i><input name = "password" id = "pw" onkeyup = "password_valid()" required = "required" type = "password" placeholder = "Password">
               </div>
               <div class = "input">
                  <i class="fas fa-lock"></i> <input name = "Cpassword" id = "Cpw" onkeyup = "password_valid()"  required = "required" type = "password" placeholder = "Confirm Password">
               </div>
            </div>
            
            <div >
            <label style = "color:red" id = "error"> </label>
            </div>
            <button type = "submit" id = "passwordBtn" class = "login" name="registerBtn" >Next  <i class="fas fa-forward"></i></button>    
            <div class = "forget_pw">
                <a href = "login.php" > Already have an account?</a>           
            </div>
            <div class = "api">
               <a href = "#"><i class="fab fa-facebook-square" style = "font-size:18px;padding:5px 5px;"></i>Login with facebook</a>
               <a href = "#"><i class="fab fa-google-plus-g"style = "font-size:18px;padding:5px 5px;"></i>Login with google</a>
            </div>
         </form>
      </div>
   </body>
   <script src="../js/script.js"></script>
   <script>
      var error = document.getElementById('ermsg');
      function errorfunction(){
          error.style.display = "none";    
      }

      function phone_valid(){
         var phone, btn, msg;
         phone = document.getElementById('phoneid');
         btn = document.getElementById('passwordBtn');
         msg = document.getElementById('phoneError');
         
         if((phone.value).length < 10 ){
            msg.innerHTML = "<br> * Number not valid";
            btn.disabled = true;
            btn.style.cursor = 'not-allowed';  
            phone.style.backgroundColor = '#cea4a4';
            btn.style.backgroundColor = 'rgba(255, 0, 0, 0.432)';
                }
                
        else{
            msg.innerHTML = "";
            btn.disabled = false;
            btn.style.cursor = 'pointer';
            phone.style.backgroundColor = 'rgba(255, 255, 255, 0.075)'; 
            btn.style.backgroundColor = 'rgba(1, 177, 30)'; 
        }
      }

    function password_valid(){
        var  pw, repw, btn,length;
        pw = document.getElementById('pw').value;
        repw = document.getElementById('Cpw').value;
        btn = document.getElementById('passwordBtn');
        msg = document.getElementById('error');
        
        if(pw.length > 5){
            if(pw != repw){
                  msg.innerHTML = "<br> * Password does not match";
                  btn.disabled = true;
                  btn.style.cursor = 'not-allowed';  
                  btn.style.backgroundColor = 'rgba(255, 0, 0, 0.432)';
                     }
            else{
                  msg.innerHTML = "";
                  btn.disabled = false;
                  btn.style.cursor = 'pointer';
                  btn.style.backgroundColor = 'rgba(1, 177, 30)'; 
            }
         }
         else{
                  msg.innerHTML = "<br> * Too weak password, enter at least 6 character";
                  btn.disabled = true;
                  btn.style.cursor = 'not-allowed';  
                  btn.style.backgroundColor = 'rgba(255, 0, 0, 0.432)';
         }

    }
    
    
   </script>
</html>