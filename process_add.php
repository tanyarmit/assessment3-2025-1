<?php
include_once('includes/header.inc');
include_once('includes/nav.inc');

if (!empty($_POST['gamename'])) {
    include('includes/db_connect.inc');
    foreach ($_POST as $key => $val) {
        $$key = $val;
    }
    $image = 'images/' . $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];
    //creating an sql variable to store data in database
    $sql = "INSERT INTO games (gamename, description, image, caption, type, price, platform, username) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    // if ($stmt === false) {
    //     die('Prepare Error: ' . $conn->error);
    // }
    $bind = $stmt->bind_param("sssssdss", $gamename, $description, $image, $caption, $type, $price, $platform, $_SESSION['username']);
    // if ($bind === false) {
    //     die('Bind Error: ' . $stmt->error);
    // }
    $execute = $stmt->execute();
    // if ($execute === false) {
    //     die('Execute Error: ' . $stmt->error);
    // }

    if ($stmt->affected_rows > 0) {
        if (!empty($_FILES['image'])) {
            move_uploaded_file($temp, $image);
        }
    } else {
        $error = "An error has occured!";
    }
    $conn->close();
} else {
    $error = "No data submitted";
}
?>
<!-- end of navigation -->
<main>
    <?php
    if (!empty($error)) {
        echo $error;
    } else {
        echo "<p>A new record was added successfully</p>";
    }
    ?>
</main>
<?php
include_once('includes/footer.inc');
?>