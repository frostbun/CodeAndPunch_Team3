<?php
require_once "include/header.php";
?>
<div>
<h1>LOGIN</h1>
<p>Don't have account? <a href="register.php">Register here</a></p>
<form  action="include/login-inc.php" method="post">
  <input type="text" name="username" placeholder="Username">
  <input type="password" name="password" placeholder="Password">
  <button type="submit" name="submit">LOGIN</button>
</form>
</div>
<?php
require_once "include/footer.php";
?>
