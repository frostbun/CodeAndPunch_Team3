<?php
    class Game extends Controller {

        private File $File;

        public function __construct() {
            parent::__construct();
            $this->File = self::model("File");
        }

        public function render() {
            if(!isset($_SESSION["user"])) {
                return self::redirect("login");
            }
            $teacher = $this->User->getByUsername($this->User->getByUsername($_SESSION["user"])["teacher"]);
            $fileList = $this->File->getByAuthor($teacher["username"]);
            return self::view("game", ["teacher"=>$teacher, "file"=>$fileList]);
        }

        public function query($id = -1) {
            if(!isset($_SESSION["user"]) || !isset($_POST["submit"])) {
                return self::redirect("game");
            }
            $teacher = $this->User->getByUsername($_SESSION["user"])["teacher"];
            $file = $this->File->getById($id);
            if($file["author"] !== $teacher) {
                return self::redirect("game");
            }
            if($_POST["answer"] === pathinfo($file["path"], PATHINFO_FILENAME)) {
                return self::view("answer", ["content"=>htmlspecialchars(file_get_contents($file["path"]))]);
            }
            return self::view("rickroll");
        }
    }
?>