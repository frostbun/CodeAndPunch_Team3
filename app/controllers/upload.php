<?php
    class Upload extends Controller {

        private static $type = ["newhomework", "newhandin", "newgame"];
        private File $File;

        public function __construct() {
            $this->File = self::model("File");
        }

        public function render($uploadid = -1, $fileid = -1) {
            if(!isset($_SESSION["user"])) {
                return self::redirect("login");
            }
            return self::view(self::$type[$uploadid], ["id"=>$fileid]);
        }

        public function newhomework() {
            if($_SESSION["type"] === "Teacher" && isset($_POST["submit"])) {
                $message = File::upload("../uploads/homework/$_SESSION[user]/", $_FILES["file"]);
                if(strpos($message, "/") === false) {
                    return self::view("newhomework", ["message"=>$message]);
                }
                $this->File->insert($_SESSION["user"], $message, $_POST["deadline"], "");
            }
            return self::redirect("homework");
        }

        public function newhandin($id = -1) {
            if($_SESSION["type"] === "Student" && isset($_POST["submit"])) {
                $student = $this->User->getByUsername($_SESSION["user"]);
                $file = $this->File->getById($id);
                if($file["author"] === $student["teacher"]) {
                    $message = File::upload("../uploads/handin/$_SESSION[user]/$id/", $_FILES["file"]);
                    if(strpos($message, "/") === false) {
                        return self::view("newhandin", ["message"=>$message, "id"=>$id]);
                    }
                }
            }
            return self::redirect("homework");
        }

        public function newgame() {
            if($_SESSION["type"] === "Teacher" && isset($_POST["submit"])) {

                $fileType = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                if($fileType !== "txt") {
                    return self::view("newgame", ["message"=>"Only TXT is allowed!"]);
                }
                
                if(!strlen($_POST["hint"])) {
                    return self::view("newgame", ["message"=>"Write some hint for your student :|"]);
                }
                
                $message = File::upload("../uploads/game/$_SESSION[user]/", $_FILES["file"]);
                if(strpos($message, "/") === false) {
                    return self::view("newgame", ["message"=>$message]);
                }

                $this->File->insert($_SESSION["user"], $message, date('Y-m-d'), $_POST["hint"]);
            }
            return self::redirect("game");
        }

        public function delhomework($id = -1) {
            $file = $this->File->getById($id);
            if($file["author"] === $_SESSION["user"] && !strlen($file["hint"])) {
                $this->File->delete($id);
                File::deleteDir($file["path"]);
            }
            return self::redirect("homework");
        }

        public function delgame($id = -1) {
            $file = $this->File->getById($id);
            if($file["author"] === $_SESSION["user"] && strlen($file["hint"])) {
                $this->File->delete($id);
                File::deleteDir($file["path"]);
            }
            return self::redirect("game");
        }
        
        public function delhandin($id = -1) {
            File::deleteDir("../uploads/handin/$_SESSION[user]/$id");
            return self::redirect("homework");
        }
    }
?>