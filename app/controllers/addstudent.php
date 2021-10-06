<?php
    class AddStudent extends Controller {

        public static function render() {
            if(!isset($_SESSION["sessionId"])) {
                require_once "app/controllers/login.php";
                return Login::render();
            }
            if($_SESSION["sessionType"] == "Teacher") {
                return Controller::view("addstudent");
            }
            require_once "app/controllers/manage.php";
            return Manage::render();
        }
        
        public static function query() {
            if(!isset($_SESSION["sessionId"]) || $_SESSION["sessionType"] != "Teacher" || !isset($_POST["submit"])) {
                return AddStudent::render();
            }

            $message = User::validate($_POST["username"], $_POST["password"], $_POST["confirm"], $_POST["fullname"], $_POST["email"], $_POST["phone"]);
            if(isset($message)) {
                return Controller::view("addstudent", ["message"=>$message, "user"=>$_POST]);
            }
            
            if(Teacher::getByUsername($_POST["username"]) || Student::getByUsername($_POST["username"])) {
                return Controller::view("addstudent", ["message"=>"User existed", "user"=>$_POST]);
            }

            Student::insert($_SESSION["sessionId"], $_POST["username"], $_POST["password"], $_POST["fullname"], $_POST["email"], $_POST["phone"]);
            require_once "app/controllers/manage.php";
            return Manage::render();
        }
    }
?>