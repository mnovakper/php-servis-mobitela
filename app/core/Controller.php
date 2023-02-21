<?php

trait Controller
{
    // used for loading views
    public function view($name, $data = [])
    {
        if (!empty($data))
            extract($data);
            
        $filename = "../app/views/".$name.".view.php";
        if(file_exists($filename)) {
            require $filename; // load controller file
        } else {
            $filename = "../app/views/404.view.php";
            require $filename;
        }
    }
}