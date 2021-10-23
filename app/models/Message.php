<?php
    class Message extends Model {

        public static function getBy2User($u1, $u2) {
            $db = self::connect();
            $stmt = $db->prepare("SELECT * FROM Message WHERE (sender=? AND receiver=?) OR (sender=? AND receiver=?) ORDER BY datetime DESC");
            $stmt->bind_param("ssss", $u1, $u2, $u2, $u1);
            $stmt->execute();
            $result = $stmt->get_result();
            $message = [];
            for($i=0; $i<$result->num_rows; ++$i) {
                array_push($message, $result->fetch_assoc());
            }
            $stmt->close();
            $db->close();
            return $message;
        }

        public static function getById($id) {
            $db = self::connect();
            $stmt = $db->prepare("SELECT * FROM Message WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows == 0) {
                return false;
            }
            $stmt->close();
            $db->close();
            return $result->fetch_assoc();
        }
        
        public static function insert($sender, $receiver, $content) {
            $db = self::connect();
            $stmt = $db->prepare("INSERT INTO Message (sender, receiver, content) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $sender, $receiver, $content);
            $stmt->execute();
            $stmt->close();
            $db->close();
        }

        public static function update($id, $content) {
            $db = self::connect();
            $stmt = $db->prepare("UPDATE Message SET content=?, unread=1 WHERE id=?");
            $stmt->bind_param("si", $content, $id);
            $stmt->execute();
            $stmt->close();
            $db->close();
        }

        public static function delete($id) {
            $db = self::connect();
            $stmt = $db->prepare("DELETE FROM Message WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
            $db->close();
        }

        public static function getUnread($u1, $u2) {
            $db = self::connect();
            $stmt = $db->prepare("SELECT * FROM Message WHERE sender=? AND receiver=? AND unread=1");
            $stmt->bind_param("ss", $u2, $u1);
            $stmt->execute();
            $result = $stmt->get_result();
            $message = [];
            for($i=0; $i<$result->num_rows; ++$i) {
                array_push($message, $result->fetch_assoc());
            }
            $stmt->close();
            $db->close();
            return $message;
        }

        public static function setRead($u1, $u2) {
            $db = self::connect();
            $stmt = $db->prepare("UPDATE Message SET unread=0 WHERE sender=? AND receiver=?");
            $stmt->bind_param("ss", $u2, $u1);
            $stmt->execute();
            $stmt->close();
            $db->close();
        }
    }
?>