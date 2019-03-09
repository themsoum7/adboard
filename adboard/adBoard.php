<?php require_once("header.php");?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/createButton.css">
    <title>Document</title>
</head>
<body>
<div class="container-fluid">
    <div class="container-default">
        <button class="btn"><a class="btn-text" href="createAd.php">Create Ad</a></button>
    </div>

    <div class="container-dark">
        <button class="btn-dark"><a class="btn-text" href="checkAds.php">Check All Ads</a></button>
    </div>

    <div class="container-light">
        <button class="btn-light"><a class="btn-text" href="checkMyAds.php">Check My Ads</a></button>
    </div>

    <div class="container-new">
        <button class="btn-new"><a class="btn-text" href="profileSettings.php">Settings</a></button>
    </div>
</div>
</body>
</html>
<?php require_once("footer.php");?>
