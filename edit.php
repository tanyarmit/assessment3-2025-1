<?php
$page = 'edit';
include_once('includes/header.inc');
include_once('includes/nav.inc');
include_once('includes/functions.inc');
?>
<?php if (isset($_SESSION['username'])) { ?>
    <!-- end of navigation -->
    <main class="mx-auto mt-4">
        <?php if (isset($_SESSION['username']) && !empty($_GET['id'])) {
            require_once('includes/db_connect.inc');
            $sql = "SELECT * FROM games WHERE gameid = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $gameid);
            $gameid = validateInput($_GET['id']);
            $stmt->execute();
            $result = $stmt->get_result();

            //loop through the table of results printing each row
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
                <div class="displayCenter">
                    <h3>Edit game</h3>
                </div>
                <form method="post" action="process_edit.php" enctype="multipart/form-data" id="form">
                    <input type="hidden" name="gameid" value="<?= $row['gameid'] ?>">
                    <div>
                        <label class="required">Game Name:</label>
                        <input type="text" class="form-control" name="gamename" placeholder="Provide a name for the game" value="<?= $row['gamename'] ?>" required>
                    </div>
                    <div>
                        <label class="required">Type:</label>
                        <input type="text" class="form-control" name="type" placeholder="Provide a type for the game" value="<?= $row['type'] ?>" required>
                    </div>
                    <div>
                        <label class="required">Description</label>
                        <textarea class="form-control" cols="50" rows="3" name="description" placeholder="Describe the game briefly" required><?= $row['description'] ?></textarea>
                    </div>
                    <div>
                        <div>
                            <label class="required">Select an Image:</label>
                            <input type="file" class="form-control-file" name="image">
                            <span>max image size: 500px. Current image <?= $row['image'] ?></span>
                        </div>
                        <div>
                            <label class="required">Image Caption:</label>
                            <input type="text" class="form-control" name="caption" placeholder="describe the image in one word" value="<?= $row['caption'] ?>" required>
                        </div>
                    </div>
                    <div>
                        <div>
                            <label class="required">Price:</label>
                            <input type="number" step="0.01" class="form-control" name="price"
                                placeholder="price of a game in months" value="<?= $row['price'] ?>" required>
                        </div>
                        <div>
                            <label class="required">Platform:</label>
                            <input type="text" class="form-control" name="platform" placeholder="Platform of the game" value="<?= $row['platform'] ?>" required>
                        </div>
                    </div>
                    <div class="submit_button">
                        <button type="submit" id="submit" name="submit" value="submit" class="page-btn"><span
                                class="material-icons">add_task</span>submit</button>
                        <button type="reset" id="clear" name="clear" value="clear" class="page-btn"><span
                                class="material-icons">clear</span>clear</button>
                    </div>
                </form>
        <?php
            }
        } ?>
    </main>
<?php } ?>
<?php include_once('includes/footer.inc');
?>