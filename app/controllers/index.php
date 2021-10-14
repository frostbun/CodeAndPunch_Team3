<?php
    class Index extends Controller {

        public static function render() {
            return Controller::view("index");
        }

        public static function logout() {
            User::logout();
            return Controller::redirect("index");
        }

        public static function delete($user = "") {
            if($_SESSION["type"]==="Teacher" && Student::getByUsername($user)["teacher"]===$_SESSION["user"]) {
                Student::delete($user);
                if(file_exists("../uploads/handin/$user/")) {
                    File::deleteDir("../uploads/handin/$user/");
                }
                Message::deleteByUsername($user);
            }
            return Controller::redirect("manage");
        }
    }
?>