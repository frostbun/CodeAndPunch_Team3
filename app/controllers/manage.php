<?php
    class Manage extends Controller {

        public static function render() {
            if(!isset($_SESSION["sessionId"])) {
                require_once "app/controllers/login.php";
                return Login::render();
            }
            if($_SESSION["sessionType"] == "Teacher") {
                $student = Student::getByTeacher($_SESSION["sessionId"]);
                $teacher = Teacher::getByUsername($_SESSION["sessionId"]);
                return Controller::view("manage", ["student"=>$student, "teacher"=>$teacher]);
            }
            if($_SESSION["sessionType"] == "Student") {
                $student = Student::getByTeacher(Student::getByUsername($_SESSION["sessionId"])["teacher"]);
                $teacher = Teacher::getByUsername(Student::getByUsername($_SESSION["sessionId"])["teacher"]);
                return Controller::view("manage", ["student"=>$student, "teacher"=>$teacher]);
            }
            require_once "app/controllers/index.php";
            return Index::render();
        }
    }
?>