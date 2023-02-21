<?php

class Admin
{
    use Controller;

    //dashboard
    public function index()
    {
        $admin = new AdminModel();

        if (!$admin->logged_in())
            redirect('login');

        $this->view('admin/dashboard'); // loading ?admin? view
    }

    public function admins($action = null, $id = null)
    {
        $admin = new AdminModel();

        if (!$admin->logged_in())
            redirect('login');

        $data['action'] = $action;
        $data['rows'] = $admin->findAll();

        if ($action == 'new')
        {
            if ($_SERVER['REQUEST_METHOD'] == "POST") // to avoid displaying errors as soon as page loads, only will show when request method is POST
            {
                if ($admin->validate($_POST))
                {
                    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $admin->insert($_POST);

                    redirect('admin/admins');
                }
            }
        }else
        if ($action == 'edit')
        {
            $data['row'] = $admin->first(['id'=>$id]);

            if ($_SERVER['REQUEST_METHOD'] == "POST")
            {
                if ($admin->validate($_POST, $id)) // we're  supplying id here, so it knows it's an edit
                {
                    if (empty($_POST['password']))
                    {
                        unset($_POST['password']);
                    }else{
                        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    }

                    $admin->update($id, $_POST);

                    redirect('admin/admins');
                }
            }
        }else
        if ($action == 'delete')
        {
            $data['row'] = $admin->first(['id'=>$id]);

            if ($_SERVER['REQUEST_METHOD'] == "POST")
            {
                $admin->delete($id);

                redirect('admin/admins');
            }
        }

        $data['errors'] = $admin->errors;

        $this->view('admin/admins', $data);
    }

    public function reports()
    {
        $this->view('admin/reports');
    }
}


