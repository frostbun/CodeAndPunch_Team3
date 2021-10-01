<?php
  $dbHost = "localhost";
  $dbUser="manh";
  $dbPass="manh6264";
  $dbName="webDemo";

  $connect = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName);

  if (!$connect) {
    die("Database connection fail");
  }
?>
