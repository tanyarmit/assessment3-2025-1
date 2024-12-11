<?php
$page = 'gallery';
include_once('includes/header.inc');
include_once('includes/nav.inc');
?>
<main class="mx-auto mt-4">
    <div class="displayCenter">
        <h3>GamesRUs has a lot to offer!</h3>
        <p>To cater to the rapidly changing gaming landscape, ShopRUs also provides trade-in services and pre-owned
            game sales,
            allowing gamers to exchange old titles for store credit or discounted purchases. Additionally, the store
            has a strong
            online presence, with a user-friendly website offering nationwide shipping, making it a go-to for
            customers who can't
            visit in person. Their loyalty program offers regular customers exclusive discounts, early access to
            sales, and
            invitations to members-only events.</p>

        <p>ShopRUs continues to evolve, staying ahead of trends in gaming and community engagement. With its
            commitment to
            providing the best gaming experience, it's no wonder ShopRUs is a staple for gamers, whether they're
            veterans of the
            craft or just picking up a controller for the first time.
        </p>
        <div class="container justify-content-center">
            <?php
            //connect
            include('includes/db_connect.inc');
            $sql = "SELECT distinct type FROM games";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $type = !empty($_GET['type']) ? $_GET['type'] : '';
                print "<select id='menu' onchange=thisMenu(); class='form-control'>";
                print "<option value=''>Select type...</option>";
                print "<option value='gallery.php'>All types</option>";
                while ($row = $result->fetch_assoc()) {
                    $type = str_replace(' ', '', $row['type']);
                    $query = urlencode($row['type']);
                    $display = ucwords($row['type']);
                    print "<option value='gallery.php?type=$query'>$display</option>";
                }
                print "</select>";
            }

            if (!empty($_GET['type'])) {
                $sql = "SELECT * FROM games WHERE type = ? ";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $type);
                $type = $_GET['type'];
                $stmt->execute();
                $result = $stmt->get_result();
            } else {
                $sql = "SELECT * FROM games";
                $result = $conn->query($sql);
            } ?>
            <div class="row">
                <?php
                //loop through the table of results printing each row
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_array()) { ?>
                        <div class='col-sm-12 col-md-6 col-lg-4 mb-3'>
                            <div class='card justify-content-center hovereffect'>
                                <div><img src='<?= $row['image'] ?>' alt='<?= $row['caption'] ?>'></div>
                                <div class='card-link'>
                                    <h4><a href='details.php?id=<?= $row['gameid'] ?>'><?= $row['gamename'] ?></a></h4>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </div>
</main>
<?php
include_once('includes/footer.inc');
?>