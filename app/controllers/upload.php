<?php
    class Upload extends Controller {

        private static $type = ["newhomework", "newhandin", "newgame"];

        public static function render($uploadid = -1, $fileid = -1) {
            if(!isset($_SESSION["user"])) {
                return Controller::redirect("login");
            }
            return Controller::view(Upload::$type[$uploadid], ["id"=>$fileid]);
        }
        
        public static function newhomework() {
            if($_SESSION["type"] === "Teacher" && isset($_POST["submit"])) {
                $message = File::upload("../uploads/homework/$_SESSION[user]/", $_FILES["file"]);
                if(strpos($message, "/") === false) {
                    return Controller::view("newhomework", ["message"=>$message]);
                }
                File::insert($_SESSION["user"], $message, $_POST["deadline"], "");
            }
            return Controller::redirect("homework");
        }

        public static function newhandin($id = -1) {
            if($_SESSION["type"] === "Student" && isset($_POST["submit"])) {
                $student = Student::getByUsername($_SESSION["user"]);
                $file = File::getById($id);
                if($file["author"] === $student["teacher"]) {
                    $message = File::upload("../uploads/handin/$_SESSION[user]/$id/", $_FILES["file"]);
                    if(strpos($message, "/") === false) {
                        return Controller::view("newhandin", ["message"=>$message, "id"=>$id]);
                    }
                }
            }
            return Controller::redirect("homework");
        }
        
        public static function newgame() {
            if($_SESSION["type"] === "Teacher" && isset($_POST["submit"])) {

                $fileType = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                if($fileType !== "txt") {
                    return Controller::view("newgame", ["message"=>"Only TXT is allowed!"]);
                }
                
                if(!strlen($_POST["hint"])) {
                    return Controller::view("newgame", ["message"=>"Write some hint for your student :<!"]);
                }
                
                $message = File::upload("../uploads/game/$_SESSION[user]/", $_FILES["file"]);
                if(strpos($message, "/") === false) {
                    return Controller::view("newgame", ["message"=>$message]);
                }

                File::insert($_SESSION["user"], $message, date('Y-m-d'), $_POST["hint"]);
            }
            return Controller::redirect("game");
        }
    }
?>