<?php
    abstract class Controller {

        public function Controller() {
            session_start();
        }
        
        public abstract function render();

        public static function view($view, $data = []) {
            require_once "app/views/" . $view . ".php";
        }

        public static function loggedIn() {
            if(isset($_SESSION["sessionId"])) {
                Controller::view("index", ["message"=>"You are logged in as $_SESSION[sessionUser]"]);
                return true;
            }
            return false;
        }

        public static function loggedOut() {
            if(!isset($_SESSION["sessionId"])) {
                Controller::view("login");
                return true;
            }
            return false;
        }
    }
?>