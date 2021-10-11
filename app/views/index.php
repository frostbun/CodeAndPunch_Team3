<?php require_once "header.php" ?>

<div>
    <h1> <?php
        if(isset($_SESSION["user"])) {
            echo "You are logged in as $_SESSION[user]";
        }
        else {
            echo "You are logged out";
        }
    ?> </h1>
    <img src="/maxresdefault.jpg" width="1000"> 
</div>

<?php require_once "footer.php" ?>