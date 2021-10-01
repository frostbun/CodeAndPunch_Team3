<!DOCTYPE html>
<?php
  session_start();
  require_once 'include/database.php';
  require_once 'include/register-inc.php';
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>webDemo</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li><a href="index.php">HOME</a></li>
          <li><a href="login.php">LOGIN</a></li>
          <li><a href="register.php">REGISTER</a></li>
        </ul>
      </nav>
    </header>
