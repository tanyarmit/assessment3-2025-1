<?php
$page = 'home';
include_once('includes/header.inc');
include_once('includes/nav.inc');
require_once('includes/db_connect.inc');

$sql = "SELECT image, gamename FROM games ORDER BY gameid DESC LIMIT 4";
$result = $conn->query($sql);
$row = $result->fetch_all();
?>

<main class="homeMain pt-3 pb-3">
    <div class="row">
        <div class="carousel slide col-12 col-sm-6" id="homeCarousel" data-bs-ride="carousel">
            <!-- Indicators -->
            <div class="carousel-indicators">
                <?php for ($i = 0; $i < sizeof($row); $i++) {
                    if ($i == 0) {
                        $active = 'class="active"';
                    } else {
                        $active = '';
                    }
                ?>
                    <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="<?= $i ?>" <?= $active ?>></button>
                <?php } ?>
            </div>

            <!-- Wrapper for slides -->
            <div class="background-wrapper">
                <div class="carousel-inner">
                    <?php for ($i = 0; $i < sizeof($row); $i++) {
                        if ($i == 0) {
                            $active = 'active';
                        } else {
                            $active = '';
                        }
                    ?>
                        <div class="carousel-item <?= $active ?>">
                            <div class="d-flex justify-content-center">
                                <img src="<?= $row[$i][0] ?>" alt="<?= $row[0][1] ?>" class="img-fluid">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
        <div class="col-12 col-sm-6">
            <h1>GamesRUs</h1>
            <h2>The Ultimate Gaming Destination</h2>
        </div>
    </div>
    <div class="mt-4">
        <?php include_once('includes/search_form_large.inc'); ?>
        <div class="container mt-5">
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
        </div>
    </div>
</main>
<?php
include_once('includes/footer.inc');
?>