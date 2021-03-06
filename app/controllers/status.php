<?php
    class Status extends Controller {

        public static function render($id = -1) {
            $file = File::getById($id);
            if($file["author"] !== $_SESSION["user"] || strlen($file["hint"])) {
                return self::redirect("homework");
            }

            $studentList = User::getByTeacher($_SESSION["user"]);
            foreach($studentList as &$student) {
                $filename = glob("../uploads/handin/$student[username]/$id/*");
                $student["handedin"] = sizeof($filename);
                $student["status"] = $student["handedin"] ? "Handed in" : "Not handed in";
                $student["filename"] = $student["handedin"] ? basename($filename[0]) : "";
            }

            return self::view("status", ["filename"=>basename($file["path"]), "fileid"=>$id, "student"=>$studentList]);
        }
    }
?>