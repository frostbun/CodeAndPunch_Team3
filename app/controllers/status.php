<?php
    class Status extends Controller {

        public static function render($id = -1) {
            $file = File::getById($id);
            if($file["author"] !== $_SESSION["user"]) {
                return Controller::redirect("homework");
            }

            $studentList = Student::getByTeacher($_SESSION["user"]);
            foreach($studentList as &$student) {
                $filename = glob("../uploads/handin/$id/$student[username]/*");
                $student["handedin"] = sizeof($filename);
                $student["status"] = $student["handedin"] ? "Handed in" : "Not handed in";
                $student["filename"] = $student["handedin"] ? basename($filename[0]) : "";
            }

            return Controller::view("status", ["hwfilename"=>basename($file["path"]), "hwfileid"=>$id, "student"=>$studentList]);
        }
    }
?>