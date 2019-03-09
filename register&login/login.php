<?php
session_start();
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="../styles/formsettings.css">
<form method="post" enctype="multipart/form-data" class="registration-form">
    <h1 class="title">Login</h1>

    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
               placeholder="Enter email" required>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
               placeholder="Enter Password" required>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    require_once("passwordHasher.php");
    require_once("../db_config.php");

    $login = $_POST["email"];
    $password = $_POST["password"];
    $passwordHash = passwordHash($password);

    $conn = new mysqli(servername, username, password, dbName);

    $sql = "SELECT * FROM `user`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            if ($row["email"] == $login && $row["password"] == $passwordHash)
            {
                $_SESSION["isAuthorized"] = true;
                $_SESSION["userID"] = $row["userID"];
                $_SESSION["email"] = $row["email"];
                echo "success";
                header('Location: ../adboard/adBoard.php');
            }
        }
    }
    $conn->close();
}
?>