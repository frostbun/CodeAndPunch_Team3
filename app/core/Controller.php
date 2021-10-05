<?php
    class Controller {

        public function Controller() {
            session_start();
        }

        public static function view($view, $data = []) {
            require_once "app/views/" . $view . ".php";
        }
    }
?>