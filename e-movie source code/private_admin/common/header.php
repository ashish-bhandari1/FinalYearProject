<div>
   <nav class="navbar fixed-top ">
      <a class="navbar-brand" title="Collapse" href="javascript:dropdown()"> <i class="fas fa-bars" id="menu"></i> Dashboard</a>
      <nav class="navWrapper">
         <div class="splash" style="position:absolute; color:#fff;  top:2vh; float:right; right:2vh">
            <a class="" href="#!" id="date" style="color:#fff; margin-right:30px;text-decoration:none; "></a>
            <a href="#!" id="welcomeAdmin" style="color:#fff;text-decoration:none;"></a>
         </div>
      </nav>
   </nav>
</div>
<div class="row">
<div class="col-md-2" id="dropdownMenu" style="max-height:130vh">
   <!-- Content -->
   <h1 class="navh1">databse management</h1>
   <ul>
      <li><a href="body.php"> <i class="fas fa-chart-line"></i> Activety</a></li>
      <li><a href="theatre.php"><i class="fas fa-home"></i>Theatre</a></li>
      <li><a href="screening.php"><i class="fas fa-person-booth"></i>Screening </a></li>
      <li><a href="seats.php"><i class="fas fa-chair"></i>seats </a></li>
      <li><a href="movies.php"><i  class="fas fa-film"></i>now showing movie </a></li>
      <li><a href="users.php"><i class="fas fa-users"></i>registered users</a></li>
      <li><a href="booking.php"><i class="fas fa-money-check-alt"></i>Bookings</a></li>
   </ul>
   <h1>site management</h1>
   <ul>
      <li><a href="menu.php"><i class="fas fa-columns"></i>Top menu </a></li>
      <li><a href="#"><i class="fas fa-bars"></i>lower menu </a></li>
      <li><a href="banner.php"><i class="fas fa-images"></i> banner </a></li>
      <li><a href="../index.php"><i class="fas fa-eye"></i>View Changes </a></li>
   </ul>
   <h1>Setting</h1>
   <ul>
      <li><a href="addAdmin.php"> <i class="fas fa-user-plus"></i> </i>Add Admin </a></li>
      <li><a href="message.php"> <i class="fas fa-inbox"></i> </i>Message </a></li>
      <li><a href="password.php"><i class="fas fa-cash-register"></i>Change Password</a></li>
      <li><a href="functions/logout.php" onclick= "return confirm('Are you sure wanna logout?');"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
   </ul>
</div>
<!-- <div class="col-md-10">
   </div>
   </div> -->