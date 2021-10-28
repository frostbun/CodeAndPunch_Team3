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

        public static function deleteDir($dir) {
            if(is_file($dir)) {
                return unlink($dir);
            }
            if(is_dir($dir)) {
                foreach(glob("$dir/*") as $subdir) {
                    self::deleteDir($subdir);
                }
                rmdir($dir);
            }
        }

        public static function download($path, $file) {
            $target = $path . basename($file);
            if(file_exists($target)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($file) . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($target));
                readfile($target);
                return true;
            }
            return false;
        }

        public function getById($id) {
            $stmt = $this->prepare("SELECT * FROM Upload WHERE id=?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows == 0) {
                return false;
            }
            $stmt->close();
            return $result->fetch_assoc();
        }

        public function getByAuthor($author) {
            $stmt = $this->prepare("SELECT * FROM Upload WHERE author=?");
            $stmt->bind_param("s", $author);
            $stmt->execute();
            $result = $stmt->get_result();
            $file = [];
            for($i=0; $i<$result->num_rows; ++$i) {
                array_push($file, $result->fetch_assoc());
            }
            $stmt->close();
            return $file;
        }

        public function insert($author, $path, $deadline, $hint) {
            $stmt = $this->prepare("INSERT INTO Upload (author, path, deadline, hint) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $author, $path, $deadline, htmlspecialchars($hint));
            $stmt->execute();
            $stmt->close();
        }

        public function delete($id) {
            $stmt = $this->prepare("DELETE FROM Upload WHERE id=?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $stmt->close();
        }
    }
?>