<?php
    class Index extends Controller {

        public function render() {
            if(!Controller::loggedIn()) {
                Controller::view("index", ["message"=>"You are logged out"]);
            }
        }
    }
?>