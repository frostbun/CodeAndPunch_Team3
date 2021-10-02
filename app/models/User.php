<?php
    class User {

        public static function login($type, $username, $password) {
            $user = User::getByUsername($type, $username);
            if(!$user) {
                return "User not found";
            }
            if(!password_verify($password, $user["password"])) {
                return "Wrong password";
            }
            $_SESSION["sessionId"] = $user["id"];
            $_SESSION["sessionUser"] = $user["username"];
            $_SESSION["sessionType"] = $type;
            return "ok";
        }

        public static function logout() {
            unset($_SESSION["sessionId"]);
            unset($_SESSION["sessionUser"]);
            unset($_SESSION["sessionType"]);
        }

        public static function getByUsername($table, $username) {
            $db = new mysqli("localhost", "ehc", "ehcteam3", "Classroom") or die("There was a problem connecting to the database!");
            
            $stmt = $db->prepare("SELECT * FROM $table WHERE username=?");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            $result = $stmt->get_result();
            if ($result->num_rows == 0) {
                return false;
            }

            $stmt->close();
            $db->close();
            return $result->fetch_assoc();;
        }

        public static function insert($table, $username, $password, $fullname, $email, $phone) {
            $db = new mysqli("localhost", "ehc", "ehcteam3", "Classroom") or die("There was a problem connecting to the database!");
            $password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $db->prepare("INSERT INTO $table (username, password, fullname, email, phone) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $username, $password, $fullname, $email, $phone);
            $stmt->execute();
            $stmt->close();
            $db->close();
        }
        
        public static function validate($username, $password, $confirm, $fullname, $email, $phone) {
            
            if (empty($username) || empty($password) || empty($confirm) ||
                empty($fullname) || empty($email) || empty($phone)) {
                return "message";
            }

            if (!preg_match("/^[a-zA-Z0-9]*/","$username")) {
                return "message";
            }

            if ($password != $confirm) {
                return "message";
            }

            return "ok";
        }
    }
?>