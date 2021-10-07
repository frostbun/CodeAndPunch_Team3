<?php
    class Logout extends Controller {

        public static function render() {
            User::logout();
            return Controller::redirect("index");
        }
    }
?>