<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Classrom Management</title>
        <link rel="stylesheet" type="text/css" href="/style.css">
    </head>

    <body>
        <header> <nav> <ul>
            <li> <a href="/">Home</a> </li>
            <?php
                if(isset($_SESSION["user"])) {
                    echo '<li> <a href="/manage">View students</a> </li>';
                    echo '<li> <a href="/homework">View homeworks</a> </li>';
                    echo '<li> <a href="/logout">Logout</a> </li>';
                }
                else {
                    echo '<li> <a href="/login">Login</a> </li>';
                    echo '<li> <a href="/register">Register</a> </li>';
                }
            ?>
        </ul> </nav> </header>