<?php
    class Chat extends Controller {

        public static function render($otherUser = "") {
            if(!isset($_SESSION["user"])) {
                return Controller::redirect("login");
            }
            if(Teacher::getByUsername($otherUser)===false && Student::getByUsername($otherUser)===false) {
                return Controller::redirect("manage");
            }
            $message = Message::getBy2User($otherUser, $_SESSION["user"]);
            return Controller::view("chat", ["message"=>$message, "otherUser"=>$otherUser]);
        }

        public static function query($otherUser = "") {
            if(!isset($_SESSION["user"]) || !isset($_POST["submit"])) {
                return Chat::render($otherUser);
            }
            if(Teacher::getByUsername($otherUser)===false && Student::getByUsername($otherUser)===false) {
                return Controller::redirect("manage");
            }
            if(strlen($_POST["text"])) {
                Message::insert($_SESSION["user"], $otherUser, $_POST["text"]);
            }
            return Chat::render($otherUser);
        }

        public static function delete($otherUser = "", $id = -1) {
            $message = Message::getById($id);
            if($message["sender"] == $_SESSION["user"]) {
                Message::delete($id);
            }
            return Chat::render($otherUser);
        }

        public static function edit($otherUser = "", $id = -1) {
            $message = Message::getById($id);
            if($message["sender"] == $_SESSION["user"] && strlen($_POST["text"])) {
                Message::update($id, $_POST["text"]);
            }
            return Chat::render($otherUser);
        }
    }
?>