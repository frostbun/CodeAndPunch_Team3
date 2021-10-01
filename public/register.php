<?php
require_once "include/header.php";
?>
<div>
<h1>REGISTER</h1>
<p>Already have account? <a href="login.php">Login here</a></p>
<form  action="include/register-inc.php" method="post">
  <input type="text" name="username" placeholder="Username">
  <input type="password" name="password" placeholder="Password">
  <input type="password" name="ConfirmPassword" placeholder="Confirm Password">
  <button type="submit" name="submit">REGISTER</button>
</form>
</div>
<?php
require_once "include/footer.php";
?>
