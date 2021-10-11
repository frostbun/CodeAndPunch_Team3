<?php
    class Manage extends Controller {

        public static function render() {
            if(!isset($_SESSION["user"])) {
                return Controller::redirect("login");
            }
            if($_SESSION["type"] == "Teacher") {
                $student = Student::getByTeacher($_SESSION["user"]);
                $teacher = Teacher::getByUsername($_SESSION["user"]);
            }
            else {
                $student = Student::getByTeacher(Student::getByUsername($_SESSION["user"])["teacher"]);
                $teacher = Teacher::getByUsername(Student::getByUsername($_SESSION["user"])["teacher"]);
            }
            return Controller::view("manage", ["student"=>$student, "teacher"=>$teacher]);
        }
    }
?>