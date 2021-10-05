<?php
    class Logout extends Controller {

        public static function render() {
            User::logout();
            require_once "app/controllers/index.php";
            return Index::render();
        }
    }
?>