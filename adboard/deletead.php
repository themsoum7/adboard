<?php require_once("header.php"); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/postsettings.css">
    <link rel="stylesheet" href="../styles/formsettings.css">
    <title>Document</title>
</head>
<body>
<form method="post" enctype="multipart/form-data" class="registration-form center-content middle-content">
    <h1 class="title large-title">Do you really want to delete this post?</h1
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary">
    </div>
</form>
</body>
</html>
<?php
require_once("../db_config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("../db_config.php");

    $conn = new mysqli(servername, username, password, dbName);

    $stmt = $conn->prepare("DELETE FROM `ad` WHERE adID = ?");
    $stmt->bind_param("i",  $adID);

    $adID = $_GET["id"];

    $stmt->execute();

    $stmt->close();
    $conn->close();
    header("Location: checkAds.php");
}
?>
<?php require_once("footer.php"); ?>

