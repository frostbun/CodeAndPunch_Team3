<?php
    class Register extends Controller {

        public static function render() {
            if(isset($_SESSION["user"])) {
                return Controller::redirect("index");
            }
            return Controller::view("register");
        }

        public static function query() {
            if(!isset($_SESSION["user"]) && isset($_POST["submit"])) {
                $message = User::validate($_POST["username"], $_POST["password"], $_POST["confirm"], $_POST["fullname"], $_POST["email"], $_POST["phone"]);
                if(isset($message)) {
                    return Controller::view("register", ["message"=>$message, "user"=>$_POST]);
                }
                if(Teacher::getByUsername($_POST["username"]) || Student::getByUsername($_POST["username"])) {
                    return Controller::view("register", ["message"=>"User existed", "user"=>$_POST]);
                }
                Teacher::insert($_POST["username"], $_POST["password"], $_POST["fullname"], $_POST["email"], $_POST["phone"]);
                Teacher::login($_POST["username"], $_POST["password"]);
            }
            return Register::render();
        }
    }
?>