<?php
    class Register extends Controller {

        public static function render() {
            if(isset($_SESSION["sessionId"])) {
                require_once "app/controllers/index.php";
                return Index::render();
            }
            return Controller::view("register");
        }

        public static function query() {
            if(isset($_SESSION["sessionId"])) {
                require_once "app/controllers/index.php";
                return Index::render();
            }
            if(isset($_POST["submit"])) {
                require_once "app/models/User.php";
                require_once "app/models/Student.php";
                require_once "app/models/Teacher.php";
                
                $message = User::validate($_POST["username"], $_POST["password"], $_POST["confirm"], $_POST["fullname"], $_POST["email"], $_POST["phone"]);
                if($message != "ok") {
                    return Controller::view("register", ["message"=>$message]);
                }
                
                if(Teacher::getByUsername($_POST["username"]) || Student::getByUsername($_POST["username"])) {
                    return Controller::view("register", ["message"=>"User existed"]);
                }

                Teacher::insert($_POST["username"], $_POST["password"], $_POST["fullname"], $_POST["email"], $_POST["phone"]);
                Teacher::login($_POST["username"], $_POST["password"]);
            }
            return Register::render();
        }
    }
?>