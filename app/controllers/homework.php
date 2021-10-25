<?php
    class Homework extends Controller {

        private File $File;

        public function Homework() {
            $this->File = self::model("File");
        }

        public function render() {
            if(!isset($_SESSION["user"])) {
                return self::redirect("login");
            }
            $teacher = $this->User->getByUsername($this->User->getByUsername($_SESSION["user"])["teacher"]);
            $fileList = $this->File->getByAuthor($teacher["username"]);
            foreach($fileList as &$file) {
                $file["name"] = basename($file["path"]);

                if($_SESSION["type"] === "Teacher") {
                    $handedIn = sizeof(glob("../uploads/handin/*/$file[id]"));
                    $total = sizeof($this->User->getByTeacher($teacher["username"]));
                    $file["status"] = "$handedIn/$total students handed in";
                }

                else {
                    $file["status"] = file_exists("../uploads/handin/$_SESSION[user]/$file[id]/") ? "Handed in" : "Not handed in";
                }
            }
            return self::view("homework", ["teacher"=>$teacher, "file"=>$fileList]);
        }
    }
?>