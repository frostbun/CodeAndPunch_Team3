<?php
    require_once "header.php";
?>

<?php
    if (isset($_SESSION['sessionId'])) {
        echo "You are logged in!";
    }
    else {
        echo "<h1>Home</h1>";
    }
?>

<?php
    require_once "footer.php";
?>