<?php
    class Index extends Controller {

        public static function render() {
            return self::view("index");
        }

        public static function logout() {
            User::logout();
            return self::redirect("index");
        }

        public static function delete($user = "") {
            if($_SESSION["user"] === User::getByUsername($user)["teacher"]) {
                User::delete($user);
                File::deleteDir("../uploads/handin/$user");
            }
            return self::redirect("manage");
        }
    }
?>