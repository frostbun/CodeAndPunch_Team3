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
                if(isset($_SESSION["sessionId"])) {
                    if($_SESSION["sessionType"] == "Teacher") {
                        echo '<li> <a href="/manage">Manage student</a> </li>';
                    }
                    echo '<li> <a href="/logout">Logout</a> </li>';
                }
                else {
                    echo '<li> <a href="/login">Login</a> </li>';
                    echo '<li> <a href="/register">Register</a> </li>';
                }
            ?>
        </ul> </nav> </header>