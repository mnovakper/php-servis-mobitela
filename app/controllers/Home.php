<?php

class Home
{
    use Controller;

    public function index()
    {
        //echo "Home page Controller";
        $this->view('home'); // loading ?home? view
        // if we want to put views inside folders we can write above line like $this->view('products/products');
    }
}

