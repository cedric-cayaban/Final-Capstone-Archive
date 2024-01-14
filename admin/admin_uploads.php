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
        <link rel="stylesheet" href="../css files/uploads2.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <title>Professor Approval</title>
    </head>

    <style>
        th{
            text-align: center;
            
        }

        table{
                margin-top: 1%;
            }

        .container-fluid{
            padding-left: 3%;
            padding-right: 3%;
        }
    </style>

    <?php
if (isset($_POST['logout'])) {
    session_destroy();
    header("Refresh: 1; url='../login/login.php'");
    echo "<script>alert('Logged out successfully.')</script>";
}
?>

    <body>
    <header class="d-flex justify-content-between align-items-center">
        <div class="top-section">
            <img class="logo" src="../images/finalnlogo.svg" alt="PSU Logo" style="max-width: 300px; margin-right: 10px;">
            <!-- <label><b>PANGASINAN STATE UNIVERSITY</b></label> -->
        </div>
       
        <form action="archive.php" method="post" class="system-name">
            <label for="" id="sys-name">Welcome, Admin <?php echo $username;?>! </label>
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
                        <a href="../admin/admin_home.php" class="nav-link">Users</a>
                    </li>
                    <li class="nav-item">
                        <a href="../admin/admin-managers.php" class="nav-link">Managers</a>
                    </li>
                    <li class="nav-item">
                        <a href="../admin/inventory.php" class="nav-link active">Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a href="../admin/archive.php" class="nav-link ">Archive</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>      
    <div class="container-fluid" id="cont">
    <form action="admin_uploads.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col" id="title">
                        <label for=""><b>Title</b>:</label>
                        <input type="text" name="title" id="cTitle" required>
                    </div>
                    <div class="col" id="date">
                        <label for=""><b>Date Created</b></label>
                        <input type="month" name="dateCreated" id="cDate" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col" id="abstract">
                        <label for=""><b>Abstract:</b></label>
                        <textarea name="abstract" name="abstract" id="cAbstract" cols="30" rows="7" required></textarea>
                    </div>

                    <div class="col" id="multiple">
                        <label for="" id="program-label"><b>Major</b></label>
                        <select name="program" id="program">
                            <?php
                            include('../config.php');
                            $program = mysqli_query($connect, "SELECT * FROM major");
                            while ($result = mysqli_fetch_array($program)) {
                            ?>
                                <option value="<?php echo $result['majorID'] ?>"><?php echo $result['majorName'] ?></option>
                            <?php } ?>
                        </select>

                        <label for="capstoneFile" name="fileContent" id="upload"><b>Upload file</b></label>
                        <input type="file" name="capstoneFile" id="capstoneFile" required>
                    </div>
                </div>

                <input type="submit" name="submitFile" id="submitFile" value="Submit">

            </form>
                            </div>
        

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>

<?php
} else {
    session_destroy();
    echo "<script>alert('Please log in first.')</script>";
    header("Refresh: 1; url='../login/admin-login.php'");
}
?>

<?php
if (isset($_POST['submitFile'])) {
    $title = $_POST['title'];
    $abstract = htmlspecialchars($_POST['abstract']);
    $dateCreated = $_POST['dateCreated'];
    $program = $_POST['program'];

    $fileName = $_FILES['capstoneFile']['name'];
    $tmpFileName = $_FILES['capstoneFile']['tmp_name'];
    $targetdir = '../capstones/';

    $today = new DateTime("now", new DateTimeZone('Asia/Manila'));
    $dateTime = $today->format('Y-m-d');
    $upload = false;

    if (!file_exists($targetdir)) {
        mkdir('../capstones/');
    }

    $directory = $targetdir . $fileName;
    $fileExt = strtolower(pathinfo($directory, PATHINFO_EXTENSION));

    if ($fileExt == 'pdf') {
        move_uploaded_file($tmpFileName, $targetdir . $fileName);
        $upload = true;
    } else {
        echo '<script>alert("File type unsupported.")</script>';
    }

    if ($upload) {
        $sql = 'INSERT INTO `uploaded_capstones`(`capstoneTitle`, `capstoneAbstract`, `dateCreated`, `fileContent`, `dateFileUploaded`, `majorID`, `status`, userID) VALUES ("' . $title . '","' . $abstract . '","' . $dateCreated . '","' . $fileName . '","' . $dateTime . '","' . $program . '","approved", "'.$userID.'")';
        $result = mysqli_query($connect, $sql);

      

        echo '<script>alert("Capstone has been uploaded successfully!")</script>';
    }
}
?>