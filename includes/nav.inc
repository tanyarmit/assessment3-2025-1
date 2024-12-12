<!-- start of navigation -->

<nav class="navbar navbar-expand-sm navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="images/logo.png" alt="logo" class="img-fluid" width="60" height="60">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item <?php echo ($page == "home" ? "active" : "") ?>">
                    <a class="nav-link fs-4" href="index.php">Home</a>
                </li>
                <li class="nav-item <?php echo ($page == "games" ? "active" : "") ?>">
                    <a class="nav-link fs-4" href="games.php">Games</a>
                </li>
                <li class="nav-item <?php echo ($page == "gallery" ? "active" : "") ?>">
                    <a class="nav-link fs-4" href="gallery.php">Gallery</a>
                </li>
                <?php if (!isset($_SESSION['username'])) { ?>
                    <li class="nav-item <?php echo ($page == "register" ? "active" : "") ?>">
                        <a class="nav-link fs-4" href="register.php">Register</a>
                    </li>
                    <li class="nav-item <?php echo ($page == "login" ? "active" : "") ?>">
                        <a class="nav-link fs-4" href="login.php">Login</a>
                    </li>
                <?php } ?>
                <?php if (!empty($_SESSION['username'])) { ?>
                    <li class="nav-item <?php echo ($page == "add" ? "active" : "") ?>">
                        <a class="nav-link fs-4" href="add.php">Add more</a>
                    </li>
                    <li class="nav-item <?php echo ($page == "logout" ? "active" : "") ?>">
                        <a class="nav-link fs-4" href="logout.php">Logout</a>
                    </li>
                <?php } ?>
            </ul>
            <?php include_once('search_form_small.inc'); ?>
        </div>
    </div>
</nav>
<!-- end of navigation -->
<?php
if (isset($_SESSION['usrmsg'])) { ?>
    <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill" />
        </svg>
        <div>
            <?php print $_SESSION['usrmsg']; ?>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
    unset($_SESSION['usrmsg']);
} ?>

<?php
if (isset($_SESSION['err'])) { ?>
    <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
            <use xlink:href="#exclamation-triangle-fill" />
        </svg>
        <?php print $_SESSION['err']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
    unset($_SESSION['err']);
}
?>