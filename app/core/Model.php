<?php
    class Model {

        public static function connect() {
            $host = $_ENV["DB_HOST"];
            $user = $_ENV["DB_USER"];
            $pass = $_ENV["DB_PASS"];
            $data = $_ENV["DB_DATA"];
            $db =  new mysqli($host, $user, $pass, $data) or die("There was a problem connecting to the database!");
            return $db;
        }
    }
?>