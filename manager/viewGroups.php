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
        <?php include "../headers/prof_header_home.php"; ?>

        <!-- CODE MO IDOL  -->

        <!-- <a href="createClass.php">Create Class</a> -->
        <div class="container-fluid">

            <div class="row mt-5" id="top">
                <div class="col" id="title-section">
                    <label for="" id="title"><b>Groups</b></label>
                </div>
                <div class="col" id="create-section">
                    <a href="addGroups.php" id="create">
                        <i class="fa-solid fa-user-plus fa-lg"></i>
                        Create Group
                    </a>
                </div>
            </div>

            <!-- ETO OUTPUT PAG NAG CREATE -->
            <div class="row" id="classes">

                <?php

                //dito ako nagstop
                $sql = "SELECT * FROM `groups` WHERE blockID = '". $_SESSION['GBlockID'] . "'";
                $result = mysqli_query($connect, $sql);

                while ($row = mysqli_fetch_array($result)) {
                    $groupID = $row['groupID'];
                ?>
                    <div class="col" id="output">
                        <a href="groupInfo.php?groupID=<?php echo urlencode($groupID); ?>" class="box">
                            <?php $_SESSION['groupID'] = "";?>
                            <label for=""><?php echo $row['title'] ?></label>
                        </a>
                    </div>
                <?php }
                ?>

            </div>
        </div>
    </body>

    </html>

<?php
} else {
    session_destroy();
    echo "<script>alert('Please log in first.')</script>";
    header("Refresh: 3; url='../login/login.php'");
}
?>