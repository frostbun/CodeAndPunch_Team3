<?php
    class Edit extends Controller {

        public static function render($user = "") {
            if(!isset($_SESSION["user"])) {
                return Controller::redirect("login");
            }
            
            if($user === $_SESSION["user"] ||
                ($_SESSION["type"] === "Teacher" &&
                Student::getByUsername($user)["teacher"] === $_SESSION["user"])
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
        
        public static function query($user = "") {
            if(!isset($_SESSION["user"]) || !isset($_POST["submit"])) {
                return Controller::redirect("edit", [$user]);
            }

            $_POST["fullname"] = $_SESSION["type"] === "Teacher" ? $_POST["fullname"] : Student::getByUsername($user)["fullname"];
            $message = User::validate($user, "AAaa12@#", "AAaa12@#", $_POST["fullname"], $_POST["email"], $_POST["phone"]);
            if(isset($message)) {
                return Controller::view("edit", ["message"=>$message, "user"=>$_POST]);
            }
            
            if($user === $_SESSION["user"] ||
                ($_SESSION["type"] === "Teacher" &&
                Student::getByUsername($user)["teacher"] === $_SESSION["user"])
            ) {
                User::update($user, $_POST["fullname"], $_POST["email"], $_POST["phone"]);
            }
            
            return Controller::redirect("manage");
        }
    }
?>