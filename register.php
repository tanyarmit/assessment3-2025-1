<?php
$title = "register";
include('includes/header.inc');
include('includes/nav.inc');
?>
<main class="mx-auto">
    <h1 class="mb-3 mt-3"><?= $title ?></h1>
    <form action="process_register.php" method="post">
        <div class="mb-3 mt-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control w-50">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control w-50">
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-primary" value="Register">
        </div>
    </form>
</main>
<?php
include('includes/footer.inc');
?>