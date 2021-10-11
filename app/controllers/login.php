<?php
    class Login extends Controller {

        public static function render() {
            if(isset($_SESSION["user"])) {
                return Controller::redirect("index");
            }
            return Controller::view("login");
        }

        public static function query() {
            if(!isset($_SESSION["user"]) && isset($_POST["submit"])) {
                $message = User::login($_POST["username"], $_POST["password"]);
                if(isset($message)) {
                    return Controller::view("login", ["message"=>$message, "user"=>$_POST]);
                }
            }
            return Login::render();
        }
    }
?>