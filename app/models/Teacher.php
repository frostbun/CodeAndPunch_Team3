<?php
    class Teacher extends User {

        public static function getByUsername($username) {
            $db = Model::connect();
            $stmt = $db->prepare("SELECT * FROM Teacher WHERE username=?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows == 0) {
                return false;
            }
            $stmt->close();
            $db->close();
            return $result->fetch_assoc();
        }

        public static function insert($username, $password, $fullname, $email, $phone) {
            $db = Model::connect();
            $password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $db->prepare("INSERT INTO Teacher (username, password, fullname, email, phone) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $username, $password, $fullname, $email, $phone);
            $stmt->execute();
            $stmt->close();
            $db->close();
        }
    }
?>