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
            if(!isset($_SESSION["user"])) {
                return Controller::redirect("login");
            }
            if($_SESSION["type"] == "Teacher" && Student::getByUsername($user)["teacher"] == $_SESSION["user"]) {
                Student::delete($user);
            }
            return Controller::redirect("manage");
        }
    }
?>