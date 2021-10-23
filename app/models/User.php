<?php
    class User extends Model {

        public static function login($username, $password) {
            $user = self::getByUsername($username);
            if($user === false) {
                return "User not found";
            }
            if(!password_verify($password, $user["password"])) {
                return "Wrong password";
            }
            $_SESSION["user"] = $user["username"];
            $_SESSION["type"] = $user["username"] === $user["teacher"] ? "Teacher" : "Student";
            return null;
        }

        public static function logout() {
            unset($_SESSION["user"]);
            unset($_SESSION["type"]);
        }
        
        public static function validate($username, $password, $confirm, $fullname, $email, $phone) {
            if (empty($username) || empty($password) || empty($confirm) ||
                empty($fullname) || empty($email) || empty($phone)) {
                return "You must fill the form!";
            }

            $invalidUsername = ["null", "true", "false"];

            if(in_array(strtolower($username), $invalidUsername)) {
                return "Invalid username";
            }

            if(!preg_match("/^\w+$/", $username)) {
                return "Username can only contains alphanumeric and underscore!";
            }

            if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
                return "Password must contain at least 8 characters, include 1 number, 1 lowercase letter, 1 uppercase letter, 1 special character!";
            }

            if(!preg_match("/^[a-zA-Z ]+$/", $fullname)) {
                return "Full name can only contains English characters and spaces!";
            }

            if($password !== $confirm) {
                return "Password not match";
            }

            return null;
        }

        public static function getByUsername($username) {
            $db = self::connect();
            $stmt = $db->prepare("SELECT * FROM User WHERE username=?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows == 0) {
                return false;
            }
            $stmt->close();
            $db->close();
            return $result->fetch_assoc();
        }

        public static function getByTeacher($teacher) {
            $db = self::connect();
            $stmt = $db->prepare("SELECT * FROM User WHERE teacher=? AND username!=? ORDER BY fullname ASC");
            $stmt->bind_param("ss", $teacher, $teacher);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = [];
            for($i=0; $i<$result->num_rows; ++$i) {
                array_push($user, $result->fetch_assoc());
            }
            $stmt->close();
            $db->close();
            return $user;
        }

        public static function insert($username, $password, $fullname, $email, $phone, $teacher) {
            $db = self::connect();
            $password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $db->prepare("INSERT INTO User (username, password, fullname, email, phone, teacher) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $username, $password, $fullname, $email, $phone, $teacher);
            $stmt->execute();
            $stmt->close();
            $db->close();
        }

        public static function update($username, $fullname, $email, $phone) {
            $db = self::connect();
            $stmt = $db->prepare("UPDATE User SET fullname=?, email=?, phone=? WHERE username=?");
            $stmt->bind_param("ssss", $fullname, $email, $phone, $username);
            $stmt->execute();
            $stmt->close();
            $db->close();
        }

        public static function delete($username) {
            $db = self::connect();
            $stmt = $db->prepare("DELETE FROM User WHERE username=?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->close();
            $db->close();
        }

        public static function changepw($username, $password) {
            $db = self::connect();
            $password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $db->prepare("UPDATE User SET password=? WHERE username=?");
            $stmt->bind_param("ss", $password, $username);
            $stmt->execute();
            $stmt->close();
            $db->close();
        }
    }
?>