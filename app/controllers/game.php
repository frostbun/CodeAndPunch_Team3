<?php
    class Game extends Controller {

        public static function render() {
            if(!isset($_SESSION["user"])) {
                return Controller::redirect("login");
            }

            if($_SESSION["type"] == "Teacher") {
                $teacher = Teacher::getByUsername($_SESSION["user"]);
            }
            else {
                $teacher = Teacher::getByUsername(Student::getByUsername($_SESSION["user"])["teacher"]);
            }
            $fileList = File::getByAuthor($teacher["username"]);
            return Controller::view("game", ["teacher"=>$teacher, "file"=>$fileList]);
        }

        public static function query($id = -1) {
            if(!isset($_SESSION["user"]) || !isset($_POST["submit"])) {
                return Game::render();
            }

            if($_SESSION["type"] == "Teacher") {
                $teacher = Teacher::getByUsername($_SESSION["user"]);
            }
            else {
                $teacher = Teacher::getByUsername(Student::getByUsername($_SESSION["user"])["teacher"]);
            }
            $file = File::getById($id);
            if($file["author"] != $teacher["username"]) {
                return Game::render();
            }

            if($_POST["answer"] == pathinfo($file["path"], PATHINFO_FILENAME)) {
                return Controller::view("answer", ["content"=>file_get_contents($file["path"])]);
            }

            return Controller::view("rickroll");
        }
    }
?>