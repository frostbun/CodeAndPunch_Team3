<?php
    class File extends Model {

        public static function upload($path, $file) {
            $allow = ["text/plain", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"];
            $target = $path . basename($file["name"]);

            if($file["error"]) {
                return "There was an error uploading your file!";
            }

            if(!in_array($file["type"], $allow)) {
                return "Only PDF, DOC, DOCX, TXT are allowed!";
            }

            if($file["size"] > 10000000) {
                return "Your file is too large!";
            }

            if(file_exists($target)) {
                return "File existed, rename your file and try again!";
            }

            if(!file_exists($path) && !mkdir($path, 0777, true) || !move_uploaded_file($file["tmp_name"], $target)) {
                die("Opsss!");
            }

            return $target;
        }

        public static function download($path, $file) {
            $target = $path . basename($file);
            echo $target;
            if(file_exists($target)) {
                header("Content-Type: application/octet-stream");
                header("Content-Transfer-Encoding: Binary"); 
                header("Content-disposition: attachment; filename=\"" . basename($file) . "\""); 
                readfile($target);
            }
        }

        public static function getById($id) {
            $db = Model::connect();
            $stmt = $db->prepare("SELECT * FROM Upload WHERE id=?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows == 0) {
                return false;
            }
            $stmt->close();
            $db->close();
            return $result->fetch_assoc();
        }

        public static function getByAuthor($author) {
            $db = Model::connect();
            $stmt = $db->prepare("SELECT * FROM Upload WHERE author=?");
            $stmt->bind_param("s", $author);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows == 0) {
                return false;
            }
            $file = [];
            for($i=0; $i<$result->num_rows; ++$i) {
                array_push($file, $result->fetch_assoc());
            }
            $stmt->close();
            $db->close();
            return $file;
        }

        public static function insert($author, $path, $deadline, $hint) {
            $db = Model::connect();
            $stmt = $db->prepare("INSERT INTO Upload (author, path, deadline, hint) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $author, $path, $deadline, $hint);
            $stmt->execute();
            $stmt->close();
            $db->close();
        }
    }
?>