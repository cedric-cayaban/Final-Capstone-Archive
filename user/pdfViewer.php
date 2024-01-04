<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Viewer</title>
</head>

<body>
    <?php
    include "../headers/documentPreview.php"; ?>
    <h3>Display Title</h3>
    <h5>display abstract here</h5>
    <?php
    if (isset($_GET['title'])) {
        $pdf = urldecode($_GET['title']);
        echo '
        <iframe src="../capstones/' . $pdf . '#toolbar=0" width="100%" height="900px"></iframe>
        ';
    }
    ?>
</body>

</html>