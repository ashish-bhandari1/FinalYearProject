<?php
class user
 {
    function __construct($username, $password)
    {
        $mysqli = new mysqli("localhost","root","","movie_project");
        if(mysqli_connect_errno()){
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>  <br>
            <a href = '../'>Go back to home page! </a>". mysqli_connect_error());
        }
        $Userqry = "SELECT email FROM customer WHERE email = '$username'";//username validating query
        $Passwordqry = "SELECT * FROM customer WHERE email = '$username' AND password = '$password' ";

        $UserResult = $mysqli->query($Userqry);
        $PwResult = $mysqli->query($Passwordqry);
        $pwRow = mysqli_fetch_assoc($PwResult);
        if(!$UserResult && !$PwResult){//if accessing data from table dined
            die("<br>Error 02: cannot connect to table <a href='#'>Report this error</a>");
        }

        // $userRow = mysqli_fetch_assoc($UserResult);

        $userCount = mysqli_num_rows($UserResult);
            
        if($userCount == 0){//validaing username first    
            header("Location:  ../register/login.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error: username Does not exist!<br> Make sure you  REGISTERED <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            die();
        }

        else{
            if( mysqli_num_rows($PwResult) == 1 )//until data from data base granted
                {
                        session_start();
                        $_SESSION["email"] = $username;
                        $_SESSION["pw"] = $password;
                        $_SESSION["user_id"] = $pwRow['id'];
                        
                            echo '<script>
                            alert("You are successfully logined");
                            window.location = "../";
                            </script>';
                 }
            else{header("Location: ../register/login.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error: username and password does not match <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                }
            mysqli_close($mysqli);
        }
    }

}


class register{
    
    public function setPhone($phone){
        $this->phone = $phone;
    }
    public function getPhone(){
        return $this->phone;
    }  
    public function setUsername($email){
        $this->email = $email;
    }
    public function getUsername(){
        return $this->email;
    }

    public function setPassword($password){
        $this->password = $password;
        $trimpassword = str_replace(' ', '', $this->password);
    }
    public function getPassword(){
        return $this->password;
    }

    public function registerUser($Fname, $Lname, $country, $provenience, $city, $zipCode,$gender,$passport)
    {
        $conn = mysqli_connect("localhost","root","","movie_project");
        if(mysqli_connect_errno()){
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>". mysqli_connect_error());
        }
        $email  = $conn->query("SELECT email FROM customer WHERE email = '$this->email'");//username validating query
        if(mysqli_num_rows($email)  < 1){
            $qry = "INSERT INTO customer VALUES 
                (NULL,'$Fname', '$Lname', '$this->phone','$this->email', '$country', '$provenience', '$city', '$zipCode', '$passport','$gender','$this->password')";

            $result = $conn->query($qry);
            if($result){//validaing username first    
                echo '
                <script>
                alert("successfully  REGISTERED");
                window.location = "../"
                </script>
                    ';
            }
            else{
                header("Location:  ../register/register.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Sorry error occured while inserting data! <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
        }
        else{
            header("Location:  ../register/register.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Email already exist! <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
    }

}

class password{
    function __construct($pw, $pw1){
            $mysqli = new mysqli("localhost", "root", "", "movie_project");
            if (mysqli_connect_errno()) {
                die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
            }
            session_start();
            $id = $_SESSION['user_id'];

            $valid = $mysqli->query("SELECT * from customer where id = '$id' and password = '$pw'");
            if( mysqli_num_rows($valid) == 1 ){
                $sql    = "UPDATE  customer SET  password ='$pw1' WHERE id = '$id' ";
                $update = $mysqli->query($sql);
                if (!$update) {
                    header("Location: ../register/password.php?msg=  <br> <i class='errorMsg' id = 'ermsg' style='color:red'> Error while updating Password <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                } if($update) {
                    header("Location: ../register/password.php?msg=  <br> <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully Changed <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                }
                mysqli_close($mysqli);
            }
            else{
                header("Location: ../register/password.php?msg=   <br><i class='errorMsg' id = 'ermsg' style='color:red'> Incorrect current password <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
        }

}



class movie{
    function rating($id, $star, $desc){
            $mysqli = new mysqli("localhost", "root", "", "movie_project");
            if (mysqli_connect_errno()) {
                die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
            }
      
                $sql    = "INSERT INTO rating VALUES('','$id', '$star', '$desc')";
                $result = $mysqli->query($sql);
                if (!$result) {
                    echo '
                    <script>
                    alert("Error: Sorry! Failed to post your review");
                    window.location = "../movies.php?id= '.$id .'";
                    </script>
                    ';

                } if($result) {
                    echo '
                    <script>
                    alert("Success: Your review has been posted!");
                    </script>
                    ';
                    header("Location: ../movies.php?id= $id & style= display:none");
                }
                mysqli_close($mysqli);

        }

}

//BOOKING FUNCTION.......... 

class booking{
    function book($value_list, $movie, $screen, $date, $time, $totalseat){
   
   $mysqli = new mysqli("localhost","root","","movie_project");
   session_start();
   $customer = $_SESSION["user_id"];
   $bookData = $mysqli->query("INSERT INTO booking  VALUES ('', '$customer', '$movie', '$screen', '$date', '$totalseat', 'Paid')");
   if($bookData){
        $values = explode(',', $value_list);
        foreach ($values as $value)
        {
            $sql = "INSERT INTO seat_booking  VALUES ('', '$customer', '$movie', '$time', '$value')";
            //.. execute SQL now
            $execute =  $mysqli->query($sql);
            if($execute){
                $token = $customer.'-'.$movie.'-'.$screen.'-'.$date;
                header("Location: ../movies.php?id= $movie & token= $token");

                // echo '
                // <script>
                // alert("Success: Ticked Booked");
                // window.location = "../movies.php?id='.$movie.'";
                // </script>
                // ';
            }
            
        }
        }
    }
   }

 
   


//OTHER FUNCTION.......... 

class other{
    function comment($email, $phone, $comment){
   
   $mysqli = new mysqli("localhost","root","","movie_project");
   session_start();
   
   $qry = $mysqli->query("INSERT INTO complains  VALUES ('', '$phone', '$email', '$comment' )");
   if($qry){
    header("Location: ../forum.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:green'> Your Comment has been submitted to system  </i>");   
   }        
else{
    header("Location: ../forum.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:red'> FAiled to post your comment, Please try agin later.  </i>");   
   }        
        
    }
   }
?>