<?php
    class Download extends Controller {

        public static function render() {
            return Controller::redirect("homework");
        }

        public static function homework($file = "") {
            if(!isset($_SESSION["user"])) {
                return Controller::redirect("login");
            }

            $teacher = $_SESSION["type"] == "Teacher" ? $_SESSION["user"] : Student::getByUsername($_SESSION["user"])["teacher"];
            File::download("../uploads/homework/$teacher/", $file);
            return Controller::redirect("homework");
        }
        
        public static function handin($id = -1, $student = "", $file = "") {
            if(!isset($_SESSION["user"])) {
                return Controller::redirect("login");
            }
            if($_SESSION["type"] != "Teacher" || Student::getByUsername($student)["teacher"] != $_SESSION["user"]) {
                return Controller::redirect("homework");
            }
            File::download("../uploads/handin/$id/$student/", $file);
            return Controller::redirect("homework");
        }
    }
?>