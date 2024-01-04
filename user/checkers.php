<?php
    include "../config.php";
    session_start();
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
        include "../headers/user_header_home.php"; //call header for user
    ?>

    <form action="checker.php">

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

    <div class="container-fluid">
        <div class="recommend">
            <label for="">Title Recommendation</label>
            <ul>
                <li><p>title 1</p></li>
                <li><p>title 2</p></li>
                <li><p>title 3</p></li>
            </ul>
        </div>
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