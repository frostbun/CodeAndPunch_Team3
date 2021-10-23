<?php
    class Controller {

        public function Controller() {
            session_start();
            if(User::getByUsername($_SESSION["user"]) === false) {
                User::logout();
            }
        }

        public static function view($view, $data = []) {
            $data["page"]  = $view;
            require_once "../app/views/$view.php";
        }

        public static function redirect($controller, $params = []) {
            header("Location: /$controller/" . implode("/", $params));
            // require_once "../app/controllers/$controller.php";
            // call_user_func_array([$controller, "render"], $params);
        }
    }
?>