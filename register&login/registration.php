<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="../styles/formsettings.css">
<form method="post" enctype="multipart/form-data" class="registration-form">
    <h1 class="title">Register</h1>

    <div class="form-group">
        <label for="exampleInputEmail1">First Name</label>
        <input type="text" name="firstname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
               placeholder="Enter first name" required>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Last Name</label>
        <input type="text" name="lastname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
               placeholder="Enter last name" required>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Phone number</label>
        <input type="tel" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
               placeholder="Enter phone number" required>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
               placeholder="Enter email" required>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
               placeholder="Enter password" required>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("passwordHasher.php");
    require_once("../db_config.php");

    $login = $_POST["email"];
    $password = $_POST["password"];

    $passwordHash = passwordHash($password);

    $conn = new mysqli(servername, username, password, dbName);

    $stmt = $conn->prepare("INSERT INTO `user` (`firstname`, `lastname`, `phone`, `email`, `password`) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstname, $lastname, $phone, $email, $pass);

    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $phone = $_POST["phone"];
    $email = $login;
    $pass = $passwordHash;
    $stmt->execute();

    $stmt->close();
    $conn->close();
    header("Location: login.php");
}
?>
