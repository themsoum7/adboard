<?php require_once("header.php"); ?>
<link rel="stylesheet" href="../styles/formsettings.css">
<link rel="stylesheet" href="../styles/postsettings.css">
<?php
require_once("../db_config.php");

$conn = new mysqli(servername, username, password, dbName);

$sql = "SELECT * FROM `ad` ORDER BY postdate DESC";
$result = $conn->query($sql);
?>
<h1 class="title" style="margin-top: 65px; width: 500px;">All posts</h1>
<?php

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
            ?>
            <div class="post-content">
            <h3><?php echo $row["name"] ?></h3>
            <p><?php echo "Posted on " . date_format(new DateTime($row["postdate"]), 'Y-m-d') ?></p>
            <h5><?php echo $row["desc"] ?></h5>
            <img class="post-image" src="<?php echo $row["imageUrl"] ?>"/>
            <?php
            $stmt = $conn->prepare("SELECT * FROM `user` WHERE userID = ?");
            $stmt->bind_param("s", $userid);
            $userid = $row["userID"];
            $stmt->execute();
            $telresult = $stmt->get_result();

            if ($telresult->num_rows > 0) {
                while ($row1 = $telresult->fetch_assoc()) {
                    ?>
                    <h4><?php echo "Author: " . $row1["firstname"] . " " . $row1["lastname"] ?></h4>
                    <h4><?php echo "Tel: " . $row1["phone"] ?></h4>
                    <?php
                    if ($_SESSION["userID"] == $row["userID"]) {
                        ?>
                        <div class="buttons">
                            <a class="post-edit-button" href="editad.php?id=<?php echo $row["adID"] ?>">Edit</a>
                            <a class="post-delete-button" href="deletead.php?id=<?php echo $row["adID"] ?>">Delete</a>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                    <?php
                }
            }

    }
}

$stmt->close();
$conn->close();
?>
<?php require_once("footer.php"); ?>
