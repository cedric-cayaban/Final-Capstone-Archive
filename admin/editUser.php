<?php
include "../config.php";
session_start();
if (isset($_SESSION['adminID']) && isset($_SESSION['adminPassword'])) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css files/admin-header4.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/979ee355d9.js" crossorigin="anonymous"></script>
        <title>Capstone Archive</title>
    </head>

    <body>
        <?php include "../headers/admin_header_home.php"; ?>
        <?php

        if(isset($_GET['title'])){
            $editUser = $_GET['title'];
        }
        if(isset($_POST['save'])){
            $userID = $_POST['userID'];
            $password = $_POST['password'];
            $lastName = $_POST['lastName'];
            $firstName = $_POST['firstName'];
            $middleName = $_POST['middleName'];
            $program = $_POST['program'];
            $major = $_POST['major'];
            $adminID = $_SESSION['adminID'];

            $query = "UPDATE `user` SET `majorID`='$major',`program`='$program',`password`='$password',`lastName`='$lastName',`firstName`='$firstName',`middleName`='$middleName',`adminID`='$adminID' WHERE user.userID = '$userID'";
            $result = mysqli_query($connect, $query);
            echo "<script>alert('User has been updated successfully.')</script>";
            header("Refresh: 0; url='../admin/admin_home.php'");            

        }
        if(isset($_POST['cancel'])){
            header("Refresh: 0; url='../admin/admin_home.php'");            
        }
        $query = "SELECT * FROM `user` WHERE user.userID = '$editUser'";
        $result = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="container-fluid col-md-6" id="cont">
            <form action="" class=""method="post">

                <div class="form-group mb-2">
                
                    <label for="professorID"><b>User ID</b></label>
                    <input type="text" class="form-control" name="userID" id="" value="<?php echo $editUser?>" required readonly>

                    <label for="professorID"><b>Password</b></label>
                    <input type="text" class="form-control" name="password" id="" value="<?php echo $row['password'] ?>" required>

                    <label for="professorID"><b>Last Name</b></label>
                    <input type="text" class="form-control" name="lastName" id="" value="<?php echo $row['lastName'] ?>" required>

                    <label for="professorID"><b>First Name</b></label>
                    <input type="text" class="form-control" name="firstName" id="" value="<?php echo $row['firstName'] ?>" required>

                    <label for="professorID"><b>Middle Name</b></label>
                    <input type="text" class="form-control" name="middleName" id="" value="<?php echo $row['middleName'] ?>" required>

                    <label for="professorID"><b>Program</b></label>
                    <select name="program"  class="form-select"id=""> <!-- program -->
                        <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology</option>
                        <option value="Software Engineering">Software Engineering</option>
                    </select>

                    <label for="professorID"><b>Major</b></label>
                    <select name="major" class="form-select" id=""> <!-- major -->
                        <?php
                        include('../config.php');
                        $program = mysqli_query($connect, "SELECT * FROM major");
                        while ($q = mysqli_fetch_array($program)) {
                        ?>
                            <option value="<?php echo $q['majorID'] ?>"><?php echo $q['majorName'] ?></option>
                        <?php }?>
                    </select>
                    
                    <button type="submit" class="btn btn-primary" name="save">Save</button>
                     <button type="submit" class="btn btn-secondary" name="cancel">Cancel</button>

                </div>

               


                    
                </form> 
           
            </div>
           
            
        <?php } ?>
    </body>
    </html>

<?php
} else {
    session_destroy();
    echo "<script>alert('Please log in first.')</script>";
    header("Refresh: 1; url='../login/admin-login.php'");
}
?>