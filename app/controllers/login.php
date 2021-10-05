<?php
    class Login extends Controller {

        public static function render() {
            if(isset($_SESSION["sessionId"])) {
                require_once "app/controllers/index.php";
                return Index::render();
            }
            return Controller::view("login");
        }

        public static function query() {
            if(isset($_SESSION["sessionId"]) || !isset($_POST["submit"])) {
                return Login::render();
            }

            $message = Teacher::login($_POST["username"], $_POST["password"]);
            if($message == "User not found") {
                $message = Student::login($_POST["username"], $_POST["password"]);
                if($message != "ok") {
                    return Controller::view("login", ["message"=>$message, "user"=>$_POST]);
                }
            }

            if($message == "Wrong password") {
                return Controller::view("login", ["message"=>$message, "user"=>$_POST]);
            }
            
            return Login::render();
        }
    }
?>