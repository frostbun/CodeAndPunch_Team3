<?php
    class Upload extends Controller {

        private static $type = ["newhomework", "handin"];

        public static function render($i = null) {
            if(!isset($_SESSION["sessionId"])) {
                return Controller::redirect("login");
            }
            return Controller::view("upload", ["type"=>Upload::$type[$i]]);
        }
        
        public static function newhomework() {
            if($_SESSION["sessionType"] == "Teacher" && isset($_POST["submit"])) {
                $message = File::upload("../uploads/homework/$_SESSION[sessionId]/", $_FILES["file"]);
                if(strpos($message, "/") === false) {
                    return Controller::view("upload", ["message"=>$message, "type"=>Upload::$type[0]]);
                }
                File::insert($_SESSION["sessionId"], $message, $_POST["deadline"]);
            }
            return Controller::redirect("homework");
        }
    }
?>