<?php
require "database.php";
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password= $_POST['password'];
  $passRewrite = $_POST['ConfirmPassword'];
  if (empty($username) || empty($password || empty($passRewrite))) {
    header("Location: ../register.php?error=emptyFields");
    exit();
  } else if (!preg_match("/^[a-zA-Z0-9]*/","$username")) {
    header("Location: ../register.php?error=invalidUsername");
    exit();
  } else if ($password != $passRewrite){
    header("Location: ../register.php?error=passwordDoNotMatch");
    exit();
  } else {
    $sql = "SELECT * FROM User WHERE username=?";
    $statement = mysqli_stmt_init($connect);
    if (!mysqli_stmt_prepare($sql,$statement)) {
      header("Location: ../register.php?error=sqlError");
      exit();
    } else {
      mysqli_stmt_bind_param($statement,"s",$username);
      mysqli_stmt_execute($statement);
      mysqli_stmt_store_result($statement);
      $rowCount=mysqli_stmt_num_rows($statement);
      if ($rowCount > 0 ) {
        header("Location: ../register.php?error=usernameTaken");
        exit();
      } else {
        $sql = "INSERT INTO User (username,password) VALUES (?,?)";
        $statement=mysqli_stmt_init($connect);
        if (!mysqli_stmt_prepare($sql,$statement)) {
          header("Location: ../register.php?error=sqlError");
          exit();
        } else {
          mysqli_stmt_bind_param($statement,"ss",$username);
          mysqli_stmt_execute($statement);
          header("Location: ../register.php?succes=registered");
          exit();
        }
      }
    }
  }
  mysqli_stmt_close($statement);
  mysqli_close($connect);
} else {
  header("Location: ../register.php?error=accessForbiden");
  exit();
}

 ?>
