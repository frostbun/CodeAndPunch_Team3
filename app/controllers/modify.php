<?php
    class Modify extends Controller {

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
                //hoc sinh modify ban than
                if($user == $_SESSION["sessionId"]) {
                    $user = Student::getByUsername($user);
                    return Controller::view("modify", ["user"=>$user]);
                }
                //hoc sinh modify nguoi khac
                else {
                    require_once "app/controllers/manage.php";
                    return Manage::render();
                }
            }
            //giao vien modify ban than
            if($user == $_SESSION["sessionId"]) {
                $user = Teacher::getByUsername($user);
                return Controller::view("modify", ["user"=>$user]);
            }
            //giao vien modify hoc sinh trong lop
            if(Student::getByUsername($user)["teacher"] == $_SESSION["sessionId"]) {
                $user = Student::getByUsername($user);
                return Controller::view("modify", ["user"=>$user]);
            }
            //giao vien modify hs ngoai lop hoac giao vien khac
            require_once "app/controllers/manage.php";
            return Manage::render();
        }
        
        public static function query($user = null) {
            if(!isset($_SESSION["sessionId"]) || !isset($user) || !isset($_POST["submit"])) {
                return Modify::render();
            }

            // $message = User::validate($_POST["username"], $_POST["password"], $_POST["confirm"], $_POST["fullname"], $_POST["email"], $_POST["phone"]);
            // if($message != "ok") {
            //     return Controller::view("addstudent", ["message"=>$message]);
            // }
            
            // if(Teacher::getByUsername($_POST["username"]) || Student::getByUsername($_POST["username"])) {
            //     return Controller::view("addstudent", ["message"=>"User existed"]);
            // }

            // Student::insert($_SESSION["sessionId"], $_POST["username"], $_POST["password"], $_POST["fullname"], $_POST["email"], $_POST["phone"]);
            // require_once "app/controllers/manage.php";
            // return Manage::render();
        }
    }
?>