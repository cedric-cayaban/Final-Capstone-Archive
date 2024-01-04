<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css files/homepage3.css">
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
            <img class="logo" src="../images/psuLogo.svg" alt="PSU Logo" style="max-width: 100px; margin-right: 10px;">
            <label><b>PANGASINAN STATE UNIVERSITY</b></label>
        </div>
       
        <form action="user_home.php" method="post" class="system-name">
            <label for="" id="sys-name">IT CAPSTONE PROJECT INVENTORY</label>
            <button type="submit" name="logout" id="logout" class="btn">
                <img src="../images/power.png" style="width: 40px; border-radius: 50px; border: none;" alt="Logout">
            </button>
        </form>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mb-2 mb-lg-0" id="left-nav">
                    <li class="nav-item">
                        <a href="user_home.php" class="nav-link active">Document Preview</a>
                    </li> 
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>