<?php
include "../config.php";
session_start();
$userID = $_SESSION['userID'];
$sql = "SELECT * FROM user WHERE userID = '$userID'";
$result = mysqli_query($connect, $sql);
if ($result) {
    // Fetch data
    while ($row = $result->fetch_assoc()) {
        // Access data using $row['column1'], $row['column2'], etc.
        $username = $row['firstName'];
    }} 
if (isset($_SESSION['userID']) && isset($_SESSION['password'])) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Project</title>
        <link rel="stylesheet" href="../css files/uploads2.css">
        <link rel="stylesheet" href="../css files/homepage6.css">

        <script src="https://kit.fontawesome.com/979ee355d9.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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

            <form action="#" method="post" class="system-name">
                <label for="" id="sys-name">Welcome! <?php echo $username;?></label>
                <button type="submit" name="logout" id="logout" class="btn">
                    <img src="../images/power.png" style="width: 40px; border-radius: 50px; border: none;" alt="Logout">
                </button>
            </form>
        </header>

        <nav class="navbar navbar-expand navbar-dark" id="navigation">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navi">

                    <ul class="navbar-nav mb-2 mb-lg-0" id="left-nav">

                        <li class="nav-item">
                            <a href="user-home.php" class="nav-link ">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="checkers.php" class="nav-link">Checker</a>
                        </li>

                    </ul>

                    <ul class="navbar-nav" id="right-nav">
                        <li class="nav-item">
                            <a href="uploads.php" class="nav-link active">
                                <i class="fas fa-user fa"></i>&nbsp;&nbsp;Project
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid" id="cont">
            <form action="uploads.php" method="post" enctype="multipart/form-data">
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
                        <label for="" id="program-label"><b>Program</b></label>
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

<?php
} else {
    session_destroy();
    echo "Please log in first.";
    header("Refresh: 3; url='login.php'");
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
        $sql = 'INSERT INTO `uploaded_capstones`(`capstoneTitle`, `capstoneAbstract`, `dateCreated`, `fileContent`, `dateFileUploaded`, `majorID`, `status`, userID) VALUES ("' . $title . '","' . $abstract . '","' . $dateCreated . '","' . $fileName . '","' . $dateTime . '","' . $program . '","pending", "'.$userID.'")';
        $result = mysqli_query($connect, $sql);

        $sql = "UPDATE groups SET status = 'finished' WHERE leaderID = '".$_SESSION['userID']."'";
        $result = mysqli_query($connect, $sql);

        echo '<script>alert("Capstone has been uploaded successfully!")</script>';
    }
}
?>