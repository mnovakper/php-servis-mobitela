<?php

class App
{
    private $controller = 'Home'; // zadano ime controller fajla
    private $method = 'index'; // zadano ime metode (metode u controller fajlu)

    // razdvajanje url-a
    private function splitURL()
    {
        $URL = $_GET['url'] ?? 'home'; // ako ne postoji - home
        $URL = explode("/", trim($URL,"/"));
        return $URL;
    }

    // pronalazak controller fajla na temelju prve stavke u nizu
    public function load_controller()
    {
        $URL = $this->splitURL();

        // odabir controllera
        $filename = "../app/controllers/".ucfirst($URL[0]).".php";
        if(file_exists($filename))
        {
            require $filename; // ucitavanje controller fajla
            $this->controller = ucfirst($URL[0]); // ime controllera
            unset($URL[0]);
        } else {
            $filename = "../app/controllers/_404.php";
            require $filename;
            $this->controller = "_404";
        }

        $controller = new $this->controller;

        // odabir metode (prvi param ime controller fajla, drugi param ime metode)
        if (!empty($URL[1]))
        {
            if (method_exists($controller, $URL[1]))
            {
                $this->method = $URL[1];
                unset($URL[1]);
            }
        }
        call_user_func_array([$controller, $this->method], $URL); // prvi param je objekt (controller koji ce se ucitati), a drugi je ime metode koja ce se ucitati
    }
}
