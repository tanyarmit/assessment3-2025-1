<?php
$id = $_GET['id'];
$page = 'delete record';
include_once('includes/header.inc');
include_once('includes/nav.inc');

if (isset($_SESSION['username']) && !empty($_GET['id'])) {
    include_once('includes/db_connect.inc');

    //check if the imageis set, if it is not set, retrieve the imagefrom the database
    if (!empty($_GET['image'])) {
        $image = $_GET['image'];
    } else {
        $sql = "select * from games where gameid=?";
        $stmt = $conn->prepare($sql);
        $id = $_GET['id'];
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $image = $row['image'];
            }
        }
    }

    $sql = "delete from games where gameid = ?";
?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div>
                <?php
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    echo "<div>";
                    echo "<h2>Bye bye!</h2>";
                    echo "<p class='alert alert-success'>Record deleted<p>";
                    echo "<p>We hate to see an game record go, but we are sure you had a good reason for deleting it.</p>";
                    echo "<p>Maybe you can fill the gap by adding a new and exciting animal?<p>";
                    echo "</div>";

                    echo "<div class='col-sm-6 col-md-6 col-lg-4'>";
                    echo "<div class='card justify-content-center hovereffect'>";
                    echo "<div class='square'>";
                    echo "<img class='image-fluid' src='images/delete.jpg' alt='rocket leaving'>";
                    echo "</div>";
                    echo "<div class='card-link'>";
                    echo "<h4>Add a new game</h4>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";


                    if (file_exists($image)) {
                        unlink($image);
                    }
                } else {
                    echo "<div>";
                    echo "<h2>Oops!</h2>";
                    echo "<p class='alert alert-danger'>Record NOT deleted<p>";
                    echo "<p>Something went wrong and we could not delete the record.<p>";
                    echo "</div>";
                }
            }
                ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once('includes/footer.inc');
    ?>