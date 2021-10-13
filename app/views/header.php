<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Classrom Management</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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