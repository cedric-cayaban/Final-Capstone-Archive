<?php
include "../config.php";
session_start();

if (isset($_POST['createbtn'])) {
    $className = $_POST['className'];
    $semester = $_POST['semester'];
    $startYear = $_POST['startYear'];
    $endYear = $_POST['endYear'];
    if($startYear == $endYear){
        $year = $startYear;
    } else {
        $year = $startYear . '-' . $endYear;
    }
    $professorID = $_SESSION['professorID'];
    $blockID = "";
    if($className == ""){
        echo '<script>alert("Please enter a class name.")</script>';
    } else {
        $select = "SELECT * FROM block WHERE blockName = '$className' AND semester = '$semester' AND year = '$year'";
        $result = mysqli_query($connect, $select);

        if (mysqli_num_rows($result) > 0) {
            echo '<script>alert("Class already exists!")</script>';
        } else {
            $sql = "INSERT INTO `block`(`blockName`, `professorID`, `semester`, `year`) VALUES ('$className','$professorID','$semester','$year')";
            $result = mysqli_query($connect, $sql);

            $select = "SELECT * FROM block WHERE blockName = '$className' AND semester = '$semester' AND year = '$year'";
            $res = mysqli_query($connect, $select);
            while ($row = mysqli_fetch_array($res)){
                $_SESSION['IDblock'] = $row['blockID'];
            }
            echo '<script>alert("Block has been created successfully!")</script>';
            header("Refresh: 1; url='addStudents.php");
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
                    <label for=""><b>Create Class</b></label>
                </div>

                <div class="class-name">
                    <label for=""><b>Class Name</b></label>
                    <input type="text" id="cName" name="className">
                </div>

                <div class="row">

                    <div class="col" id="semester">
                        <label for=""><b>Class Semester</b></label>
                        <select name="semester" id="sem">
                            <option value="1st Semester">1st Semester</option>
                            <option value="2nd Semester">2nd Semester</option>
                        </select>
                    </div>

                    <div class="col" id="year">
                        <label for=""><b>Start Year</b></label>
                        <select name="startYear" id="yr">
                            <?php
                            $today = new DateTime("now", new DateTimeZone('Asia/Manila'));
                            $dateTime = $today->format('Y');
                            $selectedYear = isset($_GET['start']) ? $_GET['start'] : 'start';
                            for ($year = $dateTime; $year >= 2000; $year--) {
                                $selected = ($year == $selectedYear) ? 'selected' : '';
                                echo "<option value=\"$year\" $selected>$year</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col" id="year">
                        <label for=""><b>End Year</b></label>
                        <select name="endYear" id="yr">
                            <?php
                            $today = new DateTime("now", new DateTimeZone('Asia/Manila'));
                            $dateTime = $today->format('Y');
                            $selectedYear = isset($_GET['start']) ? $_GET['start'] : 'start';
                            for ($year = $dateTime; $year >= 2000; $year--) {
                                $selected = ($year == $selectedYear) ? 'selected' : '';
                                echo "<option value=\"$year\" $selected>$year</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" name="createbtn" id="createbtn">Create</button>
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