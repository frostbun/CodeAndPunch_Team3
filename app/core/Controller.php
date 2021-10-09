<?php
    class Controller {

        public static function view($view, $data = []) {
            require_once "../app/views/" . $view . ".php";
        }

        public static function redirect($controller, $params = []) {
            header("Location: /$controller/" . implode("/", $params));
        }
    }
?>