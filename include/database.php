<?php
  $dbHost = "localhost";
  $dbUser="root";
  $dbPass="";
  $dbName="webDemo";

  $connect = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName);

  if (!$connect) {
    die("Database connection fail");
  }
?>
