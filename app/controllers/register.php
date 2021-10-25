<?php
    class Register extends Controller {

        public function render() {
            if(isset($_SESSION["user"])) {
                return self::redirect("index");
            }
            return self::view("register");
        }

        public function query() {
            if(!isset($_SESSION["user"]) && isset($_POST["submit"])) {
                $message = User::validate($_POST["username"], $_POST["password"], $_POST["confirm"], $_POST["fullname"], $_POST["email"], $_POST["phone"]);
                if(isset($message)) {
                    return self::view("register", ["message"=>$message, "user"=>$_POST]);
                }
                if($this->User->getByUsername($_POST["username"]) !== false) {
                    return self::view("register", ["message"=>"User existed", "user"=>$_POST]);
                }
                $this->User->insert($_POST["username"], $_POST["password"], $_POST["fullname"], $_POST["email"], $_POST["phone"], $_POST["username"]);
                $this->User->login($_POST["username"], $_POST["password"]);
            }
            return self::redirect("index");
        }
    }
?>