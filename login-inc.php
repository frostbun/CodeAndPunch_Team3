<?php
if (isset($_POST['submit'])){
    require 'database.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
      header("Location: ../login.php?error=emptyFields");
      exit();
    } else {
      $sql  ="SELECT * FROM User WHERE username=?";
      $statement = mysqli_stmt_init($connect);
      if (!mysqli_stmt_prepare($statement,$sql)) {
        header("Location: ../login.php?error=sqlError");
        exit();
      } else {
        mysqli_stmt_bind_param($statement,"s",$username);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);

        if ($row = mysqli_fetch_assoc($result)) {
            $passCheck = password_verify($password,$row['password']);
            if ($passCheck == false) {
              header("Location: ../login.php?error=WrongPassword");
              exit();
            } else if ($passCheck == true) {
                session_start();
                $_SESSION['sessionId'] =$row['id'];
                $_SESSION['sessionUser'] =$row['username'];
                header("Location: ../login.php?sucess=LoggedIn");
                exit();
            } else {
              header("Location: ../login.php?error=WrongPassword");
              exit();
            }
        } else {
          header("Location: ../login.php?error=noUser");
          exit();
        }
      }
    }

} else {
  header("Location: ../login.php?error=accessForbiden");
  exit();
}
 ?>

