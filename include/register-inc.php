<?php
  if (isset($_POST['submit'])) {
    //Add database connection
    require 'database.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPass = $_POST['ConfirmPassword'];

    if (empty($username) || empty($password) || empty($confirmPass)  ) {
      header("Location: ../register.php?error=Emptyfields&username=".$username);
      exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*/","$username")) {
      header("Location: ../register.php?error=invalidUsername&username=".$username);
      exit();
    } else if ($password != $confirmPass) {
      header("Location: ../register.php?error=passwordDoNotMatch&username=".$username);
      exit();
    } else  {
        $sql = "SELECT username FROM User WHERE username=?";
        $statement = mysqli_stmt_init($connect);
        if (!mysqli_stmt_prepare($statement,$sql)) {
          header("Location: ../register.php?error=sqlError");
          exit();
        } else {
          mysqli_stmt_bind_param($statement,"s",$username);
          mysqli_stmt_execute($statement);
          mysqli_stmt_store_result($statement);
          $rowCount = mysqli_stmt_num_rows($statement);

          if ($rowCount > 0) {
            header("Location: ../register.php?error=usernameTaken");
            exit();
          } else {
            $sql = "INSERT INTO User (username,password) VALUES (?,?)";
            $statement = mysqli_stmt_init($connect);
            if (!mysqli_stmt_prepare($statement,$sql)) {
                header("Location: ../register.php?error=sqlError");
                exit();
              } else {
                  $hashedPass = password_hash($password,PASSWORD_DEFAULT);
                  mysqli_stmt_bind_param($statement,"ss",$username,$hashedPass);
                  mysqli_stmt_execute($statement);
                  header("Location: ../register.php?succes=registered");
                  exit();
              }
            }
          }
        }
        mysqli_stmt_close($statement);
        mysqli_close($connect);
      }
?>