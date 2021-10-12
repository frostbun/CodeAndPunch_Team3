<?php
    class User extends Model {

        public static function login($username, $password) {
            if(Teacher::getByUsername($username)) {
                $user = Teacher::getByUsername($username);
                $type = "Teacher";
            }
            else {
                $user = Student::getByUsername($username);
                $type = "Student";
            }

            if($user === false) {
                return "User not found";
            }

            if(!password_verify($password, $user["password"])) {
                return "Wrong password";
            }
            
            $_SESSION["user"] = $user["username"];
            $_SESSION["type"] = $type;
            return null;
        }

        public static function logout() {
            unset($_SESSION["user"]);
            unset($_SESSION["type"]);
        }
        
        public static function validate($username, $password, $confirm, $fullname, $email, $phone) {
            
            if (empty($username) || empty($password) || empty($confirm) ||
                empty($fullname) || empty($email) || empty($phone)) {
                return "Empty";
            }

            $invalidUsername = ["render", "query", "null", "true", "false", "newhomework", "handin"];

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

            if($password != $confirm) {
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