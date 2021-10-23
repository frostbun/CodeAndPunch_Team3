<?php
    class Edit extends Controller {

        public static function render($user = "") {
            if(!isset($_SESSION["user"])) {
                return self::redirect("login");
            }
            if($user === $_SESSION["user"] || User::getByUsername($user)["teacher"] === $_SESSION["user"]) {
                $user = User::getByUsername($user);
                return self::view("edit", ["user"=>$user]);
            }
            return self::redirect("manage");
        }
        
        public static function query($user = "") {
            if(!isset($_SESSION["user"]) || !isset($_POST["submit"])) {
                return self::redirect("edit", [$user]);
            }
            if($user === $_SESSION["user"] || User::getByUsername($user)["teacher"] === $_SESSION["user"]) {
                $_POST["username"] = $user;
                $_POST["fullname"] = $_SESSION["type"] === "Teacher" ? $_POST["fullname"] : User::getByUsername($user)["fullname"];
                $message = User::validate($_POST["username"], "AAaa00!!", "AAaa00!!", $_POST["fullname"], $_POST["email"], $_POST["phone"]);
                if(isset($message)) {
                    return self::view("edit", ["message"=>$message, "user"=>$_POST]);
                }
                User::update($_POST["username"], $_POST["fullname"], $_POST["email"], $_POST["phone"]);
            }
            return self::redirect("manage");
        }
    }
?>