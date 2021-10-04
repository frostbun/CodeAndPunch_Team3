<?php
    $db = new mysqli("localhost", "ehc", "ehcteam3");
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    $db->query("DROP DATABASE Classroom");
    $db->query("CREATE DATABASE Classroom");
    $db->query("USE Classroom");
    $db->query("CREATE TABLE Teacher (
        username VARCHAR(50) PRIMARY KEY,
        password VARCHAR(256),
        fullname VARCHAR(50),
        email VARCHAR(50),
        phone VARCHAR(20)
        )");
    $db->query("CREATE TABLE Student (
        teacher VARCHAR(50),
        username VARCHAR(50) PRIMARY KEY,
        password VARCHAR(256),
        fullname VARCHAR(50),
        email VARCHAR(50),
        phone VARCHAR(20)
        )");
    echo $db->error;
    $db->close();
    echo "Ok!";
?>