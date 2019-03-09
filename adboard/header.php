<?php session_start()?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/main.css">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light my-bg navbar-fixed-top navbar-fixed-top">
    <a class="navbar-brand nav-anchor btn-text" href="adBoard.php">Home</a>
    <a class="navbar-brand" href="#">
        <?php
        require_once("../db_config.php");

        $conn = new mysqli(servername, username, password, dbName);

        $stmt = $conn->prepare("SELECT * FROM `user` WHERE userID = ?");
        $stmt->bind_param("s", $userid);
        $userid = $_SESSION["userID"];
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc()) {
                if (($_SESSION["isAuthorized"] == true)){
                    ?>
                    <img src="<?php echo $row["avatarUrl"]?>" style="width: 30px; border-radius: 20px; margin-right: 10px;"/>
                    <span style="cursor: default;"><?php echo $_SESSION["email"]?></span>
                    <?php
                }
            }
        }
        $stmt->close();
        $conn->close();
        ?>
    </a>
    <a class="navbar-brand nav-anchor btn-text" href="../register&login/logout.php">Logout</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
<!--    <div class="collapse navbar-collapse" id="navbarNav">-->
<!--        <ul class="navbar-nav">-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="#">Link 1 <span class="sr-only">(current)</span></a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="#">Link 2</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="#">Link 3</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="#">Link 4</a>-->
<!--            </li>-->
<!--        </ul>-->
<!--    </div>-->
</nav>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
