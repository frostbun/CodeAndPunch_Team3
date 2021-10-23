<?php
    class Login extends Controller {

        public static function render() {
            if(isset($_SESSION["user"])) {
                return self::redirect("index");
            }
            return self::view("login");
        }

        public static function query() {
            if(!isset($_SESSION["user"]) && isset($_POST["submit"])) {
                $message = User::login($_POST["username"], $_POST["password"]);
                if(isset($message)) {
                    return self::view("login", ["message"=>$message, "user"=>$_POST]);
                }
            }
            return self::redirect("index");
        }
    }
?>