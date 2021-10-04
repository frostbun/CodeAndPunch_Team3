<?php
    class Logout extends Controller {

        public static function render() {
            require_once "app/models/User.php";
            User::logout();
            require_once "app/controllers/index.php";
            return Index::render();
        }
    }
?>