<?php
    class Download extends Controller {

        public static function render() {
            self::redirect("index");
        }

        public static function homework($file = "") {
            $teacher = User::getByUsername($_SESSION["user"])["teacher"];
            if(!File::download("../uploads/homework/$teacher/", $file)) {
                self::redirect("homework");
            }
        }
        
        public static function handin($student = "", $id = -1, $file = "") {
            if($_SESSION["user"] === User::getByUsername($student)["teacher"]) {
                if(!File::download("../uploads/handin/$student/$id/", $file)) {
                    self::redirect("homework");
                }
            }
        }
    }
?>