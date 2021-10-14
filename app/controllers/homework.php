<?php
    class Homework extends Controller {

        public static function render() {
            if(!isset($_SESSION["user"])) {
                return Controller::redirect("login");
            }

            if($_SESSION["type"] === "Teacher") {
                $teacher = Teacher::getByUsername($_SESSION["user"]);
            }
            else {
                $teacher = Teacher::getByUsername(Student::getByUsername($_SESSION["user"])["teacher"]);
            }
            $fileList = File::getByAuthor($teacher["username"]);

            foreach($fileList as &$file) {
                $file["name"] = basename($file["path"]);

                if($_SESSION["type"] === "Teacher") {
                    $handedIn = sizeof(glob("../uploads/handin/*/$file[id]"));
                    $total = Student::getByTeacher($teacher["username"]) !== false ? sizeof(Student::getByTeacher($teacher["username"])) : 0;
                    $file["status"] = "$handedIn/$total students handed in";
                }

                else {
                    $file["status"] = file_exists("../uploads/handin/$_SESSION[user]/$file[id]/") ? "Handed in" : "Not handed in";
                }
            }
            return Controller::view("homework", ["teacher"=>$teacher, "file"=>$fileList]);
        }
    }
?>