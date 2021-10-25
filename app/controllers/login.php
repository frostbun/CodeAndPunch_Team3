<?php
    class Login extends Controller {

        public function render() {
            if(isset($_SESSION["user"])) {
                return self::redirect("index");
            }
            return self::view("login");
        }

        public function query() {
            if(!isset($_SESSION["user"]) && isset($_POST["submit"])) {
                $message = $this->User->login($_POST["username"], $_POST["password"]);
                if(isset($message)) {
                    return self::view("login", ["message"=>$message, "user"=>$_POST]);
                }
            }
            return self::redirect("index");
        }
    }
?>