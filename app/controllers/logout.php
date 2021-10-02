<?php
    class Logout extends Controller{

        public function render() {
            require_once "app/models/User.php";

            User::logout();
            Controller::view("index", ["message"=>"You are logged out"]);
        }
    }
?>