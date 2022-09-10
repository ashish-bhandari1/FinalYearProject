<?php
class user
{
    function __construct($username, $role, $password)
    {
      
        //role whise query
        if($role == "admin"){
            $mysqli =new  mysqli("localhost", "root", "", "movie_project");
            if (mysqli_connect_errno()) {
                die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
            }
    
            $qry    = $mysqli->query("SELECT * from admin WHERE username = '$username' AND password = '$password'");
            if (!$qry) {
                die("Error 02: can't 
                execute query! <br>your table in database might be deleted ! <br>Please 
                <a target='_blank' href='https://mail.google.com/mail/u/0/#inbox?compose=jrjtXGjZgvLDvLnknWmHqFBGBJPXSpnfQWpxqXHxVKhcKHNBhfswqDqHsPjwmgqMrKqsfhxK' >
                contact your service provider</a>");
            }
            $verify = mysqli_num_rows($qry);
            if($verify == 1){
                $row = mysqli_fetch_assoc($qry);
                session_start();
                $_SESSION['admin_id'] = $row['id'];
                $_SESSION['admin_user'] = $row['username'];
                $_SESSION['admin_tid'] = $row['theatre_id'];
                
                header("Location: ../body.php");
            }
            else {
                header("Location: ../?msg=<i class='errorMsg' id = 'ermsg'> username and password doesnot match <span  id = 'errorClose'  onclick='errorfunction()'> close</span> </i>");
                /* Redirect browser */
            }

        }
        else{
            $mysqli =new  mysqli("localhost", "root", "", "movie_project_admin");
            if (mysqli_connect_errno()) {
                die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
            }
    
            $qry    = $mysqli->query("SELECT * from super_admin WHERE username = '$username' AND password = '$password'");
            if (!$qry) {
                die("Error 02: can't 
                execute query! <br>your table in database might be deleted ! <br>Please 
                <a target='_blank' href='https://mail.google.com/mail/u/0/#inbox?compose=jrjtXGjZgvLDvLnknWmHqFBGBJPXSpnfQWpxqXHxVKhcKHNBhfswqDqHsPjwmgqMrKqsfhxK' >
                contact your service provider</a>");
            }
            $verify = mysqli_num_rows($qry);
            if($verify == 1){
                $row = mysqli_fetch_assoc($qry);
                session_start();
                $_SESSION['admin_id'] = $row['id'];
                $_SESSION['super_user'] = $row['username'];
                header("Location: ../body.php");
            }
            else {
                header("Location: ../?msg=<i class='errorMsg' id = 'ermsg'> username and password doesnot match <span  id = 'errorClose'> close</span> </i>");
                /* Redirect browser */
            }

        }
  
      }
    
}


//THEATRE FUNCTION.......... 

class theatre
{

    function add_admin($username, $theatre, $password){
        $mysqli = new mysqli("localhost", "root", "", "movie_project");
        if (mysqli_connect_errno()) {
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
        }
        $sql    = "INSERT INTO admin VALUES('', '$theatre', '$username','$password')";
        $insert = $mysqli->query($sql);
        if ($insert) {
         
             header("Location: ../addAdmin.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully Added <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            /* Redirect browser */
            mysqli_close($mysqli);

        } else {
           // header("location:../theatre.php?msg='Can not insert data'");
            // echo("Error description: " . $mysqli -> error);
            header("Location: ../addAdmin.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while uploading data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            /* Redirect browser */
            mysqli_close($mysqli);
        } 
    }


    function change_pw($pw, $newpw, $role){
        if($role == 'admin'){
            $mysqli = new mysqli("localhost", "root", "", "movie_project");
            if (mysqli_connect_errno()) {
                die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
            }
            session_start();
            $id = $_SESSION['admin_id'];
            $valid = $mysqli->query("SELECT * from admin where id = '$id' and password = '$pw'");
            if( mysqli_num_rows($valid) == 1 ){
                 $sql    = "UPDATE  admin SET  password ='$newpw' WHERE id = '$id' ";
                $update = $mysqli->query($sql);
                if (!$update) {
                    header("Location: ../password.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while updating Password <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                } if($update) {
                    header("Location: ../password.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully Changed!  <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                }
                mysqli_close($mysqli);
            }
            else{
                header("Location: ../password.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Incorrect current password <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
        }
        if($role == 'superadmin'){
            $mysqli = new mysqli("localhost", "root", "", "movie_project_admin");
            if (mysqli_connect_errno()) {
                die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
            }
            session_start();
            $id = $_SESSION['admin_id'];
            $valid = $mysqli->query("SELECT * from super_admin where id = '$id' and password = '$pw'");
            if( mysqli_num_rows($valid) == 1 ){
                 $sql    = "UPDATE  super_admin SET  password ='$newpw' WHERE id = '$id' ";
                $update = $mysqli->query($sql);
                if (!$update) {
                    header("Location: ../password.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while updating Password <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                } if($update) {
                    header("Location: ../password.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully Changed <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                }
                mysqli_close($mysqli);
            }
            else{
                header("Location: ../password.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Incorrect current password <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
        }
    }


    function updatetheatre($id, $Name, $Number, $Email, $city, $country, $postal)
    {
        $mysqli = new mysqli("localhost", "root", "", "movie_project");
        if (mysqli_connect_errno()) {
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
        }
        $sql    = "UPDATE  theatre SET  name ='$Name',email='$Email', phone= '$Number',country= '$country',city= '$city', postal_code='$postal' WHERE id = '$id'";
        $insert = $mysqli->query($sql);
        if ($insert) {
         
             header("Location: ../theatre.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully updated <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            /* Redirect browser */
            mysqli_close($mysqli);

        } else {
           // header("location:../theatre.php?msg='Can not insert data'");
            // echo("Error description: " . $mysqli -> error);
            header("Location: ../theatre.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while uploading data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            /* Redirect browser */
            mysqli_close($mysqli);
        }
    }


    function addTheatre($id, $image, $name, $number, $email, $city, $country, $postal)
    {
        $mysqli = new mysqli("localhost","root","","movie_project");
        if(mysqli_connect_errno()){
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>".mysqli_connect_error());
        }
        // image file directory
        $target = "../../dbimage/".basename($image);
        
        //get image height and width
        
        $image_info = getimagesize($_FILES["image"]["tmp_name"]);
        $image_width = $image_info[0];
        $image_height = $image_info[1];
        $allowed_image_extension = array(
            "png",
            "PNG",
            "jpg",
            "JPG",
            "jpeg",
            "JPEG"
        );
 // Get image file extension
        $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    
       
        //validate extension
        if (! in_array($file_extension, $allowed_image_extension)) {
            header("Location: ../theatre.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:red'> Error: Upload valid images. Only PNG and JPEG are allowed. <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
        //validate size
        else if($_FILES["image"]["size"] > 2000000){
            header("Location: ../theatre.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:red'> Error: Image size exceeds 2MB <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
        //
       else if($image_height>2000 || $image_width>2000){
            header("Location: ../theatre.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:red'> Error: Image dimension should be within 1000X1000 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            die();
        }
        
        else{   
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $target)){             
                $qry = "INSERT INTO theatre VALUES ('',  '$name', '$image', '$email', '$number', '$country', '$city', '$postal' )";
                $result = $mysqli->query($qry);
                if(!$result){
                    echo("Data insertion error, : ".$mysqli -> error);
                    header("Location: ../theatre.php?msg =  <i class='errorMsg' id = 'ermsg' style='color:red'> Error while movie uploading<span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                }
                header("Location: ../theatre.php?msg= <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully Uplaoded <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
            else{
                header("Location: ../theatre.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:red'> Error: Failed to save image in Images folder <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
    }   
}


    function deleteTheatre($id)
    {
        $mysqli = new mysqli("localhost", "root", "", "movie_project");
        if (mysqli_connect_errno()) {
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
        }
        $sql    = "DELETE FROM  theatre WHERE  id ='$id' ";
        $delete = $mysqli->query($sql);
        if ($delete) 
        {
                   header("Location: ../theatre.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully deleted <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        } 
        else {
            /* Redirect browser */
            header("Location: ../theatre.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while deleteing data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
        
    }
    function Clearmsg()
    {
        $mysqli = new mysqli("localhost", "root", "", "movie_project");
        if (mysqli_connect_errno()) {
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
        }
        $sql    = "TRUNCATE complains";
        $delete = $mysqli->query($sql);
        if ($delete) 
        {
                   header("Location: ../message.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully deleted <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        } 
        else {
            /* Redirect browser */
            header("Location: ../theatre.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while deleteing data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
        
    }
}






//SCREENIGN FUNCTION.......... 

class screening
{
    function add_screening($theatreid, $hallName, $type, $seats)
    {
        $mysqli = new mysqli("localhost", "root", "", "movie_project");
        if (mysqli_connect_errno()) {
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
        }
        $sql    = "INSERT INTO  screening VALUES (NULL,'$theatreid','$hallName','$type','$seats')";
      
        $insert = $mysqli->query($sql);

        if (!$insert)
        {
            echo ("Error description: " . $mysqli->error);
            // header("Location: ../screening.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while uploading data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>"); /* Redirect browser */
        } 
        else 
        {
            $last_id = $mysqli->insert_id;

            $seatSql  = "INSERT INTO  seat VALUES (NULL, '$last_id', $theatreid,  NULL, NULL,  NULL)";
      
            $seatInsert = $mysqli->query($seatSql);   
            if (!$seatInsert) 
            {
                header("Location: ../screening.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while uploading dummy seat data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>"); /* Redirect browser */
            }
            else 
            {
                header("Location: ../screening.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully Added <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                /* Redirect browser */
            }
           
        }
        mysqli_close($mysqli);

    }

    function editScreening($id, $theatreid, $hallName, $type, $seats)
    {
        $mysqli = new mysqli("localhost", "root", "", "movie_project");
        if (mysqli_connect_errno()) {
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
        }
        $sql    = "UPDATE  screening SET  theatre_id ='$theatreid', name= '$hallName', type='$type',seat_number= '$seats' WHERE id = '$id'";
        $update = $mysqli->query($sql);
        if (!$update) {
            // echo("Error description: " . $mysqli -> error);
            header("Location: ../screening.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while updating data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            /* Redirect browser */
        } if($update) {
            header("Location: ../screening.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully updated <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            /* Redirect browser */
        }
        mysqli_close($mysqli);

    }


    function deleteHall($id)
    {
        $mysqli = new mysqli("localhost", "root", "", "movie_project");
        if (mysqli_connect_errno()) {
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
        }
        $sql    = "DELETE FROM  screening WHERE  id ='$id' ";
        $delete = $mysqli->query($sql);
        if ($delete) 
        {
            $seatSql    = "DELETE FROM  seat WHERE  screening_id ='$id' ";
            if($mysqli->query($seatSql) === true)
            {
                header("Location: ../screening.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully deleted <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
            else{
             header("Location: ../screening.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while deleteing seat data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
        } else {
            /* Redirect browser */
            header("Location: ../screening.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while deleteing data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
    }
  
}


//SEAT FUNCTION.......... 
class seat
{
    function editSeat($id, $hallid, $row, $column,$available){
        $mysqli = new mysqli("localhost", "root","", "movie_project");
        if (mysqli_connect_errno()) {
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
        }

        $qry = "UPDATE seat SET  seat_row = '$row', seat_column = '$column', seat_availability = '$available' WHERE id = '$id'";
        $result = $mysqli->query($qry);

        if (!$result) {
            echo("Error description: " . $mysqli -> error);
            // header("Location: ../seats.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while updating data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            /* Redirect browser */
        }
         else{  header("Location: ../seats.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully updated <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            /* Redirect browser */
         }mysqli_close($mysqli);
    }
}

//MOVIE FUNCTION.......... 
class movie{
    function addMovie($screening_id,   $name, $url, $director, $language, $genre, $hour, $showtime, $casts, $image, $desc, $active){
        $mysqli = new mysqli("localhost","root","","movie_project");
        if(mysqli_connect_errno()){
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>".mysqli_connect_error());
        }
        // image file directory
        $target = "../../dbimage/".basename($image);
        
        //get image height and width
        
        $image_info = getimagesize($_FILES["image"]["tmp_name"]);
        $image_width = $image_info[0];
        $image_height = $image_info[1];
        $allowed_image_extension = array(
            "png",
            "PNG",
            "jpg",
            "JPG",
            "jpeg",
            "JPEG"
        );
 // Get image file extension
        $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    
       
        //validate extension
        if (! in_array($file_extension, $allowed_image_extension)) {
            header("Location: ../movies.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:red'> Error: Upload valid images. Only PNG and JPEG are allowed. <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
        //validate size
        else if($_FILES["image"]["size"] > 2000000){
            header("Location: ../movies.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:red'> Error: Image size exceeds 2MB <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
        //
       else if($image_height>2000 || $image_width>2000){
            header("Location: ../movies.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:red'> Error: Image dimension should be within 1000X1000 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            die();
        }
        
        else{   
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $target)){  
                $movieQry = "SELECT theatre_id FROM screening WHERE id = '$screening_id'";
                $mresult = $mysqli->query($movieQry);
                $mrow = mysqli_fetch_assoc($mresult);

                $theatre_id = $mrow['theatre_id'];
                $qry = "INSERT INTO movie VALUES ('','$screening_id', '$theatre_id', '$name', '$url', '$director', '$language', '$genre', '$hour', '$showtime', '$casts', '$image', '$desc','$active' )";
                $result = $mysqli->query($qry);

                if(!$result){
                    echo("Data insertion error, : ".$mysqli -> error);
                    //header("Location: ../movies.php?msg =  <i class='errorMsg' id = 'ermsg' style='color:red'> Error while movie uploading<span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                }
                header("Location: ../movies.php?msg= <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully Uplaoded <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
            else{
                header("Location: ../movies.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:red'> Error: Failed to save image in Images folder <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
        }   
    }


    
    function editMovie($id, $screening_id, $name, $url, $director, $language, $genre, $hour, $time, $casts,  $desc, $active){
        $mysqli = new mysqli("localhost","root","","movie_project");
        if(mysqli_connect_errno()){
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>".mysqli_connect_error());
        }
        $movieQry = "SELECT theatre_id FROM screening WHERE id = '$screening_id'";
        $mresult = $mysqli->query($movieQry);
        $mrow = mysqli_fetch_assoc($mresult);
        $theatre_id = $mrow['theatre_id'];

                $qry = "UPDATE  movie SET screening_id = '$screening_id', theatre_id = '$theatre_id', name = '$name', link = '$url', director = '$director', language = '$language', genre = '$genre', movie_hour = '$hour', show_time = '$time', casts =  '$casts',  description = '$desc', status = '$active' WHERE id='$id'";
                $result = $mysqli->query($qry);

                if(!$result){
                    echo("Data insertion error, : ".$mysqli -> error);
                    header("Location: ../movies.php?msg =  <i class='errorMsg' id = 'ermsg' style='color:red'> Error while movie Updating<span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                }
               
            else{
                header("Location: ../movies.php?msg= <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully Updated <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
       
    }

    function truncateMovie(){
        $mysqli = new mysqli("localhost", "root", "", "movie_project");
        if (mysqli_connect_errno()) {
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
        }
        $sql  = "TRUNCATE TABLE movie";
        $delete = $mysqli->query($sql);
        if ($delete) 
        {
            header("Location: ../movies.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully truncated <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
        else{
            header("Location: ../movies.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while truncating movie data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
    }

    function deleteMovie($id)
    {
        $mysqli = new mysqli("localhost", "root", "", "movie_project");
        if (mysqli_connect_errno()) {
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
        }
       
        $sql    = "DELETE FROM  movie WHERE  id ='$id' ";
        $delete = $mysqli->query($sql);
        if ($delete) 
        {   
                header("Location: ../movies.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully deleted <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        } else {
            /* Redirect browser */
            header("Location: ../movies.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while deleteing data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
    }
  
}



//MENU FUNCTION ...........

class menu{
    function addMenu( $name, $link, $active){
        $mysqli = new mysqli("localhost", "root", "", "movie_project_admin");
        if(mysqli_connect_errno()){
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>".mysqli_connect_error());
        }
        $qry = "INSERT INTO menu VALUES ('','$name', '$link', '$active' )";
        $result = $mysqli->query($qry);

        if(!$result){
            echo("Data insertion error, : ".$mysqli -> error);
            header("Location: ../menu.php?msg =  <i class='errorMsg' id = 'ermsg' style='color:red'> Error while uploading<span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }

        else{
                header("Location: ../menu.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully added <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
    }   

    function editMenu($id, $name, $link, $active){
        $mysqli = new mysqli("localhost", "root", "", "movie_project_admin");
        if(mysqli_connect_errno()){
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>".mysqli_connect_error());
        }
        $qry = "UPDATE  menu SET  name = '$name', link = '$link', active = '$active' WHERE id='$id'";
        $result = $mysqli->query($qry);

        if($result){
            echo("Data insertion error, : ".$mysqli -> error);
            header("Location: ../menu.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully updated <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }

        else{
            header("Location: ../menu.php?msg =  <i class='errorMsg' id = 'ermsg' style='color:red'> Error while updating<span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
    }   


    function truncateMenu(){
        $mysqli = new mysqli("localhost", "root", "", "movie_project_admin");
        if (mysqli_connect_errno()) {
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
        }
        $sql  = "TRUNCATE TABLE menu";
        $delete = $mysqli->query($sql);
        if ($delete) 
        {
            header("Location: ../menu.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully truncated <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
        else{
            header("Location: ../menu.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Failed to truncate <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
    }

    function deleteMenu($id)
    {
        $mysqli = new mysqli("localhost", "root", "", "movie_project_admin");
        if (mysqli_connect_errno()) {
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
        }
       
        $sql    = "DELETE FROM  menu WHERE  id ='$id' ";
        $delete = $mysqli->query($sql);
        if ($delete) 
        {   
                header("Location: ../menu.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully deleted <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        } else {
            /* Redirect browser */
            header("Location: ../menu.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while deleteing data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
    }
  
}

//BANNER FUNCTION.......... 

class banner{

    function addBanner($image, $title,  $active){
        $mysqli = new mysqli("localhost","root", "" ,"movie_project_admin");
        if(mysqli_connect_errno()){
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>".mysqli_connect_error());
        }
        // image file directory
        $target = "../../appimage/".basename($image);
        
        //get image height and width
        $image_info = getimagesize($_FILES["image"]["tmp_name"]);
        $image_width = $image_info[0];
        $image_height = $image_info[1];
        $allowed_image_extension = array(
            "png",
            "PNG",
            "jpg",
            "JPG",
            "jpeg",
            "JPEG"
        );
 // Get image file extension
        $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        
        //validate extension
        if (! in_array($file_extension, $allowed_image_extension)) {
            header("Location: ../banner.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:red'> Error: Upload valid images. Only PNG and JPEG are allowed. <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
        //validate size
        else if($_FILES["image"]["size"] > 2000000){
            header("Location: ../banner.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:red'> Error: Image size exceeds 2MB <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
        //
       else if($image_height>1500 || $image_width>3000){
            header("Location: ../banner.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:red'> Error: Image dimension should be less then  2000X2000 <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            die();
        }
        
        else{   
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $target)){             
                $qry = "INSERT INTO banner VALUES ('', '$image', '$title','$active' )";
                $result = $mysqli->query($qry);

                if(!$result){
                    echo("Data insertion error, : ".$mysqli -> error);
                    //header("Location: ../movies.php?msg =  <i class='errorMsg' id = 'ermsg' style='color:red'> Error while movie uploading<span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
                }
                header("Location: ../banner.php?msg= <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully Uplaoded <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
            else{
                header("Location: ../banner.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:red'> Error: Failed to save image in Images folder <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
    }   
}

    function editBanner($id,  $title,  $active){
        $mysqli = new mysqli("localhost","root", "" ,"movie_project_admin");
        if(mysqli_connect_errno()){
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>".mysqli_connect_error());
        }         
        $qry = "UPDATE  banner SET  text = '$title', status = '$active' WHERE id='$id'";
        $result = $mysqli->query($qry);

        if($result){
            echo("Data insertion error, : ".$mysqli -> error);
            header("Location: ../banner.php?msg =  <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully updated <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
           }

           if(!$result){
            header("Location: ../banner.php?msg=  <i class='errorMsg' id = 'ermsg' style='color:red'> Error: Failed to Update <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
    }   

    function truncateBanner(){
        $mysqli = new mysqli("localhost","root", "" ,"movie_project_admin");
        if (mysqli_connect_errno()) {
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
        }
        $sql  = "TRUNCATE TABLE banner";
        $delete = $mysqli->query($sql);
        if ($delete) 
        {
            header("Location: ../banner.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully truncated <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
        else{
            header("Location: ../banner.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while truncating movie data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
            }
    }

    function deleteBanner($id)
    {
        $mysqli = new mysqli("localhost","root", "" ,"movie_project_admin");
        if (mysqli_connect_errno()) {
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
        }
       
        $sql    = "DELETE FROM  banner WHERE  id ='$id' ";
        $delete = $mysqli->query($sql);
        if ($delete) 
        {   
                header("Location: ../banner.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully deleted <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        } else {
            /* Redirect browser */
            header("Location: ../banner.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while deleteing data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
    }
  
}




//BOOKING FUNCTION.......... 
class booking{
    function book($value_list){
   
   $mysqli = mysqli_connect("localhost","root","","movie_project");
   
   $values = explode(',', $value_list);
   foreach ($values as $value)
   {
       $sql = "INSERT INTO seat_booking  VALUES ('', '1', '4', '$value')";
       //.. execute SQL now
       $execute =  $mysqli->query($sql);
       if($execute){
           header("Location: ../seats.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> success <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
       }
    
    }
    }

    function clearBooking($id, $time){
        $mysqli = new mysqli("localhost","root", "" ,"movie_project");
        if (mysqli_connect_errno()) {
            die("Error 01: cannot connect to Database <a href='#'>Report this error</a>" . mysqli_connect_error());
        }

        $showtime = str_replace(' ', '', $time);
       
        $sql    = "DELETE FROM  seat_booking WHERE  m_id ='$id' AND show_time = '$showtime' ";
        $delete = $mysqli->query($sql);
        if ($delete) 
        {   
                header("Location: ../booking.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:green'> Successfully Cleared <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        } else {
            /* Redirect browser */
            header("Location: ../booking.php?msg=   <i class='errorMsg' id = 'ermsg' style='color:red'> Error while deleteing data <span  id = 'errorClose' onclick='errorfunction()'> close</span> </i>");
        }
    
    }
   }
?>