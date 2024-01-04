<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css files/login1.css">
    <link rel="stylesheet" href="">
    <title>Master Admin Login</title>
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <img class="logo" src="../images/psuLogo.svg" alt="PSU Logo">
            <label class="text-header"><b>PANGASINAN</b> <span class="text-header2">STATE UNIVERSITY</span></label>
        </div>

        <div class="title">
            <label for="">ADMIN LOGIN</label>
        </div>

        <form action="admin-login.php" method="post" class="field-input">
        <label for="">Admin ID</label>
        <input type="text" name="adminID" placeholder="admin2023_01">
        <label for="">Password</label>
        <input type="password" name="password" placeholder="********">
        <?php
        require "..\config.php";
        session_start();

        if (isset($_POST['btnLogin'])) {
            $adminID = $_POST['adminID'];
            $password = $_POST['password'];

            if (!empty($adminID) && !empty($password)) {
                $sql = "SELECT `adminID`, `password` FROM `admin` WHERE admin.adminID = '$adminID' AND admin.password = '$password'";
                $result = mysqli_query($connect, $sql);

                if (mysqli_num_rows($result) >= 1) {
                    $row = mysqli_fetch_assoc($result);
                    if ($row['adminID'] == $adminID && $row['password'] == $password) {
                        // echo "<script>alert('Logged in successfully!')</script>";
                        $_SESSION['adminID'] = $row['adminID'];
                        $_SESSION['adminPassword'] = $row['password'];
                        echo "<p style='color: green;'>Logged in.</p>";
                        header("Refresh: 1; url='../admin/admin_home.php'");
                    } else {
                        echo "<p style='color: red;'>Invalid credentials.</p>";
                    }
                } else {
                    echo "<p style='color: red;'>Invalid credentials.</p>";
                }
            } else {
                echo "<p style='color: red;'>Invalid credentials.</p>";
            }
        }
        ?>
        <input type="submit" name="btnLogin" value="LOGIN" id="login">
    </form>
    <a href="login-type.php">Back to Login Type</a> 
    </div>
    
    
</body>

</html>