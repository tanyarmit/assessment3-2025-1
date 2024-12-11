<?php
$page = 'games';
include_once('includes/header.inc');
include_once('includes/nav.inc');
?>
<main>

    <div class="displayCenter pt-3">
        <h3>Discover GamesRUs</h3>
        <p>Located in the heart of the city, ShopRUs is a haven for both casual gamers and dedicated enthusiasts
            alike. Established
            in 2010, the store has grown into a community hub, offering a wide array of video games, board games,
            consoles, and
            gaming accessories. From the latest AAA titles to indie gems, ShopRUs prides itself on maintaining a
            diverse and
            carefully curated selection. Whether you're looking for the hottest new release or a nostalgic classic,
            the
            knowledgeable staff at ShopRUs is always ready to assist with recommendations or troubleshooting any
            gaming-related
            queries.</p>
    </div>
    <div class="row pb-5">
        <div class="col-12 col-sm-4"><img src="images/games.jpeg" alt="Running Games" class="img-fluid"></div>
        <div class="col-12 col-sm-8">
            <table class="table table-bordered table-responsive-md table-striped" id="list">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Platforms</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //connect
                    include('includes/db_connect.inc');

                    $sql = "select * from games";

                    $result = $conn->query($sql);
                    //loop through the table of results printing each row
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_array()) {
                            $price = ($row['price'] == 0) ? 'Free' : '$' . number_format($row['price'], 2);
                            print "<tr>\n";
                            print "<td><a href='details.php?id={$row['gameid']}'>{$row['gamename']}</a></td>\n";
                            print "<td>{$row['type']}</td>\n";
                            print "<td>$price</td>\n";
                            print "<td>{$row['platform']}</td>\n";
                            print "</tr>\n";
                        }
                    } else {
                        echo "<tr><td colspan=4>0 results</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php
include_once('includes/footer.inc');
?>