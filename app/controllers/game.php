<?php
    class Game extends Controller {

        public static function render() {
            if(!isset($_SESSION["user"])) {
                return self::redirect("login");
            }
            $teacher = User::getByUsername(User::getByUsername($_SESSION["user"])["teacher"]);
            $fileList = File::getByAuthor($teacher["username"]);
            return self::view("game", ["teacher"=>$teacher, "file"=>$fileList]);
        }

        public static function query($id = -1) {
            if(!isset($_SESSION["user"]) || !isset($_POST["submit"])) {
                return self::redirect("game");
            }
            $teacher = User::getByUsername($_SESSION["user"])["teacher"];
            $file = File::getById($id);
            if($file["author"] !== $teacher) {
                return self::redirect("game");
            }
            if($_POST["answer"] === pathinfo($file["path"], PATHINFO_FILENAME)) {
                return self::view("answer", ["content"=>file_get_contents($file["path"])]);
            }
            return self::view("rickroll");
        }
    }
?>