<?php
    class Upload extends Controller {

        private static $type = ["newhomework", "newhandin", "newgame"];
        private static $label = ["Create Homework", "Submit Homework", "Create New Game"];

        public static function render($id = -1, $fileid = -1) {
            if(!isset($_SESSION["user"])) {
                return Controller::redirect("login");
            }
            $type = $id==1 ? Upload::$type[$id] . "/$fileid" : Upload::$type[$id];
            return Controller::view("upload", ["label"=>Upload::$label[$id], "type"=>$type]);
        }
        
        public static function newhomework() {
            if($_SESSION["type"] == "Teacher" && isset($_POST["submit"])) {
                $message = File::upload("../uploads/homework/$_SESSION[user]/", $_FILES["file"]);
                if(strpos($message, "/") === false) {
                    return Controller::view("upload", ["message"=>$message, "label"=>Upload::$label[0], "type"=>Upload::$type[0]]);
                }
                File::insert($_SESSION["user"], $message, $_POST["deadline"], "");
            }
            return Controller::redirect("homework");
        }

        public static function newhandin($id = -1) {
            if($_SESSION["type"] == "Student" && isset($_POST["submit"])) {
                $student = Student::getByUsername($_SESSION["user"]);
                $file = File::getById($id);
                if($file["author"] == $student["teacher"]) {
                    $message = File::upload("../uploads/handin/$id/$_SESSION[user]/", $_FILES["file"]);
                    if(strpos($message, "/") === false) {
                        return Controller::view("upload", ["message"=>$message, "label"=>Upload::$label[1], "type"=>Upload::$type[1] . "/$id"]);
                    }
                }
            }
            return Controller::redirect("homework");
        }
        
        public static function newgame() {
            if($_SESSION["type"] == "Teacher" && isset($_POST["submit"])) {

                $fileType = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                if($fileType != "txt") {
                    return Controller::view("upload", ["message"=>"Only TXT is allowed!", "label"=>Upload::$label[2], "type"=>Upload::$type[2]]);
                }
                
                if(!strlen($_POST["hint"])) {
                    return Controller::view("upload", ["message"=>"Write some hint for your student :<!", "label"=>Upload::$label[2], "type"=>Upload::$type[2]]);
                }
                
                $message = File::upload("../uploads/game/$_SESSION[user]/", $_FILES["file"]);
                if(strpos($message, "/") === false) {
                    return Controller::view("upload", ["message"=>$message, "label"=>Upload::$label[2], "type"=>Upload::$type[2]]);
                }

                File::insert($_SESSION["user"], $message, date('Y-m-d'), $_POST["hint"]);
            }
            return Controller::redirect("game");
        }
    }
?>