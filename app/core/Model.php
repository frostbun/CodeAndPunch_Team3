<?php
    class Model {

        private mysqli $db;

        public function __construct() {
            $host = $_ENV["DB_HOST"];
            $user = $_ENV["DB_USER"];
            $pass = $_ENV["DB_PASS"];
            $data = $_ENV["DB_DATA"];
            $this->db =  new mysqli($host, $user, $pass, $data) or die("There was a problem connecting to the database!");
            // $db =  new mysqli("localhost", "ehc", "ehcteam3", "Classroom") or die("There was a problem connecting to the database!");
        }

        public function prepare($stmt) {
            return $this->db->prepare($stmt);
        }
    }
?>