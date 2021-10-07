<?php
    class ChangePw extends Controller {

        public static function render() {
            if(!isset($_SESSION["sessionId"])) {
                return Controller::redirect("login");
            }
            return Controller::view("changepw");
        }
        
        public static function query() {
            if(!isset($_SESSION["sessionId"]) || !isset($_POST["submit"])) {
                return ChangePw::render();
            }

            $message = User::login($_SESSION["sessionId"], $_POST["password"]);
            if(isset($message)) {
                return Controller::view("changepw", ["message"=>$message]);
            }

            $message = User::validate($_SESSION["sessionId"], $_POST["newpass"], $_POST["confirm"], "Nguyen A", "a@gmail.com", "0123456789");
            if(isset($message)) {
                return Controller::view("changepw", ["message"=>$message]);
            }
            
            User::changepw($_SESSION["sessionId"], $_POST["newpass"]);
            return Controller::redirect("manage");
        }
    }
?>