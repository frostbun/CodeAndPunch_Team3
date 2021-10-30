<?php
    class Controller {

        public User $User;

        public function __construct() {
            session_start();
            $this->User = self::model("User");
            if($this->User->getByUsername($_SESSION["user"]) === false) {
                User::logout();
            }
        }

        public static function view($view, $data = []) {
            $data["page"]  = $view;
            $data["token"] = $_SESSION["token"];
            require_once "../app/views/$view.php";
        }

        public static function model($model) {
            require_once "../app/models/$model.php";
            return new $model;
        }

        public static function redirect($controller, $params = []) {
            header("Location: /$controller/" . implode("/", $params));
        }
    }
?>