<?php
include "../config.php";
session_start();

$_SESSION['IDblock'] == "" ? $blockID = urldecode($_GET['blockID']) : $blockID = $_SESSION['IDblock'];

if (isset($_SESSION['professorID']) && isset($_SESSION['profPassword'])) { ?>

    <?php
    if (isset($_POST['addMemberbtn'])) {
        $studentID = $_POST['studentID'];
        $lastName = $_POST['lastName'];
        $firstName = $_POST['firstName'];
        $middleName = $_POST['middleName'];

        $select = "SELECT * FROM students WHERE studentID = '$studentID'";
        $result = mysqli_query($connect, $select);

        if (mysqli_num_rows($result) > 0) {
            echo '<script>alert("ID Number is already registered!")</script>';
        } else {
            $sql = "INSERT INTO `students`(`studentID`, `firstName`, `lastName`, `middleName`, `blockID`) VALUES ('$studentID','$lastName','$firstName','$middleName', '$blockID')";
            $result = mysqli_query($connect, $sql);
            if ($result) {
                echo '<script>alert("Student has been added successfully!")</script>';
            } else {
                echo "<script>alert('Error!')</script>";
            }
        }
    }

    if (isset($_POST['removebtn'])) {
        $studentID = $_POST['studentID'];

        $select = "DELETE FROM students WHERE studentID = '$studentID'";
        $result = mysqli_query($connect, $select);
        echo "<script>alert('Student has been removed from this class.')</script>";
    }

    if (isset($_POST['deleteClassbtn'])) {
        $select = "DELETE FROM students WHERE blockID = '$blockID'";
        $result = mysqli_query($connect, $select);

        $select = "DELETE FROM block WHERE blockID = '$blockID'";
        $result = mysqli_query($connect, $select);
        echo "<script>alert('Class has been deleted successfully.')</script>";
        header("Refresh: 0; url='professor_home.php'");
    }

    if (isset($_POST['addGroupsbtn'])) {
        $_SESSION['GBlockID'] = $blockID;
        header("Refresh: 0; url='addGroups.php'");
    }
    if (isset($_POST['viewGroupsbtn'])) {
        $_SESSION['GBlockID'] = $blockID;
        header("Refresh: 0; url='viewGroups.php'");
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css files/add-students3.css">
        <title>Document</title>
    </head>

    <body>
        <?php include "../headers/prof_header_home.php"; ?>


        <div class="container-fluid" id="contents">
            <form action="" method="post">

                <?php
                $sql = "SELECT * FROM block WHERE blockID = '$blockID'";
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_array($result)) { ?>
                    <div class="row">

                        <div class="row">
                            <div class="col-md" id="block-sec">
                                <label for="" id="blocks"><b>BSIT <?php echo $row['blockName']; ?></b></label>
                            </div>
                            <div class="col-md" id="sem-sec">
                                <label for="" id="sem"><b><?php echo $row['semester']; ?></b></label>
                                <label for="" id="year"> <b>A.Y. <?php echo $row['year']; ?></b></label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <label for="" id="fixed">Add members to this class</label>
                            </div>
                            <div class="col-md" id="delete-sec">
                                <button type="submit" class="btn btn-danger" id="delete" name="deleteClassbtn">Delete Class</button>
                            </div>
                        </div>
            </form>


        </div>
    <?php } ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-8" id="id-sec">
                <label for="" id="infos">ID Number</label>
                <input type="text" name="studentID" id="stud-id" required>
            </div>
        </div>

        <div class="row" id="row2">

            <div class="col-md" id="lName-sec">
                <label for="" id="infos">Last Name</label>
                <input type="text" name="lastName" id="lName" required>
            </div>

            <div class="col-md" id="fname-sec">
                <label for="" id="infos">First Name</label>
                <input type="text" name="firstName" id="fName" required>
            </div>

            <div class="col-md" id="mName-sec">
                <label for="" id="infos">Middle Name</label>
                <input type="text" name="middleName" id="mName" required>
            </div>

            <div class="col-md-2" id="add-sec">
                <button type="submit" class="btn btn-primary" id="add" name="addMemberbtn">Add Member</button>
            </div>

        </div>


    </form>

    <form action="" method="post" class="lowest-part">
        <button type="submit" class="btn btn-primary" id="delete" name="viewGroupsbtn" style="color: white;">View Groups</button>
        <button type="submit" class="btn btn-primary" id="delete" name="addGroupsbtn" style="color: white;">Add Groups</button>
    </form>




    <table class="table table-bordered">
        <thead class="thead-dark">
            <th scope="col">ID Number</th>
            <th scope="col">Last Name</th>
            <th scope="col">First Name</th>
            <th scope="col">Middle Name</th>
            <th scope="col">Action</th>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM students WHERE blockID = '$blockID'";
            $result = mysqli_query($connect, $query);
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $row['studentID']; ?></td>
                    <td><?php echo $row['lastName']; ?></td>
                    <td><?php echo $row['firstName']; ?></td>
                    <td><?php echo $row['middleName']; ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="studentID" value="<?php echo $row['studentID']; ?>">
                            <div class="btn-group" role="group">
                                <button type='submit' name="removebtn" value="remove" class='btn btn-danger btn-sm'>Remove</button>
                            </div>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
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