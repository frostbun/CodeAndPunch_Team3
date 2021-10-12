<?php
    class Status extends Controller {

        public static function render($id = -1) {
            if(!isset($_SESSION["user"])) {
                return Controller::redirect("login");
            }
            if($_SESSION["type"] == "Student") {
                return Controller::redirect("homework");
            }

            $file = File::getById($id);
            if($file === false || $file["author"] != $_SESSION["user"]) {
                return Controller::redirect("homework");
            }

            $studentList = Student::getByTeacher($_SESSION["user"]);
            foreach($studentList as &$student) {
                $filename = glob("../uploads/handin/$id/$student[username]/*");
                $student["filename"] = sizeof($filename) ? basename($filename[0]) : "";
            }

            return Controller::view("status", ["hwfilename"=>basename($file["path"]), "hwfileid"=>$id, "student"=>$studentList]);
        }
    }
?>