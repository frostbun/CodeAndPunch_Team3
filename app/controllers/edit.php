<?php
    class Edit extends Controller {

        public static function render($user = null) {
            if(!isset($_SESSION["sessionId"])) {
                require_once "app/controllers/login.php";
                return Login::render();
            }
            
            if($user == $_SESSION["sessionId"] ||
                ($_SESSION["sessionType"] == "Teacher" &&
                Student::getByUsername($user)["teacher"] == $_SESSION["sessionId"])
            ) {
                if(Teacher::getByUsername($user)) {
                    $user = Teacher::getByUsername($user);
                }
                else {
                    $user = Student::getByUsername($user);
                }
                return Controller::view("edit", ["user"=>$user]);
            }
            
            require_once "app/controllers/manage.php";
            return Manage::render();
        }
        
        public static function query($user = null) {
            if(!isset($_SESSION["sessionId"]) || !isset($_POST["submit"])) {
                return Edit::render($user);
            }

            $_POST["username"] = $user;
            $_POST["fullname"] = $_SESSION["sessionType"] == "Teacher" ? $_POST["fullname"] : Student::getByUsername($user)["fullname"];
            $message = User::validate($user, "AAaa12@#", "AAaa12@#", $_POST["fullname"], $_POST["email"], $_POST["phone"]);
            if(isset($message)) {
                return Controller::view("edit", ["message"=>$message, "user"=>$_POST]);
            }
            
            if($user == $_SESSION["sessionId"] ||
                ($_SESSION["sessionType"] == "Teacher" &&
                Student::getByUsername($user)["teacher"] == $_SESSION["sessionId"])
            ) {
                User::update($user, $_POST["fullname"], $_POST["email"], $_POST["phone"]);
            }
            
            require_once "app/controllers/manage.php";
            return Manage::render();
        }
    }
?>