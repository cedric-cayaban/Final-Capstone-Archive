<?php
include "../config.php";
session_start();
$userID = $_SESSION['professorID'];
        $sql = "SELECT * FROM professor WHERE professorID = '$userID'";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            // Fetch data
            while ($row = $result->fetch_assoc()) {
                // Access data using $row['column1'], $row['column2'], etc.
                $username = $row['firstName'];
            }} 
if (isset($_SESSION['professorID']) && isset($_SESSION['profPassword'])) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css files/admin-header5.css">
        <link rel="stylesheet" href="../css files/logout.css">
        <script src="https://kit.fontawesome.com/979ee355d9.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            .center {
                text-align: center;
            }

            th{
                background-color: #3D3B40;
                color: white;
            }
            
            th,
            td {
                text-align: center;
            }

            #logout {
                border: none;
                margin-top: 2%;
            }

            table{
                margin-top: 1%;
            }
            .container-fluid{
            
            padding-left: 3%;
            padding-right: 3%;
        }
        </style>
        <title>Professor Approval</title>
    </head>
    <?php
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Refresh: 1; url='../login/login.php'");
        echo "<script>alert('Logged out successfully.')</script>";
    }
    ?>

    <body>
        
    <header class="d-flex justify-content-between align-items-center">
        <div class="top-section">
            <img class="logo" src="../images/finalnlogo.svg" alt="PSU Logo" style="max-width: 300px; margin-right: 10px;">
            <!-- <label><b>PANGASINAN STATE UNIVERSITY</b></label> -->
        </div>
       
        <form action="#" method="post" class="system-name">
            <label for="" id="sys-name">Welcome, Professor <?php echo $username;?>!</label>
            <button type="submit"  name="logout" id="logout" class="new-button" >
                            <img style= "width: 25px;
                        border-radius: 0px;
                        float: left;"src="../images/logout_icon.png"alt="Logout">
                        
                    <div class="new-logout">LOGOUT</div>

                </button >
        </form>
    </header>

    <nav class="navbar navbar-expand navbar-dark ">
        <div class="container-fluid">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mb-2 mb-lg-0" id="left-nav">
                    <li class="nav-item">
                        <a href="../manager/professor_home.php" class="nav-link ">Class</a>
                    </li>
                    <li class="nav-item">
                        <a href="../manager/submission.php" class="nav-link active">Submission</a>
                    </li>
                    <li class="nav-item">
                        <a href="../manager/inventory.php" class="nav-link">Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a href="../manager/archive.php" class="nav-link">Archive</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

        <?php
        if (isset($_POST['approve'])) {
            $UpCapstoneID = $_POST['capstoneID'];

            $select = "UPDATE uploaded_capstones SET status = 'approved' WHERE capstoneID = '$UpCapstoneID'";
            $result = mysqli_query($connect, $select);

            echo "<script>alert('Capstone Approved!')</script>";
            header("Refresh: 1; url='submission.php'");
        }
        if (isset($_POST['reject'])) {
            $UpCapstoneID = $_POST['capstoneID'];

            //delete file from folder
            $query = "SELECT * FROM uploaded_capstones WHERE capstoneID = '$UpCapstoneID'";
            $res = mysqli_query($connect, $query);
            while ($row = mysqli_fetch_array($res)) {
                // echo $row['FileContent'];
                unlink('../capstones/' . $row['fileContent']);
            }

            $select = "DELETE FROM uploaded_capstones WHERE capstoneID = '$UpCapstoneID'";
            $result = mysqli_query($connect, $select);
            echo "<script>alert('Capstone Rejected.')</script>";


            header("Refresh: 1; url='submission.php'");
        }
        ?>  
            <div class="container-fluid">
            <table class="table table-bordered">
                <thead class="thead">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Date Created</th>
                        <th>Uploaded By</th>
                        <th>Date File Uploaded</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM `uploaded_capstones` JOIN groups ON groups.leaderID = uploaded_capstones.userID WHERE groups.professorID = '".$userID."' AND uploaded_capstones.status = 'pending' ORDER BY capstoneID DESC;";
                    $result = mysqli_query($connect, $query);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row['capstoneID']; ?></td>
                            <td><?php echo $row['capstoneTitle']; ?></td>
                            <td><?php echo $row['dateCreated']; ?></td>
                            <td><?php echo $row['userID']; ?></td>
                            <td><?php echo $row['dateFileUploaded']; ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="capstoneID" value="<?php echo $row['capstoneID']; ?>">
                                    <div class="btn-group" role="group">
                                        <button type='submit' name="approve" value="Approve" class='btn btn-success btn-sm mx-2'>Accept</button>
                                        <button type='submit' name="reject" value="Reject" class='btn btn-danger btn-sm'>Reject</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
            

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>

<?php
} else {
    session_destroy();
    echo "<script>alert('Please log in first.')</script>";
    header("Refresh: 3; url='../login/login.php'");
}
?>