<?php require_once "header.php" ?>

<div class="container text-center">
    <?php
        if(isset($_SESSION["user"])) {
            echo "<h1>You are logged in as $_SESSION[user]</h1>";
        }
        else {
            echo "<h1>You are logged out</h1>";
        }
    ?>
    <img class="img-fluid rounded" src="/bomman.jpg">
</div>

<?php require_once "footer.php" ?>