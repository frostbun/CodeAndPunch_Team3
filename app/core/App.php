<?php
    class App {

        private $controller = "index";
        private $method = "render";
        private $params = [];

        public function App() {
            $url = explode("/", filter_var(trim($_SERVER["REQUEST_URI"], "/"), FILTER_SANITIZE_URL));
            if(file_exists("app/controllers/" . $url[0] . ".php")) {
                $this->controller = $url[0];
                unset($url[0]);
            }
            require_once "app/controllers/" . $this->controller . ".php";
            $this->controller = new $this->controller();
            if(isset($url[1]) && method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
            $this->params = $url ? array_values($url) : [];
            call_user_func_array([$this->controller, $this->method], $this->params);
        }
    }
?>