<?php
include "../config.php";
session_start();
$userID = $_SESSION['adminID'];
        $sql = "SELECT * FROM admin WHERE adminID = '$userID'";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            // Fetch data
            while ($row = $result->fetch_assoc()) {
                // Access data using $row['column1'], $row['column2'], etc.
                $username = $row['firstName'];
            }} 
if (isset($_SESSION['adminID']) && isset($_SESSION['adminPassword'])) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css files/admin-header4.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <title>Professor Approval</title>
    </head>
    <style>
        th{
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
       
        <form action="inventory.php" method="post" class="system-name">
            <label for="" id="sys-name">Welcome Admin! <?php echo $username;?></label>
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
                        <a href="../admin/admin_home.php" class="nav-link">Users</a>
                    </li>
                    <li class="nav-item">
                        <a href="../admin/admin-managers.php" class="nav-link">Managers</a>
                    </li>
                    <li class="nav-item">
                        <a href="../admin/inventory.php" class="nav-link active">Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a href="../admin/archive.php" class="nav-link">Archive</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>       

        <?php
        if (isset($_POST['archive'])) {
            $UpCapstoneID = $_POST['capstoneID'];

            $select = "UPDATE uploaded_capstones SET status = 'archived' WHERE capstoneID = '$UpCapstoneID'";
            $result = mysqli_query($connect, $select);

            echo "<script>alert('Capstone Archived!')</script>";
        }
        if (isset($_POST['view'])) {
            $_SESSION['pdf'] = $_POST['view'];
            header("Refresh: 1; url='pdfViewer.php'");
        }
        ?>

        <div class="container-fluid">
        <div class="col" id="inputs">

        <br>
                 <a href="../admin/admin_uploads.php" class="btn btn-primary"   >Add Capstone</a>
                 </div>
            <table class="table table-bordered">
                        <thead class="thead-dark">
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
                            $query = "SELECT * FROM uploaded_capstones WHERE status = 'approved' ORDER BY capstoneID DESC";
                            $result = mysqli_query($connect, $query);
                            while ($row = mysqli_fetch_array($result)) {
                                $pdf = $row['fileContent'];
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
                                                <button type='submit' name="view" value="<?php echo $row['fileContent']; ?>" class='btn btn-primary btn-sm rounded'><a href="pdfViewer.php?title=<?php echo urlencode($pdf); ?>" target="_blank" style="text-decoration: none; color: white;" rel="noopener noreferrer">View</a></button>
                                                <button type='submit' name="archive" value="Archived" class='btn btn-success btn-sm mx-2 rounded'>Archive</button>
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
    header("Refresh: 3; url='../login/admin-login.php'");
}
?>