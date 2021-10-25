<?php
    class Message extends Model {

        public function getBy2User($u1, $u2) {
            $stmt = $this->prepare("SELECT * FROM Message WHERE (sender=? AND receiver=?) OR (sender=? AND receiver=?) ORDER BY datetime DESC");
            $stmt->bind_param("ssss", $u1, $u2, $u2, $u1);
            $stmt->execute();
            $result = $stmt->get_result();
            $message = [];
            for($i=0; $i<$result->num_rows; ++$i) {
                array_push($message, $result->fetch_assoc());
            }
            $stmt->close();
            return $message;
        }

        public function getById($id) {
            $stmt = $this->prepare("SELECT * FROM Message WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows == 0) {
                return false;
            }
            $stmt->close();
            return $result->fetch_assoc();
        }
        
        public function insert($sender, $receiver, $content) {
            $stmt = $this->prepare("INSERT INTO Message (sender, receiver, content) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $sender, $receiver, $content);
            $stmt->execute();
            $stmt->close();
        }

        public function update($id, $content) {
            $stmt = $this->prepare("UPDATE Message SET content=?, unread=1 WHERE id=?");
            $stmt->bind_param("si", $content, $id);
            $stmt->execute();
            $stmt->close();
        }

        public function delete($id) {
            $stmt = $this->prepare("DELETE FROM Message WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }

        public function getUnread($u1, $u2) {
            $stmt = $this->prepare("SELECT * FROM Message WHERE sender=? AND receiver=? AND unread=1");
            $stmt->bind_param("ss", $u2, $u1);
            $stmt->execute();
            $result = $stmt->get_result();
            $message = [];
            for($i=0; $i<$result->num_rows; ++$i) {
                array_push($message, $result->fetch_assoc());
            }
            $stmt->close();
            return $message;
        }

        public function setRead($u1, $u2) {
            $stmt = $this->prepare("UPDATE Message SET unread=0 WHERE sender=? AND receiver=?");
            $stmt->bind_param("ss", $u2, $u1);
            $stmt->execute();
            $stmt->close();
        }
    }
?>