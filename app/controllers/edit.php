<?php
    class Edit extends Controller {

        public static function render($user = null) {
            if(!isset($_SESSION["sessionId"])) {
                require_once "app/controllers/login.php";
                return Login::render();
            }

            if(!isset($user)) {
                require_once "app/controllers/manage.php";
                return Manage::render();
            }

            if($_SESSION["sessionType"] == "Student") {
                //hoc sinh edit ban than
                if($user == $_SESSION["sessionId"]) {
                    $user = Student::getByUsername($user);
                    return Controller::view("edit", ["user"=>$user]);
                }
                //hoc sinh edit nguoi khac
                else {
                    require_once "app/controllers/manage.php";
                    return Manage::render();
                }
            }
            //giao vien edit ban than
            if($user == $_SESSION["sessionId"]) {
                $user = Teacher::getByUsername($user);
                return Controller::view("edit", ["user"=>$user]);
            }
            //giao vien edit hoc sinh trong lop
            if(Student::getByUsername($user)["teacher"] == $_SESSION["sessionId"]) {
                $user = Student::getByUsername($user);
                return Controller::view("edit", ["user"=>$user]);
            }
            //giao vien edit hs ngoai lop hoac giao vien khac
            require_once "app/controllers/manage.php";
            return Manage::render();
        }
        
        public static function query($user = null) {
            if(!isset($_SESSION["sessionId"]) || !isset($user) || !isset($_POST["submit"])) {
                return Edit::render();
            }

            $_POST["username"] = $user;
            $_POST["fullname"] = $_SESSION["sessionType"] == "Teacher" ? $_POST["fullname"] : Student::getByUsername($user)["fullname"];
            $message = User::validate($user, "AAaa12@#", "AAaa12@#", $_POST["fullname"], $_POST["email"], $_POST["phone"]);
            if($message != "ok") {
                return Controller::view("edit", ["message"=>$message, "user"=>$_POST]);
            }
            
            if($_SESSION["sessionType"] == "Student") {
                //hoc sinh edit ban than
                if($user == $_SESSION["sessionId"]) {
                    Student::update($_POST["username"], $_POST["fullname"], $_POST["email"], $_POST["phone"]);
                }
            }

            if($_SESSION["sessionType"] == "Teacher") {
                //giao vien edit ban than
                if($user == $_SESSION["sessionId"]) {
                    Teacher::update($_POST["username"], $_POST["fullname"], $_POST["email"], $_POST["phone"]);
                }
                //giao vien edit hoc sinh trong lop
                if(Student::getByUsername($user)["teacher"] == $_SESSION["sessionId"]) {
                    Student::update($_POST["username"], $_POST["fullname"], $_POST["email"], $_POST["phone"]);
                }
            }

            return Edit::render();
        }
    }
?>