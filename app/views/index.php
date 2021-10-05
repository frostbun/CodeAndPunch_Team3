<?php require_once "header.php" ?>

<div>
    <h1> <?php
        if(isset($_SESSION["sessionId"])) {
            echo "You are logged in as $_SESSION[sessionId]";
        }
        else {
            echo "You are logged out";
        }
    ?> </h1>
    <img src="/maxresdefault.jpg" width="1000"> 
</div>

<?php require_once "footer.php" ?>