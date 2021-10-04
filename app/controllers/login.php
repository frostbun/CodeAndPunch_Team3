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
            if(isset($_SESSION["sessionId"])) {
                require_once "app/controllers/index.php";
                return Index::render();
            }
            if(isset($_POST["submit"])) {
                require_once "app/models/Student.php";
                require_once "app/models/Teacher.php";

                $message = Teacher::login($_POST["username"], $_POST["password"]);
                if($message == "User not found") {
                    $message = Student::login($_POST["username"], $_POST["password"]);
                    if($message != "ok") {
                        return Controller::view("login", ["message"=>$message]);
                    }
                }
                if($message == "Wrong password") {
                    return Controller::view("login", ["message"=>$message]);
                }
            }
            return Login::render();
        }
    }
?>