<?php
  $dbHost = "localhost";
  $dbUser="ehc";
  $dbPass="ehcteam3";
  $dbName="webDemo";

  $connect = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName);

  if (!$connect) {
    die("Database connection fail");
  }
?>
