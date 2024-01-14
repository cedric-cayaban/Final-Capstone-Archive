<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Viewer</title>
</head>

<body>
    <?php
    include "../headers/documentPreview.php"; 
    ?>  <div style=" margin-right: 150px;
    margin-left: 80px;">
    <?php
    if (isset($_GET['title'])) {


        include "../config.php";
        session_start();
        $title= $_GET['title'];
        $sql = "SELECT * FROM uploaded_capstones WHERE fileContent = '$title'";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            // Fetch data
            while ($row = $result->fetch_assoc()) {
                // Access data using $row['column1'], $row['column2'], etc.
                echo "<h1>".$row['capstoneTitle']."</h1>";
                echo "<h4 style='text-align: center; color: #1935DA;'>Abstract</h4>";
                echo "<h5>". $row['capstoneAbstract']."</h5>";
            }} 

           
            
            echo "<br>";
        $pdf = urldecode($_GET['title']);
        echo '
        <iframe src="../capstones/' . $pdf . '#toolbar=0" width="100%" height="900px"></iframe>
        ';
    }
    ?>
    </div>
</body>

</html>