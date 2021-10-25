<?php
    class ChangePw extends Controller {

        public function render() {
            if(!isset($_SESSION["user"])) {
                return self::redirect("login");
            }
            return self::view("changepw");
        }
        
        public function query() {
            if(!isset($_SESSION["user"]) || !isset($_POST["submit"])) {
                return self::redirect("changepw");
            }

            $message = $this->User->login($_SESSION["user"], $_POST["password"]);
            if(isset($message)) {
                return self::view("changepw", ["message"=>$message]);
            }

            $message = User::validate($_SESSION["user"], $_POST["newpass"], $_POST["confirm"], "Nguyen A", "a@gmail.com", "0123456789");
            if(isset($message)) {
                return self::view("changepw", ["message"=>$message]);
            }
            
            $this->User->changepw($_SESSION["user"], $_POST["newpass"]);
            return self::redirect("manage");
        }
    }
?>