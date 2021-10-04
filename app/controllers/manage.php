<?php
    class Manage extends Controller {

        public static function render() {
            if(!isset($_SESSION["sessionId"])) {
                require_once "app/controllers/login.php";
                return Login::render();
            }
            if($_SESSION["sessionType"] == "Teacher") {
                require_once "app/models/Student.php";
                $user = Student::getByTeacher($_SESSION["sessionId"]);
                return Controller::view("manage", ["user"=>$user]);
            }
            require_once "app/controllers/index.php";
            return Index::render();
        }
    }
?>