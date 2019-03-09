<?php require_once("header.php"); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/form.css">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/formsettings.css">
    <title>Document</title>
</head>
<body>
<!--    <form method="post" enctype="multipart/form-data" class="new-notice">-->
<!--        <input class="notice-img" type="file" name="cover" id="" required><br>-->
<!--        <input class="notice-title" type="text" name="title" id="" placeholder="Enter your notice title here..." required><br>-->
<!--        <textarea class="notice-body" name="body" id="" placeholder="Enter your notice here..." required></textarea><br>-->
<!--        <input type="hidden" name="postdate" value="--><?php //echo date("Y-m-d H:i:s")?><!--"><br>-->
<!--        <button class="submit-button" type="submit">Submit</button>-->
<!--    </form>-->
<form method="post" enctype="multipart/form-data" class="registration-form center-content">
    <h1 class="title">Create Your Ad</h1>

    <div class="form-group">
        <input type="file" name="cover" class="form-control inputfile" id="file" aria-describedby="emailHelp"
               required>
        <label for="file">Ad Cover</label>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Ad Title</label>
        <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
               placeholder="Enter title ad title" required>
    </div>

    <div class="form-group">
        <label for="file">Ad Description</label>
        <textarea name="body" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                  placeholder="Ad description..." required></textarea>
    </div>

    <div class="form-group">
        <input type="hidden" name="postdate" value="<?php echo date("Y-m-d H:i:s") ?>" class="form-control"
               id="exampleInputEmail1" aria-describedby="emailHelp"
               required>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("../db_config.php");

    $conn = new mysqli(servername, username, password, dbName);

    $fileDest = "../uploads/" . $_FILES["cover"]["name"];
//    $fileDest = "uploads/".microtime().$_FILES["cover"]["name"];
    move_uploaded_file($_FILES["cover"]["tmp_name"], $fileDest);

    $stmt = $conn->prepare("INSERT INTO `ad` (`imageUrl`, `desc`, `name`, `postdate`, `userID`) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $imageUrl, $desc, $name, $postdate, $userID);

    $imageUrl = $fileDest;
    $desc = $_POST["body"];
    $name = $_POST["title"];
    $postdate = $_POST["postdate"];
    $userID = $_SESSION["userID"];
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
?>
<?php require_once("footer.php"); ?>

