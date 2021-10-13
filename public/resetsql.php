<?php
    $db = new mysqli("localhost", "ehc", "ehcteam3");
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    $db->query("DROP DATABASE Classroom");
    $db->query("CREATE DATABASE Classroom");
    $db->query("USE Classroom");
    $db->query("CREATE TABLE Teacher (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(256),
        password VARCHAR(256),
        fullname VARCHAR(256),
        email VARCHAR(256),
        phone VARCHAR(20)
        )");
    $db->query("CREATE TABLE Student (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        teacher VARCHAR(256),
        username VARCHAR(256),
        password VARCHAR(256),
        fullname VARCHAR(256),
        email VARCHAR(256),
        phone VARCHAR(20)
        )");
    $db->query("CREATE TABLE Upload (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        author VARCHAR(256),
        path VARCHAR(256),
        deadline DATE,
        hint VARCHAR(512)
        )");
    $db->query("CREATE TABLE Message (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        sender VARCHAR(256),
        receiver VARCHAR(256),
        content VARCHAR(512),
        datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
    echo $db->error;
    $db->close();
    echo "Ok!";
?>