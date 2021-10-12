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
        username VARCHAR(50),
        password VARCHAR(256),
        fullname VARCHAR(50),
        email VARCHAR(50),
        phone VARCHAR(20)
        )");
    $db->query("CREATE TABLE Student (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        teacher VARCHAR(50),
        username VARCHAR(50),
        password VARCHAR(255),
        fullname VARCHAR(50),
        email VARCHAR(50),
        phone VARCHAR(20)
        )");
    $db->query("CREATE TABLE Upload (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        author VARCHAR(50),
        path VARCHAR(50),
        deadline DATE,
        hint VARCHAR(255)
        )");
    $db->query("CREATE TABLE Message (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        sender VARCHAR(50),
        receiver VARCHAR(50),
        content VARCHAR(255),
        datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )");
    echo $db->error;
    $db->close();
    echo "Ok!";
?>