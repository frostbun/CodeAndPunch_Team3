<?php
    class Controller {

        public static function view($view, $data = []) {
            require_once "../app/views/$view.php";
        }

        public static function redirect($controller, $params = []) {
            header("Location: /$controller/" . implode("/", $params));
            // require_once "../app/controllers/$controller.php";
            // call_user_func_array([$controller, "render"], $params);
        }
    }
?>