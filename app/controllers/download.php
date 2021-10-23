<?php
    class Download extends Controller {

        public static function render() {
            Controller::redirect("index");
        }

        public static function homework($file = "") {
            $teacher = $_SESSION["type"] === "Teacher" ? $_SESSION["user"] : Student::getByUsername($_SESSION["user"])["teacher"];
            if(!File::download("../uploads/homework/$teacher/", $file)) {
                Controller::redirect("homework");
            }
        }
        
        public static function handin($student = "", $id = -1, $file = "") {
            if(Student::getByUsername($student)["teacher"] === $_SESSION["user"]) {
                if(!File::download("../uploads/handin/$student/$id/", $file)) {
                    Controller::redirect("homework");
                }
            }
        }
    }
?>