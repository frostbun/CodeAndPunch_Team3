<?php
    class Controller {

        public User $User;

        public function __construct() {
            session_start();
            $this->User = self::model("User");
            if($this->User->getByUsername($_SESSION["user"]) === false) {
                User::logout();
            }
            if(isset($_POST["submit"]) && $_POST["token"] !== $_SESSION["token"]) {
                die("Opsss!");
            }
            $_SESSION["token"] = bin2hex(random_bytes(64));
        }

        public static function view($view, $data = []) {
            $data["page"]  = $view;
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