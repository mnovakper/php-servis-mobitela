<?php

class Logout
{
    use Controller;

    public function index()
    {
        $admin = new AdminModel();
        $admin->logout();

        redirect('login');
    }
}