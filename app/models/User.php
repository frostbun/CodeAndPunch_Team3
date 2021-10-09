<?php
    class User extends Model {

        public static function login($username, $password) {
            if(Teacher::getByUsername($username)) {
                $user = Teacher::getByUsername($username);
            }
            else {
                $user = Student::getByUsername($username);
            }

            if(!$user) {
                return "User not found";
            }

            if(!password_verify($password, $user["password"])) {
                return "Wrong password";
            }
            
            $_SESSION["sessionId"] = $user["username"];
            $_SESSION["sessionType"] = "Student";
            return null;

            
        }

        public static function logout() {
            unset($_SESSION["sessionId"]);
            unset($_SESSION["sessionType"]);
        }
        
        public static function validate($username, $password, $confirm, $fullname, $email, $phone) {
            
            if (empty($username) || empty($password) || empty($confirm) ||
                empty($fullname) || empty($email) || empty($phone)) {
                return "Empty";
            }

            $invalidUsername = ["render", "query", "null"];

            if(in_array($username, $invalidUsername)) {
                return "Invalid username";
            }

            if (!preg_match("/^[a-zA-Z0-9]*/","$username")) {
                return "placeholder";
            }

            if ($password != $confirm) {
                return "Password not match";
            }

            return null;
        }

        public static function update($username, $fullname, $email, $phone) {
            $db = Model::connect();

            $stmt = $db->prepare("UPDATE Teacher SET fullname=?, email=?, phone=? WHERE username=?");
            $stmt->bind_param("ssss", $fullname, $email, $phone, $username);
            $stmt->execute();
            $stmt->close();

            $stmt = $db->prepare("UPDATE Student SET fullname=?, email=?, phone=? WHERE username=?");
            $stmt->bind_param("ssss", $fullname, $email, $phone, $username);
            $stmt->execute();
            $stmt->close();

            $db->close();
        }

        public static function changepw($username, $password) {
            $db = Model::connect();
            $password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $db->prepare("UPDATE Teacher SET password=? WHERE username=?");
            $stmt->bind_param("ss", $password, $username);
            $stmt->execute();
            $stmt->close();

            $stmt = $db->prepare("UPDATE Student SET password=? WHERE username=?");
            $stmt->bind_param("ss", $password, $username);
            $stmt->execute();
            $stmt->close();

            $db->close();
        }
    }
?>