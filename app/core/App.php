<?php
    class App {

        public function App() {
            $url = explode("/", filter_var(trim($_SERVER["REQUEST_URI"], "/"), FILTER_SANITIZE_URL));
            $controller = "index";
            $method = "render";

            session_start();
            
            if(isset($_GET["url"])) {
                $url = explode("/", filter_var(trim($_GET["url"], "/"), FILTER_SANITIZE_URL));
            }

            if(file_exists("../app/controllers/" . $url[0] . ".php")) {
                $controller = $url[0];
                unset($url[0]);
            }

            require_once "../app/controllers/" . $controller . ".php";
            if(isset($url[1]) && method_exists($controller, $url[1])) {
                $method = $url[1];
                unset($url[1]);
            }

            $params = $url ? array_values($url) : [];
            call_user_func_array([$controller, $method], $params);
        }
    }
?>