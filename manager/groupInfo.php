<?php
include "../config.php";
session_start();
$_SESSION['groupID'] == "" ? $groupID = urldecode($_GET['groupID']) : $groupID = $_SESSION['groupID'];

if (isset($_POST['returnbtn'])) {
    header("Refresh: 0; url='viewGroups.php'");
}

if (isset($_POST['deletebtn'])) {
    $query = "DELETE FROM `groups` WHERE groupID = '$groupID'";
    // $execute = mysqli_query($connect, $query);
    
    $program = mysqli_query($connect, "SELECT * FROM groups WHERE groupID = '$groupID'");
        while ($result = mysqli_fetch_array($program)) {
            $leader = "";
            $m1 = "";
            $m2 = "";
            $m3 = "";
            $m4 = "";
            $m5 = "";
        }
    header("Refresh: 0; url='viewGroups.php'");
}

if (isset($_SESSION['professorID']) && isset($_SESSION['profPassword'])) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css files/create-class2.css">
        <title>Group Info</title>
    </head>

    <body>
        <?php include "../headers/prof_header_home.php"; ?>
        <form action="" method="post" id="inputs">
            <div class="wrapper">
                <div class="label">
                    <label for=""><b>
                    <?php
                    include('../config.php');
                    $program = mysqli_query($connect, "SELECT * FROM groups WHERE groupID = '$groupID'");
                    while ($result = mysqli_fetch_array($program)) {
                        echo $result['title'];
                    ?> 
                    <?php } ?>
                    </b></label>
                </div>

                <div class="row">
                    <div class="col" id="semester">
                        <label for=""><b>Leader</b></label>
                        <select name="leader" id="sem" disabled>
                            <?php
                            include('../config.php');
                            $program = mysqli_query($connect, "SELECT * FROM groups WHERE groupID = '$groupID'");
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
                            $program = mysqli_query($connect, "SELECT * FROM groups WHERE groupID = '$groupID'");
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
                            $program = mysqli_query($connect, "SELECT * FROM groups WHERE groupID = '$groupID'");
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
                            $program = mysqli_query($connect, "SELECT * FROM groups WHERE groupID = '$groupID'");
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
                            $program = mysqli_query($connect, "SELECT * FROM groups WHERE groupID = '$groupID'");
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
                            $program = mysqli_query($connect, "SELECT * FROM groups WHERE groupID = '$groupID'");
                            while ($result = mysqli_fetch_array($program)) {
                            ?>
                                <option value="<?php echo $result['member5ID'] ?>"><?php echo $result['member5ID'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

            </div>
            <button type="submit" name="deletebtn" id="createbtn">Delete Group</button>
            <button type="submit" name="returnbtn" id="createbtn">Return</button>
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