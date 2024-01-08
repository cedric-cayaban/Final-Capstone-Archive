<?php
    include "../config.php";
  

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



require __DIR__.'/vendor/autoload.php';

use Orhanerday\OpenAi\OpenAi;

$openAiKey = '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'; 
$openAi = new OpenAi($openAiKey);

$prompt = isset($_POST['proposal_title']) ? $_POST['proposal_title'] : '';

$prompt2 = isset($_POST['proposal_desc']) ? $_POST['proposal_desc'] : '';

$responseText1 = "";
$responseText2 = "";
$responseText3 = ""; // Third response

if (!empty($prompt)) {
    $complete = $openAi->completion([
        'model' => 'text-davinci-003',
        'prompt' => 'Give me 10 titles related to ' . $prompt,
        'temperature' => 0.9,
        'max_tokens' => 150,
        'frequency_penalty' => 0,
        'presence_penalty' => 0.6,
    ]);

    $response = json_decode($complete, true);

    if (isset($response["choices"]) && !empty($response["choices"])) {
        $responseText1 = $response["choices"][0]["text"];
    } else {
        $responseText1 = "No valid response received from OpenAI for prompt 1.";
    }
} else {
    $responseText1 = "Please provide a prompt.";
}

if (!empty($prompt2)) {
    $complete2 = $openAi->completion([
        'model' => 'text-davinci-003',
        'prompt' => "Rate this proposal project by uniqueness". '"'. $prompt2.'"' . " result should be percent of uniqueness, do not include the percentage sign. Just output the number and it should be a whole number, no further explanation is needed", 
        'temperature' => 0.9,
        'max_tokens' => 150,
        'frequency_penalty' => 0,
        'presence_penalty' => 0.6,
    ]);

    $response2 = json_decode($complete2, true);

    if (isset($response2["choices"]) && !empty($response2["choices"])) {
        $responseText2 = $response2["choices"][0]["text"];
    } else {
        $responseText2 = "No valid response received from OpenAI for prompt 2.";
    }
} else {
    $responseText2 = "Please provide a prompt for the second request.";
}

// Third request
$openAiKey3 = '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'; // Replace with your third API key
$openAi3 = new OpenAi($openAiKey3);

$prompt3 = $prompt;

if (!empty($prompt3)) {
    $complete3 = $openAi3->completion([
        'model' => 'text-davinci-003',
        'prompt' =>  'How many of the titles are related to this project'. $prompt3.'this are the list of titles '.$valuesString .'result should be list of all titles related ' ,
        'temperature' => 0.9,
        'max_tokens' => 150,
        'frequency_penalty' => 0,
        'presence_penalty' => 0.6,
    ]);

    $response3 = json_decode($complete3, true);

    if (isset($response3["choices"]) && !empty($response3["choices"])) {
        $responseText3 = $response3["choices"][0]["text"];
    } else {
        $responseText3 = "No valid response received from OpenAI for prompt 3.";
    }
} else {
    $responseText3 = "Please provide a prompt for the third request.";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css files/checker3.css">
    <link rel="stylesheet" href="../css files/bilog.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Document</title>
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

                    <ul class="navbar-nav" id="right-nav">
                        <li class="nav-item">
                            <a href="uploads.php" class="nav-link ">
                                <i class="fas fa-user fa"></i>&nbsp;&nbsp;Project
                            </a>
                        </li>
                    </ul>
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
                    stroke-dasharray="<?php echo "$responseText2";  ?>, 100"
                    d="M18 2.0845
                    a 15.9155 15.9155 0 0 1 0 31.831
                    a 15.9155 15.9155 0 0 1 0 -31.831"
                />
                <text x="18" y="20.35" class="percentage"><?php echo "$responseText2"."%"; ?></text>
                </svg>
                <div style="text-align:center;   margin-right: 8%; font-size:">
                    <label for="" ><h3>Uniqueness</h3></label> 
                </div>
            </div>
        </div>

        <div class="recommend">
            <label for="">Title Recommendation</label>
            <ul>
            <li><p><?= $responseText1 ?></p></li>
        <?php $responseTexts1 ?>
            </ul>
        </div>
        <div class="recommend">
            <label for="">Title </label>
            <ul>
            <li><p><?= $responseText3 ?></p></li>
        <?php $responseTexts3 ?>
            </ul>
        </div>

   

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
</body>
</html>

