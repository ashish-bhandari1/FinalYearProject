<!DOCTYPE html>
<html>
    <title>Login</title>
<head>
<link href="../fontawesome/css/all.css" rel="stylesheet"> <!--load all styles -->

    <!-- local links -->

    <link rel = "stylesheet" type ="text/css" href="../css/login.css">
</head>
<body>

    <div class = "form-wrapper">
        <div class = "header"><img src = "../images/hall.jpg" alt ="header"></div>
        <form method = "post" action= "../function/obj.php">

            <h1 class = "home"> <a href="../"><i class="fas fa-chevron-circle-left"></i>Back Home</a></h1>         
            <h1 class = "heading">sign in</h1>
            <div class = "input">
                <input name = "username" id = "username" required = "required" type = "text" placeholder = "Username">
                <input name = "password" id = "pw" required = "required" type = "password" placeholder = "Password">
                    <?php if (isset($_GET['msg'])){
                echo $_GET['msg'];
                }    
                ?>
                <button type = "submit" class = "login" name="login">Login </button>
                <a href = "#" style = "margin-top:-4vh; font-size: 13px" >Forget password?</a>
                <a href = "register.php" style = "color: rgb(0, 151, 161);">Register now</a>
            </div>
            <h2>________   OR ________</h2>
            <div class = "api">
            <a href = "#"><i class="fab fa-facebook-square" style = "font-size:18px;padding:5px 5px;"></i>Login with facebook</a>
            <a href = "#"><i class="fab fa-google-plus-g"style = "font-size:18px;padding:5px 5px;"></i>Login with google</a>
            </div>
        </form>
    </div>
    <script src="../js/script.js"></script>
    <script>
        var error = document.getElementById('ermsg');

        function errorfunction(){
            error.style.display = "none";    
        }
    </script>
</body>

</html>