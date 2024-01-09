<?php
include "../config.php";
session_start();
if (isset($_SESSION['professorID']) && isset($_SESSION['profPassword'])) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css files/admin-header4.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Professor Approval</title>
    </head>
    <style>
            .center {
                text-align: center;
                margin-top: 50px;
            }

             th{
                
                color: white;
                text-align: center;
                background-color: #3D3B40 !important;
            }

            
            td {
                text-align: center;
            }

            #logout {
                border: none;
                background-color: white;
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

        <nav class="navbar navbar-expand navbar-dark ">
            <div class="container-fluid">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mb-2 mb-lg-0" id="left-nav">
                        <li class="nav-item">
                            <a href="../manager/professor_home.php" class="nav-link ">Class</a>
                        </li>
                        <li class="nav-item">
                            <a href="../manager/submission.php" class="nav-link ">Submission</a>
                        </li>
                        <li class="nav-item">
                            <a href="../manager/inventory.php" class="nav-link">Inventory</a>
                        </li>
                        <li class="nav-item">
                            <a href="../manager/archive.php" class="nav-link active">Archive</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <?php
        if (isset($_POST['restore'])) {
            $UpCapstoneID = $_POST['capstoneID'];

            $select = "UPDATE uploaded_capstones SET status = 'approved' WHERE capstoneID = '$UpCapstoneID'";
            $result = mysqli_query($connect, $select);
            echo "<script>alert('Capstone Restored!')</script>";
        }
        if (isset($_POST['view'])) {
            $_SESSION['pdf'] = $_POST['view'];
        }
        ?>
        <div class="container-fluid">
        <table class="table table-bordered">
            <thead class="thead">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Date Created</th>
                    <th>File Name</th>
                    <th>Date File Uploaded</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM uploaded_capstones WHERE status = 'archived' ORDER BY capstoneID ASC";
                $result = mysqli_query($connect, $query);
                while ($row = mysqli_fetch_array($result)) {
                    $pdf = $row['fileContent'];
                ?>
                    <tr>
                        <td><?php echo $row['capstoneID']; ?></td>
                        <td><?php echo $row['capstoneTitle']; ?></td>
                        <td><?php echo $row['dateCreated']; ?></td>
                        <td><?php echo $row['fileContent']; ?></td>
                        <td><?php echo $row['dateFileUploaded']; ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="capstoneID" value="<?php echo $row['capstoneID']; ?>">
                                <div class="btn-group" role="group">
                                    <button type='submit' name="view" value="<?php echo $row['fileContent']; ?>" class='btn btn-primary btn-sm rounded'><a href="pdfViewer.php?title=<?php echo urlencode($pdf); ?>" target="_blank" style="text-decoration: none; color: white;" rel="noopener noreferrer">View</a></button>
                                    <button type='submit' name="restore" value="Restore" class='btn btn-success btn-sm mx-2 rounded'>Restore</button>
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
    header("Refresh: 3; url='../login/manager-login.php'");
}
?>