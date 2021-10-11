<?php
    class Upload extends Controller {

        private static $type = ["newhomework", "handin"];
        private static $label = ["Create Homework", "Submit Homework"];

        public static function render($id = -1, $fileid = -1) {
            if(!isset($_SESSION["user"])) {
                return Controller::redirect("login");
            }
            return Controller::view("upload", ["label"=>Upload::$label[$id], "type"=>Upload::$type[$id] . "/$fileid"]);
        }
        
        public static function newhomework() {
            if($_SESSION["type"] == "Teacher" && isset($_POST["submit"])) {
                $message = File::upload("../uploads/homework/$_SESSION[user]/", $_FILES["file"]);
                if(strpos($message, "/") === false) {
                    return Controller::view("upload", ["label"=>"Create Homework", "message"=>$message, "type"=>"newhomework"]);
                }
                File::insert($_SESSION["user"], $message, $_POST["deadline"]);
            }
            return Controller::redirect("homework");
        }

        public static function handin($id = -1) {
            if($_SESSION["type"] == "Student" && isset($_POST["submit"])) {
                $student = Student::getByUsername($_SESSION["user"]);
                $file = File::getById($id);
                if($file["author"] == $student["teacher"]) {
                    $message = File::upload("../uploads/handin/$id/$_SESSION[user]/", $_FILES["file"]);
                    if(strpos($message, "/") === false) {
                        return Controller::view("upload", ["label"=>"Submit Homework", "message"=>$message, "type"=>"handin/$id"]);
                    }
                }
            }
            return Controller::redirect("homework");
        }
    }
?>