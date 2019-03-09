<?php require_once("header.php");?>
<link rel="stylesheet" href="../styles/postsettings.css">
<?php
require_once("../db_config.php");

$conn = new mysqli(servername, username, password, dbName);

$sql = "SELECT * FROM `ad` WHERE userID = ".$_SESSION["userID"]." ORDER BY postdate DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0)
{
    // output data of each row
    while($row = $result->fetch_assoc()) {
        ?>
        <div class="post-content">
            <h3><?php echo $row["name"]?></h3>
            <h6><?php echo "Posted on " . $row["postdate"]?></h6>
            <h5><?php echo $row["desc"]?></h5>
            <img class="post-image" src="<?php echo $row["imageUrl"]?>"/>
        <?php

        $stmt = $conn->prepare("SELECT * FROM `user` WHERE userID = ?");
        $stmt->bind_param("s", $userid);
        $userid = $row["userID"];
        $stmt->execute();

        $telresult = $stmt->get_result();

        if ($telresult->num_rows > 0)
        {
            // output data of each row
            while($row1 = $telresult->fetch_assoc())
            {
                ?>
                <h4><?php echo "Author: ".$row1["firstname"] . " " . $row1["lastname"]?></h4>
                <h4><?php echo "Tel: ".$row1["phone"]?></h4>
                <div class="buttons">
                    <a class="post-edit-button" href="editad.php?id=<?php echo $row["adID"]?>">Edit</a>
                    <a class="post-delete-button" href="deletead.php?id=<?php echo $row["adID"]?>">Delete</a>
                </div>
                </div>
                <?php
            }
        }
    }
}
$stmt->close();
$conn->close();
?>
<?php require_once("footer.php");?>
