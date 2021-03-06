<?php
    class Manage extends Controller {

        public static function render() {
            if(!isset($_SESSION["user"])) {
                return self::redirect("login");
            }
            $teacherUsername = User::getByUsername($_SESSION["user"])["teacher"];
            $teacher = User::getByUsername($teacherUsername);
            $studentList = User::getByTeacher($teacherUsername);
            foreach($studentList as &$student) {
                $student["buttonType"] = sizeof(Message::getUnread($_SESSION["user"], $student["username"])) ? "" : "-outline";
            }
            return self::view("manage", ["student"=>$studentList, "teacher"=>$teacher]);
        }
    }
?>