<?php
$page = "search";
include_once('includes/header.inc');
include_once('includes/nav.inc');
include_once('includes/db_connect.inc');

?>

<div class="container mt-3">
    <?php include_once('includes/search_form_large.inc'); ?>
</div>

<div class="container mt-3">
    <div class="row">
        <?php

        $search = (isset($_GET['search']) && !empty($_GET['search'])) ? "%{$_GET['search']}%" : null;
        $type = (isset($_GET['type']) && !empty($_GET['type'])) ? "%{$_GET['type']}%" : null;
        if ($search !== null || $type !== null) {

            $sql = "SELECT gameid, gamename, image, caption FROM games WHERE 1=1";
            $params = [];
            $datatypes = '';

            if ($search !== null) {
                $sql .= " AND (gamename LIKE ? OR description LIKE ? OR caption LIKE ?)";
                array_push($params, $search, $search, $search);
                $datatypes .= 'sss';
            }

            if ($type !== null) {
                $sql .= " AND type LIKE ?";
                array_push($params, $type);
                $datatypes .= 's';
            }
            $stmt = $conn->prepare($sql);
            $stmt->bind_param($datatypes, ...$params);

            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $result = $conn->query("SELECT gameid, gamename, image, caption FROM games");
        }
        if ($result) {
            foreach ($result as $row) {
                foreach ($row as $key => $val) {
                    $$key = $val; //get values our of array
                }
                echo "<div class='col-sm-12 col-md-6 col-lg-4 mb-3'>";
                echo "<div class='card justify-content-center hovereffect'>";
                echo "<div>";
                echo "<img class='card-img-top' src='$image' alt='$caption'>";
                echo "</div>";
                /*                 echo "<div class='overlay'>";
                echo "<p><a href='details.php?id={$row['gameid']}'><i class='material-icons md-48'>search</i></a></p>";
                echo "<p>";
                echo "<a href='details.php?id={$row['gameid']}'>Discover more!</a>";
                echo "</p>";
                echo "</div>"; */
                echo "<div class='card-link'>";
                echo "<a href='details.php?id={$row['gameid']}'><h4>$gamename</h4></a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>Oops! it seems that we don't have what you are looking for.</p>";
        }
        ?>
    </div>
</div>

<?php
include_once('includes/footer.inc');
?>