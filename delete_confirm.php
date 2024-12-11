<?php
$id = $_GET['id'];
$page = 'delete confirm';
include_once('includes/header.inc');
include_once('includes/nav.inc');
include_once('includes/functions.inc');

if (isset($_SESSION['username']) && !empty($_GET['id'])) {
    $sql = "select * from games where gameid = {$_GET['id']}";
    require_once('includes/db_connect.inc');
    $sql = "SELECT * FROM games WHERE gameid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $gameid);
    $gameid = validateInput($_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {

        while ($row = mysqli_fetch_array($result)) {
            echo "<div class='container mt-4'>";
            echo "<div class='row'>";
            echo "<div class='col-lg-12'>";
            echo "<div>";
            echo "<h2>Are you sure you want to delete this record?</h2>";
            echo "<div class='col-sm-6 col-md-6 col-lg-4'>";
            echo "<div class='card justify-content-center hovereffect'>";
            echo "<div>";
            echo "<img class='image-fluid' src='{$row['image']}' alt='{$row['caption']}'>";
            echo "</div>";
            echo "<div class='card-link'>";
            echo "<h4>{$row['gamename']}</h4>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "<div class='row'>";
            echo "<div class='col-sm-6 col-md-6 col-lg-4 form-buttons mb-3 mt-3'>";
            echo "<a href='details.php?id={$row['gameid']}' class='btn btn-primary me-2 role='button'>Cancel</a>";
            echo "<a href='delete.php?id={$row['gameid']}' class='btn btn-danger' role='button'>Delete</a>";
            echo "</div>";
            echo "</div>";




            echo "</div>";
        }
    }
} else {
    echo "<p>Either no record to delete or you have no permission for it</p>";
}

include_once('includes/footer.inc');
