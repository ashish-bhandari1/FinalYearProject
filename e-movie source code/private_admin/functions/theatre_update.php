<?php
            $mysqli = new mysqli("localhost","root","","movie_project");
            if(mysqli_connect_errno()){

                die("Error 01: cannot connect to Database <a href='#'>Report this error</a>". mysqli_connect_error());      
            }

            $id = $_GET['ID'];
            $sql = "SELECT * FROM theatre WHERE id = '$id'";
            $result = $mysqli-> query($sql);
            $row = mysqli_fetch_assoc($result);
        ?>

    <!DOCTYPE html>
    <html>

    <head>
        <?php include_once("../common/link.php"); ?>
        <link rel="stylesheet" type="text/css" href="../css/body.css">

    </head>

    <body>
        <!-- top nav end -->

        <!-- THEATRE UPDATE FORM  _________________ START -->
      
        <div class="editForm" id="formWrap">

            <div class="formWrapper grid ediTformWrapper">
                <h3><a href="../theatre.php" style="text-decoration:none" onclick="return confirm('Are you exit current form?');" ><span class="close" id="closeform" >&times;</span></a></h3>
                <h1> Update theatre detail</h1>
                <i style="color:red; margin-top:15px">*Please update data carefully*</i>

                <form method="POST" action="../functions/obj.php">
                <div class="inputWrapper">
                <div class="input" style = "display:none">
                            <label>ID</label>
                            <input type="text" name="thid" id="theatrename" required="required" value="<?php echo $row['id']?>">
                        </div>
                    </div> 
                    <div class="inputWrapper">
                        <div class="input">
                            <label>Theatre name</label>
                            <input type="text" name="name" id="theatrename" required="required" value="<?php echo $row['name']?>">
                        </div>
                    </div>

                    <div class="inputWrapper">
                        <div class="input">
                            <label>Contact number</label>
                            <input type="number" name="number" required="required" value = "<?php echo $row['phone']?>">
                        </div>
                    </div>

                    <div class="inputWrapper">
                        <div class="input">
                            <label>Theatre email </label>
                            <input type="email" name="email" required="required" value = "<?php echo $row['email']?>" >
                        </div>
                    </div>

                    <div class="inputWrapper">
                        <div class="input">
                            <label> City </label>
                            <input type="text" name="city" required="required" value = "<?php echo $row['city']?>"  >
                        </div>
                    </div>

                    <div class="inputWrapper">
                        <div class="input">
                            <label> Country </label>
                            <input type="text" name="country" required="required" value = "<?php echo $row['country']?>">
                        </div>
                    </div>

                    <div class="inputWrapper">
                        <div class="input">
                            <label> Postal Code </label>
                            <input type="text" name="postal" required="required" value = "<?php echo $row['postal_code']?>" >
                        </div>
                    </div>

                    <div class="button d-flex justify-content-end">
                    <a href="../theatre.php"onclick="return confirm('Are you exit current form?');" >Back</a>
                    <button type="submit" name="theatreEdit" >Update</button>
                    </div>
                </form>
            </div>

        </div>

        <!-- THEATRE UPDATE FORM  _________________ END -->

        <!-- <div class="row"> -->
     
            <script src="js/admin.js"></script>  
            <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>

    </html>