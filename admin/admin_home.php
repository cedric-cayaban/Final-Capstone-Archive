<?php
include "../config.php";
session_start();
if (isset($_SESSION['adminID']) && isset($_SESSION['adminPassword'])) { ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css files/admin-header4.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>
</head>

    <style>
        tr th{
            padding: 10px;
        }
        tr{
        text-align: center;
    
        }

        table{
        margin-top: 1%;

        }

        .container-fluid{
            
            padding-left: 3%;
            padding-right: 3%;
        }

    </style>
<body>
    <?php include "../headers/admin_header_home.php";?>
    <?php
        if (isset($_POST['edit'])) {
            $_SESSION['editUser'] = $_POST['edit'];
        }
        if (isset($_POST['delete'])){
            $uID = $_POST['delete'];
            echo $uID;
            $select = "DELETE FROM user WHERE userID = '$uID'";
            $result = mysqli_query($connect, $select);
            echo "<script>alert('User has been deleted.')</script>";
        }
        ?>
        <div class="container-fluid">
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th>ID Number</th>
                    <th>Password</th>
                    <th>Major</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT `userID`, `password`, major.majorName as major, `lastName`, `firstName`, `middleName` FROM `user` JOIN major ON major.majorID = user.majorID;";
                $result = mysqli_query($connect, $query);
                while ($row = mysqli_fetch_array($result)) {
                    $uid = $row['userID'];
                ?>
                    <tr>
                        <td><?php echo $row['userID']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                        <td><?php echo $row['major']; ?></td>
                        <td><?php echo $row['lastName']; ?></td>
                        <td><?php echo $row['firstName']; ?></td>
                        <td><?php echo $row['middleName']; ?></td>
                        <td>
                            <form action="" method="post">
                                <div class="btn-group" role="group">
                                    
                                    <button type='submit' name="edit" value="<?php echo $uid; ?>" class='btn btn-primary btn-sm rounded'><a href="editUser.php?title=<?php echo urlencode($uid);?>" style="text-decoration: none; color: white;" rel="noopener noreferrer">Edit</a></button>
                                    <button type='submit' name="delete" value="<?php echo $row['userID']; ?>" class='btn btn-danger btn-sm mx-1 rounded'>Delete</button>
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
    header("Refresh: 1; url='../login/admin-login.php'");
}
?>