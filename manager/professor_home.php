<?php
include "../config.php";
session_start();
if (isset($_SESSION['professorID']) && isset($_SESSION['profPassword'])) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css files/prof-home3.css">
        <script src="https://kit.fontawesome.com/979ee355d9.js" crossorigin="anonymous"></script>
        <title>Capstone Archive</title>
    </head>

    <body>
        <?php include "../headers/prof_header_home.php";?>

    <!-- CODE MO IDOL  -->

        <!-- <a href="createClass.php">Create Class</a>

        <?php 
            $sql = "SELECT * FROM `block` WHERE `professorID` = '".$_SESSION['professorID']."'";
            $result = mysqli_query($connect, $sql);

            while($row = mysqli_fetch_array($result)){ ?> 
               <br><a href=""><?php echo $row['blockName']?></a>
            <?php }
        ?> -->

     <!-- CODE MO IDOL  -->
     
        <!-- CODE KO -->
        <div class="container-fluid">

            <div class="row mt-5" id="top">
                <div class="col" id="title-section">
                    <label for="" id="title"><b>Capstone Projects</b></label>
                </div>
                <div class="col" id="create-section">
                    <a href="createClass.php" id="create">
                    <i class="fa-solid fa-user-plus fa-lg"></i>
                        Create Class
                    </a>
                </div>
            </div>
                <!-- ETO OUTPUT PAG NAG CREATE -->
            <div class="row" id="classes">
                <div class="col" id="output">
                    <a href="" class="box">
                        <label for="">Class name</label>
                        <label for="">Year</label>
                    </a>
                </div>

                <div class="col" id="output">
                    <a href="" class="box">
                        <label for="">Class name</label>
                        <label for="">Year</label>
                    </a>
                </div>

                <div class="col" id="output">
                    <a href="" class="box">
                        <label for="">Class name</label>
                        <label for="">Year</label>
                    </a> 
                </div>

                <div class="col" id="output">
                    <a href="" class="box">
                        <label for="">Class name</label>
                        <label for="">Year</label>
                    </a>
                </div>
            </div>
        </div>
    </body>

    </html>

<?php
} else {
    session_destroy();
    echo "<script>alert('Please log in first.')</script>";
    header("Refresh: 3; url='../login/manager-login.php'");
}
?>