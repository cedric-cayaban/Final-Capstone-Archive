<?php
include "../config.php";
session_start();
$userID = $_SESSION['adminID'];
        $sql = "SELECT * FROM admin WHERE adminID = '$userID'";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            // Fetch data
            while ($row = $result->fetch_assoc()) {
                // Access data using $row['column1'], $row['column2'], etc.
                $username = $row['firstName'];
            }} 

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
        <?php
if (isset($_POST['logout'])) {
    session_destroy();
    header("Refresh: 1; url='../login/login.php'");
    echo "<script>alert('Logged out successfully.')</script>";
}
?>
        <header class="d-flex justify-content-between align-items-center">
        <div class="top-section">
            <img class="logo" src="../images/finalnlogo.svg" alt="PSU Logo" style="max-width: 300px; margin-right: 10px;">
            <!-- <label><b>PANGASINAN STATE UNIVERSITY</b></label> -->
        </div>
       
        <form action="admin_home.php" method="post" class="system-name">
            <label for="" id="sys-name">Welcome Admin! <?php echo $username;?></label>
            <button type="submit" name="logout" id="logout" class="btn">
                <img src="../images/power.png" style="width: 40px; border-radius: 50px; border: none;" alt="Logout">
            </button>
        </form>
    </header>

    <nav class="navbar navbar-expand navbar-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mb-2 mb-lg-0" id="left-nav">
                    <li class="nav-item">
                        <a href="../admin/admin_home.php" class="nav-link ">Users</a>
                    </li>
                    <li class="nav-item">
                        <a href="../admin/admin-managers.php" class="nav-link active">Managers</a>
                    </li>
                    <li class="nav-item">
                        <a href="../admin/inventory.php" class="nav-link">Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a href="../admin/archive.php" class="nav-link">Archive</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
        <?php
        if(isset($_GET['title'])){
            $editProf = $_GET['title'];
        }
        if(isset($_POST['save'])){
            $professorID = $_POST['professorID'];
            $password = $_POST['password'];
            $lastName = $_POST['lastName'];
            $firstName = $_POST['firstName'];
            $middleName = $_POST['middleName'];
            $adminID = $_SESSION['adminID'];

            $query = "UPDATE `professor` SET `password`='$password',`lastName`='$lastName',`firstName`='$firstName',`middleName`='$middleName' WHERE professor.professorID = '$professorID'";
            $result = mysqli_query($connect, $query);
            echo "<script>alert('Professor\'s account has been updated successfully.')</script>";
            header("Refresh: 0; url='../admin/admin-managers.php'");            

        }
        if(isset($_POST['cancel'])){
            header("Refresh: 0; url='../admin/admin-managers.php'");            
        }
        $query = "SELECT * FROM `professor` WHERE professor.professorID = '$editProf'";
        $result = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>

        <div class="container-fluid col-md-6" id="cont">
            <form action="" method="post">

                <div class="form-group mb-2">
                    <label for="professorID"><b>Professor ID</b></label>
                    <input type="text" class="form-control" id="professorID" name="professorID" value="<?php echo $editProf?>" required readonly>
                </div>

                <div class="form-group  mb-2">
                    <label for="password"><b>Password</b></label>
                    <input type="text" class="form-control" id="password" name="password" value="<?php echo $row['password'] ?>" required>
                </div>

                <div class="form-group  mb-2">
                    <label for="lastName"><b>Last Name</b></label>
                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $row['lastName'] ?>" required>
                </div>

                <div class="form-group  mb-2">
                    <label for="firstName"><b>First Name</b></label>
                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $row['firstName'] ?>" required>
                </div>

                <div class="form-group mb-2">
                    <label for="middleName"><b>Middle Name</b></label>
                    <input type="text" class="form-control" id="middleName" name="middleName" value="<?php echo $row['middleName'] ?>" required>
                </div>

                <button type="submit" class="btn btn" id="savebtn" name="save">Save</button>
                <button type="submit" class="btn btn" id="cancelbtn" name="cancel">Cancel</button>

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