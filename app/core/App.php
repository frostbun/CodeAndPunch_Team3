<?php
    class App {

        public function App() {
            session_start();
            $url = explode("/", filter_var(trim($_SERVER["REQUEST_URI"], "/"), FILTER_SANITIZE_URL));
            if(isset($_GET["url"])) {
                $url = explode("/", filter_var(trim($_GET["url"], "/"), FILTER_SANITIZE_URL));
            }

            $controller = "index";
            if(file_exists("../app/controllers/$url[0].php")) {
                $controller = $url[0];
                unset($url[0]);
                $url = array_values($url);
            }
            
            $method = "render";
            require_once "../app/controllers/$controller.php";
            if(method_exists($controller, $url[0])) {
                $method = $url[0];
                unset($url[0]);
                $url = array_values($url);
            }
            
            // echo "$controller $method ";
            // print_r($url);
            call_user_func_array([$controller, $method], $url);
        }
    }
?>