<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css files\user-type3.css">
    <script src="https://kit.fontawesome.com/979ee355d9.js" crossorigin="anonymous"></script>
    <title>Login</title>
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <img class="logo" src="../images/psuLogo.svg" alt="PSU Logo">
            <label class="text-header"><b>PANGASINAN</b> <span class="text-header2">STATE UNIVERSITY</span></label>
        </div>

        <div class="title">
            <label for="">IT CAPSTONE PROJECT INVENTORY</label>
        </div>

        <form action="login.php" method="post" class="field-input">

            <div class="labels">
                <label for="">Select user-type</label>
            </div>
            

            <div class="type">
                <a href="student-login.php">
                    <i class="fa-solid fa-user fa-xl"></i>&nbsp&nbspStudent
                </a>

                <a href="manager-login.php">
                    <i class="fa-solid fa-user-tie fa-xl"></i>&nbsp&nbspManager
                    
                </a>

                <a href="admin-login.php">
                    <i class="fa-solid fa-user-tie fa-xl"></i>&nbsp&nbspAdmin
                    
                </a>
            </div>
        </form>
    </div>
</body>

</html>