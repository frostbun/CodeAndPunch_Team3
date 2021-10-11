<?php
    class Delete extends Controller {

        public static function render($user = "") {
            if(!isset($_SESSION["user"])) {
                return Controller::redirect("login");
            }
            
            if($_SESSION["type"] == "Teacher" && Student::getByUsername($user)["teacher"] == $_SESSION["user"]) {
                Student::delete($user);
            }
            
            return Controller::redirect("manage");
        }
    }
?>