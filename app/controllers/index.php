<?php
    class Index extends Controller{

        public function render() {
            if(isset($_SESSION["sessionId"])) {
                Controller::view("index", ["message"=>"You are logged in"]);
                return;
            }
            Controller::view("index", ["message"=>"Home"]);
        }
    }
?>