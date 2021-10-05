<?php
    class Model {

        public static function connect() {
            $db =  new mysqli("localhost", "ehc", "ehcteam3", "Classroom") or die("There was a problem connecting to the database!");
            return $db;
        }
    }
?>