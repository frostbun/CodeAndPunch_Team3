<?php
    class Register extends Controller {

        public function render() {
            if(!Controller::loggedIn()) {
                Controller::view("register");
            }
        }

        public function query() {
            if(Controller::loggedIn()) {
                return;
            }
            if(isset($_POST["submit"])) {
                require_once "app/models/User.php";
                
                $message = User::validate($_POST["username"], $_POST["password"], $_POST["confirm"], $_POST["fullname"], $_POST["email"], $_POST["phone"]);
                if($message != "ok") {
                    Controller::view("register", ["message"=>$message]);
                    return;
                }
                
                if(User::getByUsername("Teacher", $_POST["username"])) {
                    Controller::view("register", ["message"=>"User existed"]);
                    return;
                }

                User::insert("Teacher", $_POST["username"], $_POST["password"], $_POST["fullname"], $_POST["email"], $_POST["phone"]);
                User::login("Teacher", $_POST["username"], $_POST["password"]);
                Controller::view("index", [["message"=>"You are logged in as $_SESSION[sessionUser]"]]);
                return;
            }
            Controller::view("register");
        }
    }
?>