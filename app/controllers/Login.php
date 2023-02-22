<?php

class Login
{
    use Controller;

    public function index()
    {
        $data['errors'] = [];


        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $admin = new AdminModel();
            $row = $admin->first(['username' => $_POST['username']]);

            if($row)
            {
                if(password_verify($_POST['password'], $row->password))
                {
                    $admin->authenticate($row);
                    redirect('admin');
                }
            }

            $data['errors']['username'] = "Wrong email or password";
        }

        $this->view('login', $data); // ucitavanje view-a
    }
}



