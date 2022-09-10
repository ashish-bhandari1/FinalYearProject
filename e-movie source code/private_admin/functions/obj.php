<?php
include 'function.php';
//ADMIN LOGIN
if (isset($_POST['adminLogin'])) {
    $username = $_POST["username"];
    $role = $_POST["role"];
    $pw       = md5($_POST["password"]);
    $obj      = new user($username, $role, $pw); //passing variable to constructor
    if (!$obj) {
        die("can not call function! system detect bug in program <br>Please <a href='#' >contact your service provider</a>");
    }
}

//ADMIN Register
if (isset($_POST['add_admin'])) {
    $username = $_POST["username"];
    $theatre = $_POST["id"];
    $pw       = md5($_POST["password"]);

    $obj      = new theatre();
    $obj->add_admin($username, $theatre, $pw); //passing variable to constructor
    if (!$obj) {
        die("can not call function! system detect bug in program <br>Please <a href='#' >contact your service provider</a>");
    }
}

//Admin Password Change
if(isset($_POST['changePw'])){
    $pw = md5($_POST['currentpw']);
    $npw = md5($_POST['newpw']);
    $rnpw = md5($_POST['repw']);
    session_start();
            
    if( isset($_SESSION['admin_user'])){
        $role = 'admin';
    }
    
    if(isset($_SESSION['super_user'])){                
        $role = 'superadmin';
    }

    if ($npw == $rnpw) {
        $obj       = new theatre();
        $obj->change_pw($pw, $npw, $role);
    } else {
        header("location:../password.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Both Password Must Match <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
    }
}


//THEATRE DATA MANAGE .......

$db = mysqli_connect("localhost", "root", "", "movie_project");
if (!$db) {
    die("<br>Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
}

// If theatre upload button is clicked ...
if (isset($_POST['theatreEdit'])) {
    $id = $_POST['thid'];
    $theatreName    = $_POST['name'];
    $theatreNumber  = $_POST['number'];
    $theatreEmail   = $_POST['email'];
    $theatreCity    = $_POST['city'];
    $theatreCountry = $_POST['country'];
    $theatreZip     = $_POST['postal'];
    $obj            = new theatre();
    $obj->updatetheatre($id, $theatreName, $theatreNumber, $theatreEmail, $theatreCity, $theatreCountry, $theatreZip);
}

if (isset($_POST['theatreAdd'])) {
    $id = $_POST['thid'];
    $image = $_FILES['image']['name'];
    $theatreName    = $_POST['name'];
    $theatreNumber  = $_POST['number'];
    $theatreEmail   = $_POST['email'];
    $theatreCity    = $_POST['city'];
    $theatreCountry = $_POST['country'];
    $theatreZip     = $_POST['postal'];
    $obj            = new theatre();
    $obj->addTheatre($id, $image ,$theatreName, $theatreNumber, $theatreEmail, $theatreCity, $theatreCountry, $theatreZip);
}

if (isset($_POST['deleteTheatre'])) {
    $id = $_POST['id'];
    $obj    = new theatre();
    $obj->deleteTheatre($id);
}



//SCREENING DATA MANAGE .......

// If add button is clicked ...
if (isset($_POST['screeningAdd'])) {
    $theatreId = $_POST['theatreName'];
    $hallName  = $_POST['hallName'];
    $type      = $_POST['type'];
    $seats     = $_POST['totalSeat'];
    $obj       = new screening();
    $obj->add_screening($theatreId, $hallName, $type, $seats);
}

// If Screening edit button is clicked ...
if (isset($_POST['screeningEdit'])) {
    $id = $_POST['id'];
    $theatreId = $_POST['theatreName'];
    $hallName  = $_POST['hallName'];
    $type      = $_POST['type'];
    $seats     = $_POST['totalSeat'];
    if ($seats <= 500) {
        $obj       = new screening();
        $obj->editScreening($id, $theatreId, $hallName, $type, $seats);
    } else {
        header("location:../screening.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> seat number more than 500 in a hall is unusual! please contact your system provider <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
    }
}
// If Screening delete button is clicked ...
if (isset($_POST['deleteHall'])) {
    $obj       = new screening();
    $obj->deleteHall($_POST['id']);
}




//SEAT DATA MANAGE .......

// If Seat edit button is clicked ...
if (isset($_POST['seatEdit'])) {
    $id = $_POST['seat_id'];
    $hallName  = $_POST['hallName'];
    $row  = $_POST['row'];
    $column  = $_POST['column'];
    $available  = $_POST['available'];
    if (($row * $column) <= 500) {
        $obj = new seat();
        $obj->editSeat($id, $hallName, $row, $column, $available);
    } else {
        header("location:../seats.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> seat number more than 500 in a hall is unusual! please contact your system provider <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
    }
}


//MOVIE DATA MANAGE ....... 
if(isset($_POST['uploadMovie'])){

$screening_id = $_POST['hallname'];
$image = $_FILES['image']['name'];
$name = $_POST['name'];
$showtime = $_POST['time'];
$url = $_POST['url'];
$director = $_POST['director'];
$language = $_POST['language'];
$genre = $_POST['genre'];
$time = $_POST['hour'];
$casts = $_POST['casts'];
$desc = $_POST['desc'];
$active = $_POST['status'];

$obj = new movie();
$obj->addMovie($screening_id,  $name, $url, $director, $language, $genre, $time, $showtime, $casts, $image, $desc, $active);
}

//If movie edit button is clicked ...
if(isset($_POST['movieEdit'])){
    $id = $_POST['id'];
    $screening_id = $_POST['hallname'];
    $image = $_FILES['image']['name'];
    $name = $_POST['name'];
    $url = $_POST['url'];
    $director = $_POST['director'];
    $language = $_POST['language'];
    $genre = $_POST['genre'];
    $time = $_POST['hour'];
    $showtime = $_POST['time'];
    $casts = $_POST['casts'];
    $desc = $_POST['desc'];
    $active = $_POST['status'];
    $obj = new movie();
    $obj->editMovie($id, $screening_id,$name, $url, $director, $language, $genre, $time, $showtime, $casts, $desc, $active);
    }
    
// If truncate movie button is clicked ...
if (isset($_POST['truncateMovie'])) {
    $obj = new movie();
    $obj->truncateMovie();
}


// If movie delete button is clicked ...
if (isset($_POST['deleteMovie'])) {
    $obj = new movie();
    $obj->deleteMovie($_POST['id']);
}


//THEATRE DATA MANAGE .......
if(isset($_POST['uploadMenu'])){
    $name = $_POST['name'];
    $url = $_POST['link'];
    $active = $_POST['status'];  
    $obj = new menu();
    $obj->addMenu($name, $url, $active);
    }

if(isset($_POST['editMenu'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $url = $_POST['link'];
    $active = $_POST['status'];        
    $obj = new menu();
    $obj->editMenu( $id, $name, $url, $active);
    }
 
if(isset($_POST['truncateMenu'])){
    $obj = new menu();
    $obj->truncateMenu();
    }
    
if(isset($_POST['deleteMenu'])){
    $id = $_POST['id'];
    $obj = new menu();
    $obj->deleteMenu($id);
    }
    
   
//Banner DATA MANAGE ....... 
if(isset($_POST['uploadBanner'])){
    $image = $_FILES['image']['name'];
    $title = $_POST['title'];
    $active = $_POST['status'];   
    $obj = new banner();
    $obj->addBanner( $image, $title, $active);
    }
    
if(isset($_POST['bannerEdit'])){
    $id = $_POST['id'];
    $title = $_POST['text'];
    $active = $_POST['status'];        
    $obj = new banner();
    $obj->editBanner( $id,  $title, $active);
}
        
if (isset($_POST['truncateBanner'])) {
    $obj = new banner();
    $obj->truncateBanner();
   }
    
if (isset($_POST['deleteBanner'])) {
    
    $obj = new banner();
    $obj->deleteBanner($_POST['id']);
  }
    
    
//BOOKING DATA MANAGE .......
//seat booking
if (isset($_POST['bookSeat'])) {
    $id = $_POST['id'];
    $obj = new booking();
    $obj->book($id);
}


if (isset($_POST['bookingClear'])) {
    $id = $_POST['id'];
    $time = $_POST['time'];
    $obj = new booking();
    $obj->clearBooking($id, $time);
}

//ClEAR MESSAGE .......
if (isset($_POST['clearMessage'])) {
    $obj    = new theatre();
    $obj->Clearmsg();
}


?>