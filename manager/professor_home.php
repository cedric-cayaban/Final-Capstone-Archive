<?php
include "../config.php";
session_start();
if (isset($_SESSION['professorID']) && isset($_SESSION['profPassword'])) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css files/prof-home4.css">
        <script src="https://kit.fontawesome.com/979ee355d9.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <title>Capstone Archive</title>
    </head>

    <body>
        <?php include "../headers/prof_header_home.php"; ?>

       

        <!-- <a href="createClass.php">Create Class</a> -->
        <div class="container-fluid">

            <div class="row mt-5" id="top">
                <div class="col" id="title-section">
                    <label for="" id="title"><b>Capstone Project (Classes)</b></label>
                </div>
                <div class="col" id="create-section">
                    <a href="createClass.php" id="create">
                        <i class="fa-solid fa-user-plus fa-lg"></i>
                        Create Class
                    </a>
                </div>
            </div>

            <!-- ETO OUTPUT PAG NAG CREATE -->
            <div class="container">
                <div class="row justify-content-center">
                    <?php
                    $sql = "SELECT * FROM `block` WHERE `professorID` = '" . $_SESSION['professorID'] . "'";
                    $result = mysqli_query($connect, $sql);

                    $blocks = mysqli_fetch_all($result, MYSQLI_ASSOC);

                    $blocksCount = count($blocks);
                    $columnsPerRow = 4;

                    for ($i = 0; $i < $blocksCount; $i += $columnsPerRow) {
                    ?>
                        <div class="row" id="classes">
                            <?php
                            for ($j = $i; $j < $i + $columnsPerRow && $j < $blocksCount; $j++) {
                                $blockID = $blocks[$j]['blockID'];
                            ?>
                                <div class="col-md-3" id="output">
                                    <a href="addStudents.php?blockID=<?php echo urlencode($blockID); ?>" class="box">
                                        <?php $_SESSION['IDblock'] = "" ?>
                                        <label for=""  class="box-label"><?php echo $blocks[$j]['blockName'] ?></label>
                                        <label for=""  class="box-label"><?php echo $blocks[$j]['year'] ?></label>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>

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