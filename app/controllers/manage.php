<?php
    class Manage extends Controller {

        private Message $Message;

        public function __construct() {
            parent::__construct();
            $this->Message = self::model("Message");
        }

        public function render() {
            if(!isset($_SESSION["user"])) {
                return self::redirect("login");
            }
            $teacherUsername = $this->User->getByUsername($_SESSION["user"])["teacher"];
            $teacher = $this->User->getByUsername($teacherUsername);
            $studentList = $this->User->getByTeacher($teacherUsername);
            foreach($studentList as &$student) {
                $student["buttonType"] = sizeof($this->Message->getUnread($_SESSION["user"], $student["username"])) ? "btn-success" : "btn-outline-primary";
            }
            $teacher["buttonType"] = sizeof($this->Message->getUnread($_SESSION["user"], $teacher["username"])) ? "btn-success" : "btn-outline-primary";
            return self::view("manage", ["student"=>$studentList, "teacher"=>$teacher]);
        }
    }
?>