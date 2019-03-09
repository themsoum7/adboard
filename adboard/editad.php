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
<?php
require_once("../db_config.php");

$conn = new mysqli(servername, username, password, dbName);

$sql = "SELECT * FROM `ad` WHERE adID =".$_GET["id"];
$result = $conn->query($sql);

if ($result->num_rows > 0)
{
    while ($row = $result->fetch_assoc())
    {
    ?>
        <form method="post" enctype="multipart/form-data" class="registration-form center-content">
            <h1 class="title">Edit Ad</h1>

            <div class="form-group">
                <input type="file" name="cover" class="form-control inputfile" id="file" aria-describedby="emailHelp" required>
                <label for="file">Ad Cover</label>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Ad Title</label>
                <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                       placeholder="Enter title ad title" value="<?php echo $row["name"]?>" required>
            </div>

            <div class="form-group">
                <label for="file">Ad Description</label>
                <textarea name="body" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                          placeholder="Ad description..." required><?php echo $row["desc"]?></textarea>
            </div>

            <div class="form-group">
                <input type="hidden" name="postdate" value="<?php echo $row["postdate"]?>" class="form-control"
                       id="exampleInputEmail1" aria-describedby="emailHelp"
                       required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php
    }
}
?>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("../db_config.php");

    $conn = new mysqli(servername, username, password, dbName);

    $fileDest = "../uploads/".$_FILES["cover"]["name"];
//    $fileDest = "uploads/".microtime().$_FILES["cover"]["name"];
    move_uploaded_file($_FILES["cover"]["tmp_name"], $fileDest);

    $stmt = $conn->prepare("UPDATE `ad` SET `imageUrl` = ?, `desc` = ?, `name` = ?, `postdate` = ? WHERE adID = ?");
    $stmt->bind_param("ssssi", $imageUrl, $desc, $name, $postdate, $adID);

    $imageUrl = $fileDest;
    $desc = $_POST["body"];
    $name = $_POST["title"];
    $postdate = $_POST["postdate"];
    $adID = $_GET["id"];

    $stmt->execute();

    $stmt->close();
    $conn->close();
}
?>
<?php require_once("footer.php"); ?>

