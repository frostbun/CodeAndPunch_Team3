<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Classrom Management</title>
        <link rel="stylesheet" type="text/css" href="/style.css">
        <script src="/script.js"> </script>
    </head>

    <body>
        <header> <nav> <ul>
            <li> <a href="/">Home</a> </li>
            <?php
                if(isset($_SESSION["user"])) {
                    echo '<li> <a href="/manage">Students</a> </li>';
                    echo '<li> <a href="/homework">Homeworks</a> </li>';
                    echo '<li> <a href="/game">Games</a> </li>';
                    echo '<li> <a href="/logout">Logout</a> </li>';
                }
                else {
                    echo '<li> <a href="/login">Login</a> </li>';
                    echo '<li> <a href="/register">Register</a> </li>';
                }
            ?>
        </ul> </nav> </header>