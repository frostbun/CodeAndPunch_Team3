<?php
    class Download extends Controller {

        public static function render() {
            return Controller::redirect("homework");
        }

        public static function homework($file = null) {
            if(!isset($_SESSION["sessionId"])) {
                return Controller::redirect("login");
            }

            $teacher = $_SESSION["sessionType"] == "Teacher" ? $_SESSION["sessionId"] : Student::getByUsername($_SESSION["sessionId"])["teacher"];
            File::download("../uploads/homework/$teacher/", $file);
        }
    }
?>