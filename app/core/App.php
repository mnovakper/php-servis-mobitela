<?php

class App
{
    private $controller = 'Home';
    private $method = 'index';

    // separate url into strings, so we can figure out destination
    private function splitURL()
    {
        $URL = $_GET['url'] ?? 'home'; // if it doesn't exist, make it home
        $URL = explode("/", trim($URL,"/"));
        return $URL;
    }

    // finding right controller file based on first item in array (splitURL)
    public function load_controller()
    {
        $URL = $this->splitURL();

        // controller select
        $filename = "../app/controllers/".ucfirst($URL[0]).".php";
        if(file_exists($filename))
        {
            require $filename; // load controller file
            $this->controller = ucfirst($URL[0]); // controller name
            unset($URL[0]);
        } else {
            $filename = "../app/controllers/_404.php";
            require $filename;
            $this->controller = "_404";
        }

        $controller = new $this->controller;

        // method select
        if (!empty($URL[1]))
        {
            if (method_exists($controller, $URL[1]))
            {
                $this->method = $URL[1];
                unset($URL[1]);
            }
        }
        call_user_func_array([$controller, $this->method], $URL); // first param is object (which controller to load), second param is method name to load
    }
}
