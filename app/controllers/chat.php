<?php
    class Chat extends Controller {

        public static function render($otherUser = "") {
            if(!isset($_SESSION["user"])) {
                return self::redirect("login");
            }
            if(User::getByUsername($otherUser) === false) {
                return self::redirect("manage");
            }
            $message = Message::getBy2User($_SESSION["user"], $otherUser);
            Message::setRead($_SESSION["user"], $otherUser);
            return self::view("chat", ["message"=>$message, "otherUser"=>$otherUser]);
        }

        public static function query($otherUser = "") {
            if(!isset($_SESSION["user"]) || User::getByUsername($otherUser) === false || !isset($_POST["submit"])) {
                return self::redirect("chat", [$otherUser]);
            }
            if(strlen($_POST["text"])) {
                Message::insert($_SESSION["user"], $otherUser, $_POST["text"]);
            }
            return self::redirect("chat", [$otherUser]);
        }

        public static function delete($otherUser = "", $id = -1) {
            $message = Message::getById($id);
            if($message["sender"] === $_SESSION["user"]) {
                Message::delete($id);
            }
            return self::redirect("chat", [$otherUser]);
        }

        public static function edit($otherUser = "", $id = -1) {
            $message = Message::getById($id);
            if($message["sender"] === $_SESSION["user"] && strlen($_POST["text"])) {
                Message::update($id, $_POST["text"]);
            }
            return self::redirect("chat", [$otherUser]);
        }
    }
?>