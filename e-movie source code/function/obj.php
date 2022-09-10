<?php
include 'function.php';
$mysqli = new mysqli("localhost","root","","movie_project");

if (isset($_POST['login'])) {
    if(mysqli_connect_errno()){
        die("Error 01: cannot connect to Database <a href='#'>Report this error</a>". mysqli_connect_error());
    }
    $username = $_POST["username"];//using mysqli realscape string to store important data more securely
    $pw =  md5($_POST["password"]);
  
    $obj = new user($username,$pw);//passing variable to constructor
}


if (isset($_POST['registerBtn'])) {
    if(!$mysqli){
        die("Error 01: cannot connect to Database <a href='#'>Report this error</a>". mysqli_connect_error());
    }
    //using mysqli realscape string to store important data more securely
    $password =  md5($_POST["password"]);
    $Cpassword =  md5($_POST["Cpassword"]);  
    $Fname =  $_POST["Fname"];
    $Lname =  $_POST["Lname"];
    $phone =  $_POST["phone"];
    $email =  ($_POST["email"]);
    $country = $_POST["country"];
    $provenience =  $_POST["provenience"];
    $city =  $_POST["city"];
    $zipCode =  $_POST["zipCode"];
    $gender =  ($_POST["gender"]);
    $passport =   ($_POST["passport"]);
    
    if($password == $Cpassword){
    $obj = new register();
    
    //calling functions
    $obj->setUsername($email);
    $obj->getUsername();
    
    $obj->setPassword($password);
    $obj->getPassword();
    
    $obj->setPhone($phone);
    $obj->getPhone();
    
    $obj->registerUser($Fname, $Lname, $country, $provenience, $city, $zipCode,$gender,$passport);
    }
    else{
        header("Location:  ../register/register.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error: Both Password Must Match <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
    }  
}

if(isset($_POST['changePw'])){
    $pw = md5($_POST['pw']);
    $pw1 = md5($_POST['pw1']);
    $pw2 = md5($_POST['pw2']);            

    if ($pw1 == $pw2) {
        $obj = new password($pw,$pw1);
    } 
    else {
        header("location:../register/password.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Both Password Must Match <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
    }
}

if(isset($_POST['rating'])){
    $movie = $_POST['movie'];
    $star = $_POST['star'];
    $desc = $_POST['desc'];            
    $obj = new movie();
    $obj->rating($movie,$star,$desc);

}

   
//BOOKING DATA MANAGE .......
//seat booking
if (isset($_POST['bookSeat'])) {
    $value_list = $_POST['seat_id'];
    $movie = $_POST['movieid'];
    $screen = $_POST['screenid'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $totalseat = $_POST['seat'];
    $obj = new booking();
    $obj->book($value_list, $movie, $screen, $date, $time, $totalseat);
}



//User Comment
if (isset($_POST['comment'])) {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $comment = $_POST['msg'];
    $obj = new other();
    $obj->comment($email, $phone, $comment);
}



?>