<?php

class Home
{
    use Controller;

    public function index()
    {
        $this->view('home/landing'); // ucitavanje view-a
    }
}

