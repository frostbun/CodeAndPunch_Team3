<?php
    class Edit extends Controller {

        public static function render($user = "") {
            if(!isset($_SESSION["user"])) {
                return Controller::redirect("login");
            }
            
            if($user == $_SESSION["user"] ||
                ($_SESSION["type"] == "Teacher" &&
                Student::getByUsername($user)["teacher"] == $_SESSION["user"])
            ) {
                if(Teacher::getByUsername($user)) {
                    $user = Teacher::getByUsername($user);
                }
                else {
                    $user = Student::getByUsername($user);
                }
                return Controller::view("edit", ["user"=>$user]);
            }
            
            return Controller::redirect("manage");
        }
        
        public static function query() {
            if(!isset($_SESSION["user"]) || !isset($_POST["submit"])) {
                return Edit::render($_POST["username"]);
            }

            $_POST["fullname"] = $_SESSION["type"] == "Teacher" ? $_POST["fullname"] : Student::getByUsername($_POST["username"])["fullname"];
            $message = User::validate($_POST["username"], "AAaa12@#", "AAaa12@#", $_POST["fullname"], $_POST["email"], $_POST["phone"]);
            if(isset($message)) {
                return Controller::view("edit", ["message"=>$message, "user"=>$_POST]);
            }
            
            if($_POST["username"] == $_SESSION["user"] ||
                ($_SESSION["type"] == "Teacher" &&
                Student::getByUsername($_POST["username"])["teacher"] == $_SESSION["user"])
            ) {
                User::update($_POST["username"], $_POST["fullname"], $_POST["email"], $_POST["phone"]);
            }
            
            return Controller::redirect("manage");
        }
    }
?>