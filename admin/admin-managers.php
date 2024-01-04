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
    <link rel="stylesheet" href="../css files/admin-manager.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>
</head>

<style>
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
<?php
if (isset($_POST['logout'])) {
    session_destroy();
    header("Refresh: 1; url='../login/manager-login.php'");
    echo "<script>alert('Logged out successfully.')</script>";
}
?>
<body>
    <header class="d-flex justify-content-between align-items-center">
        <div class="top-section">
            <img class="logo" src="../images/psuLogo.svg" alt="PSU Logo" style="max-width: 100px; margin-right: 10px;">
            <label><b>PANGASINAN STATE UNIVERSITY</b></label>
        </div>
       
        <form action="#" method="post" class="system-name">
            <label for="" id="sys-name">IT CAPSTONE PROJECT INVENTORY</label>
            <button type="submit" name="logout" id="logout" class="btn">
                <img src="../images/power.png" style="width: 40px; border-radius: 50px; border: none;" alt="Logout">
            </button>
        </form>
    </header>

    <nav class="navbar navbar-expand navbar-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mb-2 mb-lg-0" id="left-nav">
                    <li class="nav-item">
                        <a href="../admin/admin_home.php" class="nav-link ">Users</a>
                    </li>
                    <li class="nav-item">
                        <a href="../admin/admin-managers.php" class="nav-link active">Managers</a>
                    </li>
                    <li class="nav-item">
                        <a href="../admin/inventory.php" class="nav-link">Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a href="../admin/archive.php" class="nav-link">Archive</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <?php
        if (isset($_POST['addManagerbtn'])) {
            $professorID = $_POST['professorID'];
            $password = $_POST['password'];
            $lastName = $_POST['lastName'];
            $firstName = $_POST['firstName'];
            $middleName = $_POST['middleName'];
            $adminID = $_SESSION['adminID'];

            $select = "SELECT * FROM professor WHERE professorID = '$professorID'";
            $result = mysqli_query($connect, $select);

            if (mysqli_num_rows($result) > 0) {
                echo '<script>alert("ID Number is already registered!")</script>';
            } else {
                $sql = "INSERT INTO `professor`(`professorID`, `adminID`, `password`, `lastName`, `firstName`, `middleName`) VALUES ('$professorID','$adminID','$password','$lastName','$firstName','$middleName')";
                $result = mysqli_query($connect, $sql);
                if ($result) {
                    echo '<script>alert("Professor\'s account has been added successfully!")</script>';
                } else {
                    echo "<script>alert('Error!')</script>";
                }
            }
        }
        if(isset($_POST['delete'])){
            $pID = $_POST['delete'];
            $select = "DELETE FROM professor WHERE professorID = '$pID'";
            $result = mysqli_query($connect, $select);
            echo "<script>alert('Professor\s account has been deleted successfully.')</script>";
        }
        ?>
        <form action="admin-managers.php" method="post">
        <div class="row">
            
                <div class="col" id="inputs">
                    
                    <input type="text" class="form-control"name="professorID" id="input-form" placeholder="Professor ID" required>
                 </div> 
                 
                 <div class="col" id="inputs">
                    
                    <input type="text" class="form-control" name="password" id="input-form" placeholder="Password" required>
                 </div>    

                 <div class="col" id="inputs">
                    
                    <input type="text" class="form-control" name="lastName" id="input-form" placeholder="Last name" required>
                 </div>    

                 <div class="col" id="inputs">
                    
                    <input type="text" class="form-control" name="firstName" id="input-form" placeholder="First name" required>
                 </div>    

                 <div class="col" id="inputs">
                
                    <input type="text" class="form-control" name="middleName" id="input-form" placeholder="Middle name" required>
                 </div>    
                 <div class="col" id="inputs">
                 <button type="submit" class="btn btn-primary" name="addManagerbtn" id="" >Add Manager</button>
                 </div>
                           
        </div>
        </form>
       
       
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Professor ID</th>
                    <th>Password</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM professor";
                $result = mysqli_query($connect, $query);
                while ($row = mysqli_fetch_array($result)) {
                    $pID = $row['professorID'];
                ?>
                    <tr>
                        <td><?php echo $row['professorID']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                        <td><?php echo $row['lastName']; ?></td>
                        <td><?php echo $row['firstName']; ?></td>
                        <td><?php echo $row['middleName']; ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="userID" value="<?php echo $row['professorID']; ?>">
                                <div class="btn-group" role="group">
                                    <button type='submit' name="edit" value="<?php echo $pID; ?>" class='btn btn-primary btn-sm rounded'><a href="editProf.php?title=<?php echo urlencode($pID);?>" style="text-decoration: none; color: white;" rel="noopener noreferrer">Edit</a></button>
                                    <button type='submit' name="delete" value="<?php echo $row['professorID']; ?>" class='btn btn-danger btn-sm mx-1 rounded'>Delete</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
} else {
    session_destroy();
    echo "<script>alert('Please log in first.')</script>";
    header("Refresh: 1; url='../login/admin-login.php'");
}
?>