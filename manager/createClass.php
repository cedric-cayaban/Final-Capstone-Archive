<?php
include "../config.php";
session_start();
if (isset($_SESSION['professorID']) && isset($_SESSION['profPassword'])) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css files/create-class2.css">
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
                        <label for=""><b>Year</b></label>
                        <select name="year" id="yr">
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
    if (isset($_POST['createbtn'])) {
        $className = $_POST['className'];
        $semester = $_POST['semester'];
        $year = $_POST['year'];
        $professorID = $_SESSION['professorID'];


        $sql = "INSERT INTO `block`(`blockName`, `professorID`, `semester`, `year`) VALUES ('$className','$professorID','$semester','$year')";
        $result = mysqli_query($connect, $sql);
        echo '<script>alert("Block has been created successfully!")</script>';
        header("Refresh: 1; url='addStudents.php'");
    }
    ?>

<?php
} else {
    session_destroy();
    echo "<script>alert('Please log in first.')</script>";
    header("Refresh: 3; url='../login/manager-login.php'");
}
?>