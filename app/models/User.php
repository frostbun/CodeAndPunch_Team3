<?php
    class User {

        public $id;
        public $username;
        public $password;
        public $fullname;
        public $email;
        public $phone;

        public function User($id, $username, $password, $fullname, $email, $phone) {
            $this->id = $id;
            $this->username = $username;
            $this->password = $password;
            $this->fullname = $fullname;
            $this->email = $email;
            $this->phone = $phone;
        }

        public static function login($table, $username, $password) {
            $user = User::getByUsername($table, $username);
            if(!$user) {
                return "User not found";
            }
            if(!password_verify($password, $user->password)) {
                return "Wrong password";
            }
            $_SESSION["sessionId"] = $user->id;
            $_SESSION["sessionUser"] = $user->username;
            return "ok";
        }

        public static function logout() {
            unset($_SESSION["sessionId"]);
            unset($_SESSION["sessionUser"]);
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
            $row = $result->fetch_assoc();
            $stmt->close();
            $db->close();
            return new User($row["id"], $row["username"], $row["password"], $row["fullname"], $row["email"], $row["phone"]);
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