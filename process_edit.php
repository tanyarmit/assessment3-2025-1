<?php
session_start();
include('includes/functions.inc');

if (isset($_SESSION['username']) && !empty($_POST['gameid'])) {
    require_once('includes/db_connect.inc');
    $sql = "SELECT * FROM games WHERE gameid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $gameid);
    $gameid = validateInput($_POST['gameid']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        foreach ($_POST as $key => $val) {
            $$key = validateInput($val); //get values our of array
        }
        $oldimage = $row['image'];
        $image = is_uploaded_file($_FILES["image"]["tmp_name"]) ? 'images/' . $_FILES['image']['name'] : $oldimage;

        $sql = "UPDATE games SET gamename = ?, type = ?, description = ?, caption = ?, price = ?, image= ?, platform = ? WHERE gameid=?";
        echo $sql;
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ssssdssi", $gamename, $type, $description, $caption, $price, $image, $platform, $gameid);

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            if (is_uploaded_file($_FILES["image"]["tmp_name"]) && $image != $oldimage) {

                move_uploaded_file($_FILES["image"]["tmp_name"], $image);
                if (file_exists($oldimage)) {
                    unlink($oldimage);
                }
            }
            $_SESSION['usrmsg'] = "The game was updated";
        } else {
            $_SESSION['err'] = "The game was NOT updated";
        }
    } else {
        $_SESSION['err'] = "An error has occured!";
    }
} else {
    $_SESSION['err'] = "You have no privileges to edit entries";
}
header("Location:details.php?id=$gameid");
exit(0);
