<?php
$page = 'details';
include_once('includes/header.inc');
include_once('includes/nav.inc');
?>
<main>
    <?php if (!empty($_GET['id'])) {
        include_once('includes/db_connect.inc');

        $id = $_GET['id'];

        $sql = "select * from games where gameid = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $result = $stmt->get_result();


        if ($result->num_rows > 0) {

            while ($row = mysqli_fetch_array($result)) { ?>
                <div class='row mt-3'>
                    <div class="col-12 displayCenter"><img class="img-fluid" src='<?= $row['image'] ?>' alt='<?= $row['caption'] ?>'>
                    </div>
                </div>
                <div class='row mt-3 displayCenter'>
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
                <div class="col-12 displayCenter">
                    <h1><?= $row['gamename'] ?></h1>
                    <p><?= $row['description'] ?></p>
                </div>
    <?php }
        }
    }
    ?>
</main>
<?php
include_once('includes/footer.inc');
?>