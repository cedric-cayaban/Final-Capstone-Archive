<?php
        include "../config.php";
        $userID = $_SESSION['professorID'];
        $sql = "SELECT * FROM professor WHERE professorID = '$userID'";
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
    <link rel="stylesheet" href="../css files/admin-header5.css">
    <link rel="stylesheet" href="../css files/logout.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">  
    <title>Document</title>
</head>
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
       
        <form action="#" method="post" class="system-name">
            <label for="" id="sys-name">Welcome, Professor <?php echo $username;?>!</label>
            <button type="submit"  name="logout" id="logout" class="new-button" >
                            <img style= "width: 25px;
                        border-radius: 0px;
                        float: left;"src="../images/logout_icon.png"alt="Logout">
                        
                    <div class="new-logout">LOGOUT</div>

                </button >
        </form>
    </header>

    <nav class="navbar navbar-expand navbar-dark ">
        <div class="container-fluid">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mb-2 mb-lg-0" id="left-nav">
                    <li class="nav-item">
                        <a href="../manager/professor_home.php" class="nav-link active">Class</a>
                    </li>
                    <li class="nav-item">
                        <a href="../manager/submission.php" class="nav-link ">Submission</a>
                    </li>
                    <li class="nav-item">
                        <a href="../manager/inventory.php" class="nav-link">Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a href="../manager/archive.php" class="nav-link">Archive</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
   
</body>

</html>
