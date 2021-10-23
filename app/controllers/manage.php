<?php
    class Manage extends Controller {

        public static function render() {
            if(!isset($_SESSION["user"])) {
                return Controller::redirect("login");
            }
            if($_SESSION["type"] === "Teacher") {
                $studentList = Student::getByTeacher($_SESSION["user"]);
                $teacherList = Teacher::getByUsername($_SESSION["user"]);
            }
            else {
                $studentList = Student::getByTeacher(Student::getByUsername($_SESSION["user"])["teacher"]);
                $teacherList = Teacher::getByUsername(Student::getByUsername($_SESSION["user"])["teacher"]);
            }
            foreach($studentList as &$student) {
                $student["buttonType"] = sizeof(Message::getUnread($_SESSION["user"], $student["username"])) ? "" : "-outline";
            }
            return Controller::view("manage", ["student"=>$studentList, "teacher"=>$teacherList]);
        }
    }
?>