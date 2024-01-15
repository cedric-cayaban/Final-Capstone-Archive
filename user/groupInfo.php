<?php
include "../config.php";
session_start();

if (isset($_POST['returnbtn'])) {
    header("Refresh: 0; url='viewClass.php'");
}

if (isset($_SESSION['userID']) && isset($_SESSION['password'])) { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css files/create-class7.css">
        <title>Group Info</title>
    </head>

    <body>
        <?php include "../headers/user_header_home.php"; ?>
        <form action="" method="post" id="inputs">
            <div class="wrapper">
                <div class="label">
                    <label for="" id="title-gname">
                        <b>
                            <?php
                            include('../config.php');
                            $program = mysqli_query($connect, "SELECT * FROM `groups` WHERE `leaderID` = '".$_SESSION['userID']."' OR `member1ID`= '".$_SESSION['userID']."' OR `member2ID`= '".$_SESSION['userID']."' OR `member3ID`= '".$_SESSION['userID']."' OR `member4ID`= '".$_SESSION['userID']."' OR `member5ID`= '".$_SESSION['userID']."';");
                            while ($result = mysqli_fetch_array($program)) {
                                echo $result['title'];
                            ?>
                            <?php } ?>
                        </b>
                    </label>
                </div>

                <div class="row">
                    <div class="col" id="semester">
                        <label for=""><b>Leader</b></label>
                        <select name="leader" id="sem" disabled>
                            <?php
                            include('../config.php');
                            $program = mysqli_query($connect, "SELECT * FROM `groups` WHERE `leaderID` = '".$_SESSION['userID']."' OR `member1ID`= '".$_SESSION['userID']."' OR `member2ID`= '".$_SESSION['userID']."' OR `member3ID`= '".$_SESSION['userID']."' OR `member4ID`= '".$_SESSION['userID']."' OR `member5ID`= '".$_SESSION['userID']."';");
                            while ($result = mysqli_fetch_array($program)) {
                            ?>
                                <option value="<?php echo $result['leaderID'] ?>"><?php echo $result['leaderID'] ?></option>
                            <?php } ?>
                        </select>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col" id="semester">
                        <label for=""><b>Member 1</b></label>
                        <select name="member1" id="sem" disabled>
                            <?php
                            include('../config.php');
                            $program = mysqli_query($connect, "SELECT * FROM `groups` WHERE `leaderID` = '".$_SESSION['userID']."' OR `member1ID`= '".$_SESSION['userID']."' OR `member2ID`= '".$_SESSION['userID']."' OR `member3ID`= '".$_SESSION['userID']."' OR `member4ID`= '".$_SESSION['userID']."' OR `member5ID`= '".$_SESSION['userID']."';");
                            while ($result = mysqli_fetch_array($program)) {
                            ?>
                                <option value="<?php echo $result['member1ID'] ?>"><?php echo $result['member1ID'] ?></option>
                            <?php } ?>
                        </select>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col" id="semester">
                        <label for=""><b>Member 2</b></label>
                        <select name="member2" id="sem" disabled>
                            <?php
                            include('../config.php');
                            $program = mysqli_query($connect, "SELECT * FROM `groups` WHERE `leaderID` = '".$_SESSION['userID']."' OR `member1ID`= '".$_SESSION['userID']."' OR `member2ID`= '".$_SESSION['userID']."' OR `member3ID`= '".$_SESSION['userID']."' OR `member4ID`= '".$_SESSION['userID']."' OR `member5ID`= '".$_SESSION['userID']."';");
                            while ($result = mysqli_fetch_array($program)) {
                            ?>
                                <option value="<?php echo $result['member2ID'] ?>"><?php echo $result['member2ID'] ?></option>
                            <?php } ?>
                        </select>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col" id="semester">
                        <label for=""><b>Member 3</b></label>
                        <select name="member3" id="sem" disabled>
                            <?php
                            include('../config.php');
                            $program = mysqli_query($connect, "SELECT * FROM `groups` WHERE `leaderID` = '".$_SESSION['userID']."' OR `member1ID`= '".$_SESSION['userID']."' OR `member2ID`= '".$_SESSION['userID']."' OR `member3ID`= '".$_SESSION['userID']."' OR `member4ID`= '".$_SESSION['userID']."' OR `member5ID`= '".$_SESSION['userID']."';");
                            while ($result = mysqli_fetch_array($program)) {
                            ?>
                                <option value="<?php echo $result['member3ID'] ?>"><?php echo $result['member3ID'] ?></option>
                            <?php } ?>
                        </select>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col" id="semester">
                        <label for=""><b>Member 4</b></label>
                        <select name="member4" id="sem" disabled>
                            <?php
                            include('../config.php');
                            $program = mysqli_query($connect, "SELECT * FROM `groups` WHERE `leaderID` = '".$_SESSION['userID']."' OR `member1ID`= '".$_SESSION['userID']."' OR `member2ID`= '".$_SESSION['userID']."' OR `member3ID`= '".$_SESSION['userID']."' OR `member4ID`= '".$_SESSION['userID']."' OR `member5ID`= '".$_SESSION['userID']."';");
                            while ($result = mysqli_fetch_array($program)) {
                            ?>
                                <option value="<?php echo $result['member4ID'] ?>"><?php echo $result['member4ID'] ?></option>
                            <?php } ?>
                        </select>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col" id="semester">
                        <label for=""><b>Member 5</b></label>
                        <select name="member5" id="sem" disabled>
                            <?php
                            include('../config.php');
                            $program = mysqli_query($connect, "SELECT * FROM `groups` WHERE `leaderID` = '".$_SESSION['userID']."' OR `member1ID`= '".$_SESSION['userID']."' OR `member2ID`= '".$_SESSION['userID']."' OR `member3ID`= '".$_SESSION['userID']."' OR `member4ID`= '".$_SESSION['userID']."' OR `member5ID`= '".$_SESSION['userID']."';");
                            while ($result = mysqli_fetch_array($program)) {
                            ?>
                                <option value="<?php echo $result['member5ID'] ?>"><?php echo $result['member5ID'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                <div class="functions">
                    <button type="submit" name="returnbtn" id="deletebtn">Return</button>
                </div>
                
            </div>
            
        </form>
    </body>

    </html>
<?php
} else {
    session_destroy();
    echo "<script>alert('Please log in first.')</script>";
    header("Refresh: 3; url='../login/login.php'");
}
?>