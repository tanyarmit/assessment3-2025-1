<?php
$page = "add";
include_once('includes/header.inc');
include_once('includes/nav.inc');
?>
<main>
    <form method="post" action="process_add.php" enctype="multipart/form-data" id="form">
        <div class="displayCenter">
            <h3>Add a game</h3>
            <p>
                You can add a new game here
            </p>
        </div>
        <div>
            <label class="required">Game Name:</label>
            <input type="text" class="form-control" name="gamename" placeholder="Provide a name for the game"
                required>
        </div>
        <div>
            <div>
                <label class="required">Type:</label>
                <input type="text" class="form-control" name="type" placeholder="Provide a type for the game"
                    required>
            </div>
        </div>
        <div>
            <label class="required">Description</label>
            <textarea class="form-control" cols="50" rows="3" name="description"
                placeholder="Describe the game briefly" required></textarea>
        </div>
        <div>
            <div>
                <label class="required">Select an Image:</label>
                <input type="file" class="form-control-file" name="image" required>
                <span>max imagesize: 500px</span>
            </div>
            <div>
                <label class="required">imageCaption:</label>
                <input type="text" class="form-control" name="caption" placeholder="Describe the imagein one word"
                    required>
            </div>
        </div>
        <div>
            <div>
                <label class="required">Price:</label>
                <input type="number" step="0.01" class="form-control" name="price"
                    placeholder="price of a game in months" required>
            </div>
            <div>
                <label class="required">Platform:</label>
                <input type="text" class="form-control" name="platform" placeholder="Platform of the game" required>
            </div>
        </div>
        <div class="submit_button">
            <button type="submit" id="submit" name="submit" value="submit" class="page-btn"><span
                    class="material-icons">add_task</span>submit</button>
            <button type="reset" id="clear" name="clear" value="clear" class="page-btn"><span
                    class="material-icons">clear</span>clear</button>
        </div>
    </form>

</main>
<?php
include_once('includes/footer.inc');
?>