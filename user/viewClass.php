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
    }
}

if(isset($_POST['viewGroupsbtn'])){
    header("Refresh: 0; url='groupInfo.php'");
}
if (isset($_SESSION['userID']) && isset($_SESSION['password'])) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Project</title>
        <link rel="stylesheet" href="../css files/uploads3.css">
        <link rel="stylesheet" href="../css files/homepage9.css">
        <link rel="stylesheet" href="../css files/logout.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css files/add-students3.css">
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
                <label for="" id="sys-name">Welcome, <?php echo $username; ?>!</label>
                <button type="submit" name="logout" id="logout" class="new-button">
                    <img style="width: 25px;
                        border-radius: 0px;
                        float: left;" src="../images/logout_icon.png" alt="Logout">

                    <div class="new-logout">LOGOUT</div>

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
                            <a href="viewClass.php" class="nav-link active">
                                &nbsp;&nbsp;My Class
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="uploads.php" class="nav-link ">
                                &nbsp;&nbsp;Project
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid" id="contents">
            <form action="" method="post">

                <?php
                $sql = "SELECT * FROM `block` JOIN students ON block.blockID = students.blockID WHERE students.studentID = '$userID';";
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_array($result)) { ?>
                    <div class="row">

                        <div class="row">
                            <div class="col-md" id="block-sec">
                                <label for="" id="blocks"><b>BSIT <?php echo $row['blockName']; ?></b></label>
                            </div>
                            <div class="col-md" id="sem-sec">
                                <label for="" id="sem"><b><?php echo $row['semester']; ?></b></label>
                                <label for="" id="year"> <b>A.Y. <?php echo $row['year']; ?></b></label>
                            </div>
                        </div>
            </form>
        <?php } ?>

        <form action="" method="post" class="lowest-part">
            <button type="submit" class="btn btn-primary" id="delete" name="viewGroupsbtn" style="color: white;">My Group</button>
        </form>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <th scope="col">ID Number</th>
                <th scope="col">Last Name</th>
                <th scope="col">First Name</th>
                <th scope="col">Middle Name</th>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `block` JOIN students ON block.blockID = students.blockID WHERE students.studentID = '$userID';";
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_array($result)) { ?>
                    <?php
                    $query = "SELECT * FROM students WHERE blockID = '".$row['blockID']."'";
                    $result = mysqli_query($connect, $query);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row['studentID']; ?></td>
                            <td><?php echo $row['lastName']; ?></td>
                            <td><?php echo $row['firstName']; ?></td>
                            <td><?php echo $row['middleName']; ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

<?php
} else {
    session_destroy();
    echo "Please log in first.";
    header("Refresh: 3; url='../login/login.php'");
}
?>