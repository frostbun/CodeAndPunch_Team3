<?php
    class AddStudent extends Controller {

        public function render() {
            if(!isset($_SESSION["user"])) {
                return self::redirect("login");
            }
            if($_SESSION["type"] !== "Teacher") {
                return self::redirect("manage");
            }
            return self::view("addstudent");
        }
        
        public function query() {
            if(!isset($_SESSION["user"]) || $_SESSION["type"] !== "Teacher" || !isset($_POST["submit"])) {
                return self::redirect("addstudent");
            }

            $message = User::validate($_POST["username"], $_POST["password"], $_POST["confirm"], $_POST["fullname"], $_POST["email"], $_POST["phone"]);
            if(isset($message)) {
                return self::view("addstudent", ["message"=>$message, "user"=>$_POST]);
            }
            
            if($this->User->getByUsername($_POST["username"]) !== false) {
                return self::view("addstudent", ["message"=>"User existed", "user"=>$_POST]);
            }

            $this->User->insert($_POST["username"], $_POST["password"], $_POST["fullname"], $_POST["email"], $_POST["phone"], $_SESSION["user"]);
            return self::redirect("manage");
        }
    }
?>