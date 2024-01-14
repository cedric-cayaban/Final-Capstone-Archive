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
    
    if (isset($_SESSION['userID']) && isset($_SESSION['password'])) { 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css files/checker3.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
                            <a href="checkers.php" class="nav-link active">Checker</a>
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
                            <i class="fas fa-user fa"></i>&nbsp;&nbsp;Project
                        </a>
                    </li>
                </ul>
                <?php } ?>
                </div>
            </div>
        </nav>

    <form action="result.php">

    <div class="container-fluid py-5">
       <div class="row" id="">
            <div class="col-md" id="pTitle">
                <label for="" id="label"><b>Capstone Proposal Title</b></label>
                <textarea name="proposal_title" id="proposal_title" cols="20" rows="1"></textarea>
            </div>
       </div>

       <div class="row">
            <div class="col-md" id="pDesc">
                <label for="" id="label"><b>Proposal Description</b></label>
                <textarea name="proposal_desc" id="proposal_desc" cols="20" rows="10"></textarea>
            </div>
       </div>
       <input type="submit" value="Check" id="button">
    </div>

    
    
    </form>
    



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
</body>
</html>

<?php
} else {
    session_destroy();
    echo "<script>alert('Please log in first.')</script>";
    header("Refresh: 3; url='../login/student-login.php'");
}
?>