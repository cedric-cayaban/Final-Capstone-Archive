<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="..\css files\register.css">
    
    <title>Registration</title>
</head>

<body>
    <div class="wrapper">
        <div class="wrap-header">
            <label class="title"><b>REGISTER</b></label>
        </div>


        
        <form action="register.php" onSubmit="return validate();" method="post">

            <label for="">Student ID</label>
            <input type="text" name="userID" required>

            <label for="">Last Name</label>
            <input type="text" name="lastName" required>

            <label for="">First Name</label>
            <input type="text" name="firstName" required>

            <label for="">Middle Name</label>
            <input type="text" name="middleName" required>

            <label for="">Password</label>
            <input type="password" name="password" id="password" required>

            <label for="">Confirm Password</label>
            <input type="password" name="confirmPassword" id="confirmPassword" required>

            <label for="">Program</label>
            <select name="program" id=""> <!-- program -->
                <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology</option>
                <option value="Software Engineering">Software Engineering</option>
            </select>

            <label for="">Major</label>
            <select name="major" id=""> <!-- major -->
                <?php
                include('../config.php');
                $program = mysqli_query($connect, "SELECT * FROM major");
                while ($result = mysqli_fetch_array($program)) {
                ?>
                    <option value="<?php echo $result['majorID'] ?>"><?php echo $result['majorName'] ?></option>
                <?php } ?>
            </select>
        <div class="cont">
            <input type="submit" name="btnRegister" value="REGISTER" id="register">
            <label for="login">Already Have an Account? <a href="student-login.php">Log in</a></label>
        </div>
        
        
    </form>
    </div>

    
    <script>
        function validate() { //password validation
            var a = document.getElementById("password").value;
            var b = document.getElementById("confirmPassword").value;
            if (a != b) {
                alert("Passwords does not match");
                return false;
            }
        }
    </script>
</body>

</html>

<?php
require "../config.php";
if (isset($_POST['btnRegister'])) {
    $userID = $_POST['userID'];
    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $major = $_POST['major'];

    $select = "SELECT * FROM user WHERE userID = '$userID'";
    $result = mysqli_query($connect, $select);

    if (mysqli_num_rows($result) > 0) {
        echo '<script>alert("ID Number is already registered!")</script>';
    } else {
        $sql = "INSERT INTO `user`(`userID`, `majorID`, `password`, `lastName`, `firstName`, `middleName`) VALUES ('$userID','$major','$password','$lastName','$firstName','$middleName')";
        $query = mysqli_query($connect, $sql);
        if ($query) {
            echo "<script>alert('Registered succesfully!')</script>";
            header("Refresh: 1; url='student-login.php'");
        } else {
            echo "<script>alert('Error!')</script>";
        }
    }
} else if (isset($_POST['btnLogin'])) {
    header("Refresh: 0, url='student-login.php'");
}
?>