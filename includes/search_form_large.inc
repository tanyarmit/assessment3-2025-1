<div class="container">
    <form action="search.php" method="get">
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-12 p-0 mt-3">
                <input type="text" name="search" class="form-control search-slt" placeholder="I am looking for ...">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 p-0 mt-3">
                <?php
                //connect
                $sql = "SELECT distinct type FROM games";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    print "<select name='type' class='form-control'>";
                    print "<option value=''>Select type...</option>";
                    while ($row = $result->fetch_assoc()) {
                        $display = ucwords($row['type']);
                        print "<option value='{$row['type']}'>$display</option>";
                    }
                    print "</select>";
                } ?>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12 p-0 mt-3">
                <button type="submit" class="btn btn-color">Search</button>
            </div>
        </div>
    </form>
</div>