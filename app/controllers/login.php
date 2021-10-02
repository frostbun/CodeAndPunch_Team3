<?php
    class Login extends Controller{

        public function render() {
            if(isset($_SESSION["sessionId"])) {
                Controller::view("index", ["message"=>"You are logged in"]);
                return;
            }
            Controller::view("login");
        }

        public function query() {
            if(isset($_SESSION["sessionId"])) {
                Controller::view("index", ["message"=>"You are logged in"]);
                return;
            }
            if(isset($_POST["submit"])) {
                require_once "app/models/User.php";
                
                $message = User::login("Teacher", $_POST["username"], $_POST["password"]);
                if($message != "ok") {
                    Controller::view("login", ["message"=>$message]);
                    return;
                }
                Controller::view("index", ["message"=>"You are logged in"]);
                return;
            }
            Controller::view("login");
        }
    }
?>