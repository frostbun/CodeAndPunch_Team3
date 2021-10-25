<?php
    class Chat extends Controller {

        private Message $Message;

        public function Chat() {
            $this->Message = self::model("Message");
        }

        public function render($otherUser = "") {
            if(!isset($_SESSION["user"])) {
                return self::redirect("login");
            }
            if(!$this->User->isSameTeacher($_SESSION["user"], $otherUser)) {
                return self::redirect("manage");
            }
            $message = $this->Message->getBy2User($_SESSION["user"], $otherUser);
            $this->Message->setRead($_SESSION["user"], $otherUser);
            return self::view("chat", ["message"=>$message, "otherUser"=>$otherUser]);
        }

        public function query($otherUser = "") {
            if(!isset($_SESSION["user"]) || !$this->User->isSameTeacher($_SESSION["user"], $otherUser) || !isset($_POST["submit"])) {
                return self::redirect("chat", [$otherUser]);
            }
            if(strlen($_POST["text"])) {
                $this->Message->insert($_SESSION["user"], $otherUser, $_POST["text"]);
            }
            return self::redirect("chat", [$otherUser]);
        }

        public function delete($otherUser = "", $id = -1) {
            $message = $this->Message->getById($id);
            if($message["sender"] === $_SESSION["user"]) {
                $this->Message->delete($id);
            }
            return self::redirect("chat", [$otherUser]);
        }

        public function edit($otherUser = "", $id = -1) {
            $message = $this->Message->getById($id);
            if($message["sender"] === $_SESSION["user"] && strlen($_POST["text"])) {
                $this->Message->update($id, $_POST["text"]);
            }
            return self::redirect("chat", [$otherUser]);
        }
    }
?>