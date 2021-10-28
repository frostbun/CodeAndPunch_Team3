<?php
    class Download extends Controller {

        public function __construct() {
            self::model("File");
        }
        
        public function render() {
            self::redirect("index");
        }

        public function homework($file = "") {
            $teacher = $this->User->getByUsername($_SESSION["user"])["teacher"];
            if(!File::download("../uploads/homework/$teacher/", $file)) {
                self::redirect("homework");
            }
        }
        
        public function handin($student = "", $id = -1, $file = "") {
            if($_SESSION["user"] === $this->User->getByUsername($student)["teacher"]) {
                if(!File::download("../uploads/handin/$student/$id/", $file)) {
                    self::redirect("homework");
                }
            }
        }
    }
?>