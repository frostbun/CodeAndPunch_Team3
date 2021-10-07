<?php
    class Delete extends Controller {

        public static function render($user = null) {
            if(!isset($_SESSION["sessionId"])) {
                return Controller::redirect("login");
            }
            
            if($_SESSION["sessionType"] == "Teacher" && Student::getByUsername($user)["teacher"] == $_SESSION["sessionId"]) {
                Student::delete($user);
            }
            
            return Controller::redirect("manage");
        }
    }
?>