<?php
    class Index extends Controller {

        public static function render() {
            if(isset($_SESSION["sessionId"])) {
                return Controller::view("index", ["message"=>"You are logged in as $_SESSION[sessionId]"]);
            }
            return Controller::view("index", ["message"=>"You are logged out"]);
        }
    }
?>