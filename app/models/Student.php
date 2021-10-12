<?php
    class Student extends User {

        public static function getByTeacher($teacher) {
            $db = Model::connect();
            $stmt = $db->prepare("SELECT * FROM Student WHERE teacher=? ORDER BY fullname ASC");
            $stmt->bind_param("s", $teacher);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows == 0) {
                return false;
            }
            $user = [];
            for($i=0; $i<$result->num_rows; ++$i) {
                array_push($user, $result->fetch_assoc());
            }
            $stmt->close();
            $db->close();
            return $user;
        }

        public static function getByUsername($username) {
            $db = Model::connect();
            $stmt = $db->prepare("SELECT * FROM Student WHERE username=?");
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

        public static function insert($teacher, $username, $password, $fullname, $email, $phone) {
            $db = Model::connect();
            $password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $db->prepare("INSERT INTO Student (teacher, username, password, fullname, email, phone) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $teacher, $username, $password, $fullname, $email, $phone);
            $stmt->execute();
            $stmt->close();
            $db->close();
        }

        public static function delete($username) {
            $db = Model::connect();
            $stmt = $db->prepare("DELETE FROM Student WHERE username=?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->close();
            $db->close();
        }
    }
?>