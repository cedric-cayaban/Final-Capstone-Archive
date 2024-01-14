<?php
include "../config.php";
session_start();
$GBlockID = $_SESSION['GBlockID'];
if (isset($_POST['createbtn'])) {

    $title = $_POST['title'];
    $leader = $_POST['leader'];
    $member1 = $_POST['member1'];
    $member2 = $_POST['member2'];
    $member3 = $_POST['member3'];
    $member4 = $_POST['member4'];
    $member5 = $_POST['member5'];

    if(($member1 == $member2 && $member1 !== "") || 
    ($member1 == $member3 && $member1 !== "") || 
    ($member1 == $member4 && $member1 !== "") || 
    ($member1 == $member5 && $member1 !== "") ||
    
    ($member2 == $member3 && $member2 !== "") || 
    ($member2 == $member4 && $member2 !== "") || 
    ($member2 == $member5 && $member2 !== "") ||

    ($member3 == $member4 && $member3 !== "") || 
    ($member3 == $member5 && $member3 !== "") ||

    ($member4 == $member5 && $member4 !== "")){
        echo '<script>alert("Only one role per student.")</script>';
    } else {
        $select = "SELECT * FROM `students` WHERE (studentID = '$leader' OR studentID = '$member1' OR studentID = '$member2' OR studentID = '$member3' OR studentID = '$member4' OR studentID = '$member5') AND `groupID` != 0";
        $res = mysqli_query($connect, $select);
        if(mysqli_num_rows($res) > 0){
            echo '<script>alert("Student is already in a group.")</script>';
        }else{
            $query = "INSERT INTO `groups`(`title`, professorID, `leaderID`, `member1ID`, `member2ID`, `member3ID`, `member4ID`, `member5ID`, `status`, `blockID`) VALUES ('$title', '".$_SESSION['professorID']."', '$leader','$member1','$member2','$member3','$member4','$member5','on-going','$GBlockID')";
            $result = mysqli_query($connect, $query);

            $select = "SELECT * FROM `groups` WHERE leaderID = '$leader'";
            $result = mysqli_query($connect, $select);
            while ($row = mysqli_fetch_array($result)){
                $_SESSION['groupID'] = $row['groupID'];
            }
            $query = "UPDATE `students` SET `groupID`='$GBlockID' WHERE `studentID` = '$leader'";
            $result = mysqli_query($connect, $query);

            if($member1 != ""){
                $query = "UPDATE `students` SET `groupID`='$GBlockID' WHERE `studentID` = '$member1'";
                $result = mysqli_query($connect, $query);
            }
            if($member2 != ""){
                $query = "UPDATE `students` SET `groupID`='$GBlockID' WHERE `studentID` = '$member2'";
                $result = mysqli_query($connect, $query);
            }
            if($member3 != ""){
                $query = "UPDATE `students` SET `groupID`='$GBlockID' WHERE `studentID` = '$member3'";
                $result = mysqli_query($connect, $query);
            }
            if($member4 != ""){
                $query = "UPDATE `students` SET `groupID`='$GBlockID' WHERE `studentID` = '$member4'";
                $result = mysqli_query($connect, $query);
            }
            if($member5 != ""){
                $query = "UPDATE `students` SET `groupID`='$GBlockID' WHERE `studentID` = '$member5'";
                $result = mysqli_query($connect, $query);
            }

            echo '<script>alert("Group has been created successfully.")</script>';
            header("Refresh: 1; url='groupInfo.php");
        }
    }
}

if (isset($_SESSION['professorID']) && isset($_SESSION['profPassword'])) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css files/create-class7.css">
        <title>Document</title>
    </head>

    <body>
        <?php include "../headers/prof_header_home.php"; ?>
        <form action="" method="post" id="inputs">
            <div class="wrapper">
                <div class="label">
                    <label for=""><b>Create Group</b></label>
                </div>

                <div class="class-name">
                    <label for=""><b>Capstone Title</b></label>
                    <!-- <input type="text" id="cName" name="title" required> -->
                    <textarea name="title" id="" cols="20" rows="4"></textarea required>
                </div>

                <div class="row">
                    <div class="col" id="semester">
                        <label for=""><b>Leader</b></label>
                        <select name="leader" id="sem">
                            <option value="">--Select Member--</option>
                            <?php
                            include('../config.php');
                            $program = mysqli_query($connect, "SELECT * FROM students WHERE blockID = '$GBlockID'");
                            while ($result = mysqli_fetch_array($program)) {
                            ?>
                                <option value="<?php echo $result['studentID'] ?>"><?php echo $result['studentID'] ?></option>
                            <?php } ?>
                        </select>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col" id="semester">
                        <label for=""><b>Member 1</b></label>
                        <select name="member1" id="sem">
                            <option value="">--Select Member--</option>
                            <?php
                            include('../config.php');
                            $program = mysqli_query($connect, "SELECT * FROM students WHERE blockID = '$GBlockID'");
                            while ($result = mysqli_fetch_array($program)) {
                            ?>
                                <option value="<?php echo $result['studentID'] ?>"><?php echo $result['studentID'] ?></option>
                            <?php } ?>
                        </select>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col" id="semester">
                        <label for=""><b>Member 2</b></label>
                        <select name="member2" id="sem">
                            <option value="">--Select Member--</option>
                            <?php
                            include('../config.php');
                            $program = mysqli_query($connect, "SELECT * FROM students WHERE blockID = '$GBlockID'");
                            while ($result = mysqli_fetch_array($program)) {
                            ?>
                                <option value="<?php echo $result['studentID'] ?>"><?php echo $result['studentID'] ?></option>
                            <?php } ?>
                        </select>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col" id="semester">
                        <label for=""><b>Member 3</b></label>
                        <select name="member3" id="sem">
                            <option value="">--Select Member--</option>
                            <?php
                            include('../config.php');
                            $program = mysqli_query($connect, "SELECT * FROM students WHERE blockID = '$GBlockID'");
                            while ($result = mysqli_fetch_array($program)) {
                            ?>
                                <option value="<?php echo $result['studentID'] ?>"><?php echo $result['studentID'] ?></option>
                            <?php } ?>
                        </select>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col" id="semester">
                        <label for=""><b>Member 4</b></label>
                        <select name="member4" id="sem">
                            <option value="">--Select Member--</option>
                            <?php
                            include('../config.php');
                            $program = mysqli_query($connect, "SELECT * FROM students WHERE blockID = '$GBlockID'");
                            while ($result = mysqli_fetch_array($program)) {
                            ?>
                                <option value="<?php echo $result['studentID'] ?>"><?php echo $result['studentID'] ?></option>
                            <?php } ?>
                        </select>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col" id="semester">
                        <label for=""><b>Member 5</b></label>
                        <select name="member5" id="sem">
                            <option value="">--Select Member--</option>
                            <?php
                            include('../config.php');
                            $program = mysqli_query($connect, "SELECT * FROM students WHERE blockID = '$GBlockID'");
                            while ($result = mysqli_fetch_array($program)) {
                            ?>
                                <option value="<?php echo $result['studentID'] ?>"><?php echo $result['studentID'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

            </div>
            <button type="submit" name="createbtn" id="createbtn">Create</button>
            <a href="addStudents.php?blockID=<?php echo urlencode($GBlockID); ?>" class="cancelbtn">Cancel
            <?php $_SESSION['IDblock'] = "" ?>
            </a>
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