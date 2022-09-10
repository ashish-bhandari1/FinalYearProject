		 <!-- navigation start _____________ START-->

	<header class="nav-head">
	<nav class="fixed-top " id="fixed-top">
                <div class="TopNavLeft">
                    <a href="#" id="" name="">5% of every booking</a>
                    <a href="#" id="" name="">Get Reedem code now</a>
                </div>
                <div class="TopNavRight">
                    <a href="#" id="" class="startSelling"><i class="fas fa-store"></i>help</a>
					<a id="loginLink" name="" href="javascript:loginPopup()"><img src="images/account.svg"alt="user" class="user" id="user">
					Login/Sign up</a>
					<a href="#" class="playstore"><img src="images/logo.jpg"alt="playstore"></a>

                </div>
	</nav>
	</header>
	<div class="mainNav">

		<div class="logo" id="logo" ><img src="images/logo.png" alt="Logo"></div>
		<div class="navbar" id="nav">
				<ul class="nav-ul">
					<?php
					 $connAdmin = new mysqli("localhost", "root", "", "movie_project_admin");
					  $menu = $connAdmin->query("SELECT * FROM menu WHERE active = 'Active'");
					  if($menu->num_rows >0){
					  while($menuRow = mysqli_fetch_assoc($menu)){
						  echo'
						<li>
						<a href="'.$menuRow['link'].'"> '.$menuRow['name'].'</a>
						</li>	
						  ';
					  }
					}
					?>
<!-- 				
				
				<li>
					<a href="index.php #theatre-section"> Theatres</a>
				</li>			
				<li>
					<a href="promotion.php"> Promotions</a>
				</li>			
				<li>
					<a href="privacy.php"> Privacy Policy</a>
				</li>			
				<li>
					<a href="index.php #about-section"> About</a>
				</li>		 -->
			</ul>
		</div>
		<!-- navigation  _____________ END-->

	 <!-- search button _____________ Start-->
		<form class = "search" method = "post" action = "register/loginObj.php">
			<input type = "text" name = "search" id = "Search">
			<button type = "submit"><i class="fas fa-search"></i></button>
		</form>
		 <!-- search button _____________ End-->
	    <div class="icon" id="burgerMenu">
			<div class="line1"></div>
			<div class="line2"></div>
			<div class="line3"></div>
		</div>
</div>
	 <!-- login form _____________ Start-->
	<div class = "loginForm" id = "login_form">
	<div class = "formWrapper" id = "form_wrapper">
	 
	 <!-- checking whether user is logged in or not -->
	 <?php 
	 if(!isset($_SESSION["email"]) && !isset($_SESSION["pw"])) { ?>

	<form method="post" action="function/obj.php" class = "login-form">
            <h1 class = "formHeading">Login</h1>
            <div><input type = "text" name = "username" id = "username"placeholder = "Enter Username (email)" required = "required">
            </div>
            <div><input type = "password" name = "password" id  = "password" placeholder = "Enter password" required = "required" >
			</div>			 
			<div class="links-wrapper">
			 <div class="links">
			 <a href = "register/register.php" class="register"> register now</a>
			 <a href = "#" class="forget_pw">forget password</a>
			</div>
			<div class="button">
             <button type = "submit" name="login">Login</button>
			</div>
			</div>
			<div class = "api">
            <a href = "#"><i class="fab fa-facebook-square" style = "font-size:18px;padding:3px 5px;"></i>Login with facebook</a>
            <a href = "#"><i class="fab fa-google-plus-g"style = "font-size:18px;padding:3px 5px;"></i>Login with google</a>
            </div>
		</form>
	 <?php } 
	 else{
	 ?>
	 	
	<form method="post" action="register/obj.php" class = "login-form">
	<h1 class = "settingHeading">Account Setting</h1>
			<div class = "settingBtn">
            <a href = "function/logout.php" onclick="return confirm('Are you sure you want to Logout?');"><i class="fas fa-sign-out-alt" style = "font-size:18px;padding:3px 5px;"></i>Logout</a>
            </div>
			<div class="settingBtn">
             <button type = "submit" name="logout"><i class="fas fa-cash-register" style = "font-size:18px;padding:3px 5px;"></i><a href = "register/password.php" style = "color:#fff; background-color: #329425;">Change Password </a> </button>
			</div>
		</form>
	 <?php } ?>
	</div>
	</div>
			 <!-- login form _____________ End-->
