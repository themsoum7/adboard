<?php require_once("header.php"); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/form.css">
    <link rel="stylesheet" href="../styles/formsettings.css">
    <title>Document</title>
</head>
<body>
<?php
require_once("../db_config.php");

$conn = new mysqli(servername, username, password, dbName);

$sql = "SELECT * FROM `user` WHERE userID =".$_SESSION["userID"];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <form method="post" enctype="multipart/form-data" class="registration-form center-content">
            <h1 class="title">Settings</h1>

            <div class="form-group">
                <label for="exampleInputEmail1">First name</label>
                <input type="text" name="firstname" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp"
                       placeholder="Enter name" value="<?php echo $row["firstname"]?>" required>
            </div>

            <div class="form-group">
                        <label for="exampleInputEmail1">Last name</label>
                        <input type="text" name="lastname" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp"
                               placeholder="Enter last name" value="<?php echo $row["lastname"]?>" required>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Country</label>
                <input type="text" name="country" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp"
                       placeholder="Enter country" value="<?php echo $row["country"]?>" required>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">City</label>
                <input type="text" name="city" class="form-control" id="exampleInputPassword1"
                       placeholder="Enter city" value="<?php echo $row["city"]?>" required>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Phone number</label>
                <input type="tel" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                       placeholder="Enter phone number" value="<?php echo $row["phone"]?>" required>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Birthday date</label>
                <input type="date" name="bday" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                       placeholder="Enter birthday date" value="<?php echo $row["bday"]?>" required>
            </div>
            Choose your sex:<br>
            <div class="sex-form">
                Male
                <input type="radio" name="sex" id="" <?php if($row["sex"] == "male") { echo "checked";}?> value="male">
            </div>

            <div class="sex-form">
                Female
                <input type="radio" name="sex" id="" <?php if($row["sex"] == "female") { echo "checked";}?> value="female">
            </div>

            <div class="form-group form-height">
                <label for="exampleInputEmail1">Choose your avatar:</label>
                <input class="avatar-img form-control" type="file" name="cover" id="" value="<?php echo $row["avatarUrl"]?>"><br>
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

    $sql = "SELECT * FROM `user` WHERE userID = ".$_SESSION["userID"];
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc()) {
            if (($_SESSION["isAuthorized"] == true)){
                unlink($row["avatarUrl"]);
            }
        }
    }

    $fileDest = "../avatars/".$_FILES["cover"]["name"];
//    $fileDest = "uploads/".microtime().$_FILES["cover"]["name"];
    move_uploaded_file($_FILES["cover"]["tmp_name"], $fileDest);

    $stmt = $conn->prepare("UPDATE `user` SET `country` = ?, `city` = ?, `phone` = ?, `bday` = ?, `sex` = ?, `avatarUrl` = ?, `firstname` = ?, `lastname` = ? WHERE userID = ?");
    $stmt->bind_param("ssssssssi", $country, $city, $phone, $bday, $sex, $avatarUrl, $firstname, $lastname, $userid);

    $country = $_POST["country"];
    $city = $_POST["city"];
    $phone = $_POST["phone"];
    $bday = $_POST["bday"];
    $sex = $_POST["sex"];
    $avatarUrl = $fileDest;
//    if ($fileDest == $row["imageUrl"])
//    {
//        $avatarUrl = $fileDest;
//    }
//    else
//    {
//        $avatarUrl = $_POST["imageUrl"];
//    }
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $userid = $_SESSION["userID"];

    $stmt->execute();

    $stmt->close();
    $conn->close();
}
?>
<?php require_once("footer.php");?>
