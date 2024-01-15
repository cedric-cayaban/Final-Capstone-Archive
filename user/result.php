<?php

    include "../config.php";
    session_start();
    $userID = $_SESSION['userID'];
$sql = "SELECT * FROM user WHERE userID = '$userID'";
$result = mysqli_query($connect, $sql);
if ($result) {
    // Fetch data
    while ($row = $result->fetch_assoc()) {
        // Access data using $row['column1'], $row['column2'], etc.
        $username = $row['firstName'];
    }} 

// Define the SQL query
$sql = "SELECT capstoneTitle FROM `uploaded_capstones`";

// Execute the query
$result = mysqli_query($connect, $sql);


// Check if the query was successful
if ($result) {
    // Fetch the data and concatenate values into a string with numbers and newlines
    $valuesString = '';
    $counter = 1;
    while ($row = $result->fetch_assoc()) {
        $valuesString .= $counter . ". " . $row['capstoneTitle'] . "<br>"; // Use <br> for line breaks
        $counter++;
    }

    // Remove the trailing <br> if there are values
    if (!empty($valuesString)) {
        $valuesString = rtrim($valuesString, "<br>");
    } else {
        $valuesString = "No values found in the database.";
    }

    
    // Free the result set
    $result->free();
} else {
    echo "Error: " . $connect->error;
}





// Close the database connection
$connect->close();

$prompt = isset($_POST['proposal_title']) ? $_POST['proposal_title'] : '';

$prompt2 = isset($_POST['proposal_desc']) ? $_POST['proposal_desc'] : '';






require __DIR__.'/vendor/autoload.php';

use Orhanerday\OpenAi\OpenAi;

$open_ai_key = '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';

$open_ai = new OpenAi($open_ai_key);



$complete = $open_ai->completion([
    'model' => 'gpt-3.5-turbo-instruct',
    'prompt' => "Rate this proposal project" . "'". $prompt2."'" ."  uniqueness result should be percent of uniqueness, do not include the percentage sign. Just output the number and it should be a whole number, no further explanation is needed", //prompt 1
    'temperature' => 0.9,
    'max_tokens' => 500,
    'frequency_penalty' => 0,
    'presence_penalty' => 0.6,
]);

$response = json_decode($complete, true);
$response = $response["choices"][0]["text"];

$complete1 = $open_ai->completion([
    'model' => 'gpt-3.5-turbo-instruct',
    'prompt' => "Give me 10 capstone titles like to this title" . $prompt, 
    'temperature' => 0.9,
    'max_tokens' => 500,
    'frequency_penalty' => 0,
    'presence_penalty' => 0.6,
]);

$response1 = json_decode($complete1, true);
$response1 = $response1["choices"][0]["text"];

$complete2 = $open_ai->completion([
    'model' => 'gpt-3.5-turbo-instruct',
    'prompt' => "'How many of the titles are related to this project'. $prompt.'this are the list of titles '.$valuesString .'result should be list of all titles related '", //promt2
    'temperature' => 0.9,
    'max_tokens' => 500,
    'frequency_penalty' => 0,
    'presence_penalty' => 0.6,
]);

$response2 = json_decode($complete2, true);
$response2 = $response2["choices"][0]["text"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css files/checker4.css">
    <link rel="stylesheet" href="../css files/bilog.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css files/logout.css">
    <title>Document</title>
    <style>


    </style>
</head>
<body>

<?php
        if (isset($_POST['logout'])) {
            session_destroy();
            header("Refresh: 1; url='../login/login.php'");
            echo "<script>alert('Logged out successfully.')</script>";
        }
        ?>
        <header class="d-flex justify-content-between align-items-center">
            <div class="top-section">
                <img class="logo" src="../images/finalnlogo.svg" alt="PSU Logo" style="max-width: 300px; margin-right: 10px;">
                <!-- <label><b>PANGASINAN STATE UNIVERSITY</b></label> -->
            </div>

            <form action="#" method="post" class="system-name">
                <label for="" id="sys-name">Welcome, <?php echo $username;?>!</label>
                <button type="submit"  name="logout" id="logout" class="new-button" >
                            <img style= "width: 25px;
                        border-radius: 0px;
                        float: left;"src="../images/logout_icon.png"alt="Logout">
                        
                    <div class="new-logout">LOGOUT</div>

                </button >
            </form>
        </header>

        <nav class="navbar navbar-expand navbar-dark" id="navigation">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navi">

                    <ul class="navbar-nav mb-2 mb-lg-0" id="left-nav">

                        <li class="nav-item">
                            <a href="user-home.php" class="nav-link ">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="checkers.php" class="nav-link active">Checker</a>
                        </li>

                    </ul>

                    <?php
        include "../config.php";
        $userID = $_SESSION['userID'];
        $sql = "SELECT * FROM groups WHERE leaderID = '$userID'";
        $result = mysqli_query($connect, $sql);
        if ($row = mysqli_num_rows($result) > 0) { ?>
                <ul class="navbar-nav" id="right-nav">
                    <li class="nav-item">
                        <a href="uploads.php" class="nav-link">
                            <i class="fas fa-user fa"></i>&nbsp;&nbsp;Project
                        </a>
                    </li>
                </ul>
                <?php } ?>
                </div>
            </div>
        </nav>

 
        <div style="display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0;">
            <div class="single-chart" >
                <svg viewBox="0 0 45 45" class="circular-chart blue">
                <path class="circle-bg"
                    d="M18 2.0845
                    a 15.9155 15.9155 0 0 1 0 31.831
                    a 15.9155 15.9155 0 0 1 0 -31.831"
                />
                <path class="circle"
                    stroke-dasharray="<?php echo "$response";  ?>, 100"
                    d="M18 2.0845
                    a 15.9155 15.9155 0 0 1 0 31.831
                    a 15.9155 15.9155 0 0 1 0 -31.831"
                />
                <text x="18" y="20.35" class="percentage"><?php echo "$response"."%"; ?></text>
                </svg>
                <div style="text-align:center;   margin-right: 8%; font-size: 1.1rem;"> <!-- font size not yet specified -->
                    <label for="" ><h3>Uniqueness</h3></label> 
                </div>
            </div>
        </div>

        <div class="recommend" style=' white-space: break-spaces;'>
            <label for="">Title Recommendation</label>
            <ul>
            <li><p><?= $response1 ?></p></li>
        <?php $response1 ?>
            </ul>
        </div>
        <div class="recommend" style=' white-space: break-spaces;'>
            <label for="">Title Related to Capstone Inventory </label>
            <ul>
            <li><p><?= $response2 ?></p></li>
        <?php $response2 ?>
            </ul>
        </div>

   

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
</body>
</html>

