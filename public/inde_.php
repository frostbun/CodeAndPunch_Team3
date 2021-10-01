<?php
require_once "include/header.php";
?>
<img width="1600 px "src="picture/1.png">

<?php
if (isset($_SESSION['sessionId'])) {
  echo "You are logged in!";
} else {
  echo "Home";
}
 ?>

 <?php
 require_once "include/footer.php";
 ?>
