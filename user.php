<?php
$page = "user games";
include_once('includes/header.inc');
include_once('includes/nav.inc');
include_once('includes/functions.inc'); ?>
<main class="mx-4 mt-4">
    <?php if (!empty($_GET['username'])) {

        require_once('includes/db_connect.inc');
        $sql = "SELECT * FROM games WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $username = validateInput($_GET['username']);
        $stmt->execute();
        $result = $stmt->get_result();

        //loop through the table of results printing each row
        if ($result->num_rows > 0) {
            // output data of each row
            print "<h2 class=page-name>$username's Collection</h2>";
            while ($row = $result->fetch_assoc()) {
                foreach ($row as $key => $val) {
                    $$key = $val; //get values our of array
                } ?>
                <div class='row mt-3'>
                    <div class="col-12 col-sm-6">
                        <img src='<?= $row['image'] ?>' class='img-fluid details_image' alt='<?= $row['caption'] ?>'>
                        <div class='row mt-3'>
                            <div class="col-4"><i class='material-icons'>request_quote</i>
                                <p class='icon-text'><?= ($row['price'] == 0) ? 'Free' : '$' . number_format($row['price'], 2); ?></p>
                            </div>
                            <div class="col-4"><i class="material-icons">category</i>
                                <p class='icon-text'><?= $row['type'] ?></p>
                            </div>
                            <div class="col-4"><i class='material-icons'>devices</i>
                                <p class='icon-text'><?= $row['platform'] ?></p>
                            </div>
                            <?php if (isset($_SESSION['username'])) { ?>
                                <div class="ms-3 mb-3">
                                    <a href="edit.php?id=<?= $row['gameid'] ?>" class="btn btn-primary" role="button">Edit</a>&nbsp;
                                    <a href="delete_confirm.php?id=<?= $row['gameid'] ?>" class="btn btn-danger" role="button">Delete</a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h1><?= $row['gamename'] ?></h1>
                        <p><?= $row['description'] ?></p>
                    </div>
                </div>
    <?php }
        } else {
            print "0 results";
        }
    } else {
        print "No games to display";
    } ?>
</main>
<?php include_once('includes/footer.inc'); ?>