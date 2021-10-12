<?php
    class Model {

        public static function connect() {
            $host = "localhost";
            $user = "ehc";
            $pass = "ehcteam3";
            $data = "Classroom";
            $db =  new mysqli($host, $user, $pass, $data) or die("There was a problem connecting to the database!");
            return $db;
        }
    }
?>