<?php
    class Delete extends Controller {

        public static function render($user = null) {
            if(!isset($_SESSION["sessionId"])) {
                require_once "app/controllers/login.php";
                return Login::render();
            }
            
            if($_SESSION["sessionType"] == "Teacher" && Student::getByUsername($user)["teacher"] == $_SESSION["sessionId"]) {
                Student::delete($user);
            }
            
            require_once "app/controllers/manage.php";
            return Manage::render();
        }
    }
?>