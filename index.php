<?php
    require('vendor/autoload.php');
    require_once "app/core/App.php";
    require_once "app/core/Controller.php";
    require_once "app/core/Model.php";
    require_once "app/models/User.php";
    require_once "app/models/Student.php";
    require_once "app/models/Teacher.php";

    echo $_SERVER["REQUEST_URI"];
    $app = new App();
?>