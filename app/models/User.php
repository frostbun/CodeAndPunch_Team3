<?php
    abstract class User extends Model {

        public static function logout() {
            unset($_SESSION["sessionId"]);
            unset($_SESSION["sessionType"]);
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