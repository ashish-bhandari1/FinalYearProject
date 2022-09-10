<?php
            include_once('../common/authorize.php');
            $mysqli = new mysqli("localhost","root","","movie_project");
            if(mysqli_connect_errno()){

                die("Error 01: cannot connect to Database <a href='#'>Report this error</a>". mysqli_connect_error());      
            }
            $id = $_GET['ID'];

            if( isset($_SESSION['admin_user'])){
                $theatre_id = $_SESSION['admin_tid'];
                $screening = "SELECT * FROM screening WHERE theatre_id = '$theatre_id'";
                $seat = "SELECT * FROM seat WHERE id ='$id' AND theatre_id = '$theatre_id'";          
            }
            if(isset($_SESSION['super_user'])){                
                $screening = "SELECT * FROM screening";
                $seat = "SELECT * FROM seat WHERE id ='$id'";

            }
           


            $scResult = $mysqli-> query($screening);

            $result = $mysqli-> query($seat);

            $row = mysqli_fetch_assoc($result);    

            // }

        ?>

    <!DOCTYPE html>
    <html>

    <head>
        <?php include_once("../common/link.php"); ?>
            <link rel="stylesheet" type="text/css" href="../css/body.css">

    </head>

    <body>
        <!-- top nav end -->

        <!-- SEAT EDIT FORM  _________________ START -->
        <div class="editForm" id="formWrap">

            <div class="formWrapper grid ediTformWrapper">
                <h3><a href="../seats.php" style="text-decoration:none" onclick="return confirm('Are you exit current form?');"><span class="close" id="closeform" onclick="closeFrom();" >&times;</span></a></h3>
                <h1> Update Seat Detail</h1>
                <br>
                <i style="color:red">*Please update detail carefully*</i>

                <form method="POST" action="obj.php">
                    <div class="inputWrapper">
                        <div class="input" style="display:none">
                            <label>ID</label>
                            <input type="text" name="seat_id" required="required" value="<?php echo $row['id']; ?>">
                        </div>
                    </div>
                    <div class="inputWrapper">
                        <div class="input">
                            <label>Hall Name</label>
                            <select name="hallName">
                                <?php
                            if($scResult->num_rows >0){
                                while($scRow = mysqli_fetch_assoc($scResult)){
                                echo " <option value='". $scRow['screening_id']."' >".$scRow['name']." </option> ";
                                }
                            }

                            ?>
                            </select>
                        </div>
                    </div>

                    <div class="inputWrapper">

                        <div class="input">
                            <label>Seat Row</label>
                            <input onkeyup="seat_updateError('seat_error')" type="number" name="row" id="row_num" value="<?php echo $row['seat_row'] ?>" required="required">
                        </div>
                    </div>
                    <div class="inputWrapper">
                        <div class="input">
                            <label>Seat Column </label>
                            <input onkeyup="seat_updateError('seat_error')" type="number" id="column_num" name="column" value="<?php echo $row['seat_column'] ?>" required="required">
                            <label id="seat_error" style="color:red; text-transform: none;">  </label>
                        </div>
                    </div>

                    <div class="inputWrapper">
                        <div class="input">
                            <label>Seat Availability </label>
                            <select type="number" name="available" value="<?php echo $row['seat_availability'] ?>" required="required">
                                <option value="<?php echo $row['seat_availability'] ?>" selected>
                                    <?php echo $row['seat_availability'] ?>
                                </option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="button d-flex justify-content-end">
                        <a href="../seats.php" onclick="return confirm('Are you exit current form?');">Back</a>
                        <button type="submit" id="screeningBtn" name="seatEdit">Update</button>
                    </div>
                </form>
            </div>

        </div>

        <!-- SEAT EDIT FORM  _________________ END -->

        <!-- <div class="row"> -->

        <script src="../js/admin.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>

    </html>