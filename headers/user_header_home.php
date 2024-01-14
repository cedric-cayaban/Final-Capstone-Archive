
<?php
        include "../config.php";
        $userID = $_SESSION['userID'];
        $sql = "SELECT * FROM user WHERE userID = '$userID'";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            // Fetch data
            while ($row = $result->fetch_assoc()) {
                // Access data using $row['column1'], $row['column2'], etc.
                $username = $row['firstName'];
            }} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/979ee355d9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css files/homepage.css">
    <title>Document</title>
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
            <!-- <label><b>CAPSTONE ARCHIVE</b></label> -->
        </div>
       
        <form action="#" method="post" class="system-name">
            <label for="" id="sys-name">Welcome!  <?php echo $username;?></label>
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
                        <a href="user-home.php" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="checkers.php" class="nav-link">Checker</a>
                    </li>
                </ul>
                    <?php
        include "../config.php";
        $userID = $_SESSION['userID'];
        $sql = "SELECT * FROM groups WHERE leaderID = '$userID'";
        $result = mysqli_query($connect, $sql);
        if ($row = mysqli_num_rows($result) > 0) { ?>
                <ul class="navbar-nav" id="right-nav">
                    <li class="nav-item">
                        <a href="uploads.php" class="nav-link">
                            &nbsp;&nbsp;Project
                        </a>
                    </li>
                </ul>
                <?php } ?>


            </div>
        </div>
    </nav>
    

    <!-- Add your content here -->

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
