<?php
    class Homework extends Controller {

        public static function render() {
            if(!isset($_SESSION["sessionId"])) {
                return Controller::redirect("login");
            }

            if($_SESSION["sessionType"] == "Teacher") {
                $teacher = Teacher::getByUsername($_SESSION["sessionId"]);
            }
            else {
                $teacher = Teacher::getByUsername(Student::getByUsername($_SESSION["sessionId"])["teacher"]);
            }
            $fileList = File::getByAuthor($teacher["username"]);

            foreach($fileList as &$file) {
                $file["name"] = basename($file["path"]);

                if($_SESSION["sessionType"] == "Teacher") {
                    $handedIn = sizeof(glob("../uploads/handin/$file[id]/*"));
                    $total = sizeof(Student::getByTeacher($teacher["username"]));
                    $file["status"] = "$handedIn/$total students handed in";
                }

                else {
                    $file["status"] = file_exists("../uploads/handin/$file[id]/$_SESSION[sessionId]/") ? "Handed in" : "Not handed in";
                }
            }
            return Controller::view("homework", ["teacher"=>$teacher, "file"=>$fileList]);
        }
    }
?>