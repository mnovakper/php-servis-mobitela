<?php

class Admin
{
    use Controller;

    //dashboard
    public function index()
    {
        $admin = new AdminModel();
        $report = new ReportModel();

        if (!$admin->logged_in())
            redirect('login');

        $data['total_admins'] = $admin->get_row("SELECT COUNT(*) AS total FROM admins");
        $data['total_reports'] = $report->get_row("SELECT COUNT(*) AS total FROM reports");

        $this->view('admin/dashboard', $data); // loading ?admin? view
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




    //--------------- SEKCIJA S NALOZIMA-------------------
    public function reports($action = null, $id = null)
    {

        $admin = new AdminModel();
        $report = new ReportModel();

        if (!$admin->logged_in())
            redirect('login');

        $data['action'] = $action;
        $data['rows'] = $report->findAll();

        if ($action == 'new')
        {
            if ($_SERVER['REQUEST_METHOD'] == "POST") // to avoid displaying errors as soon as page loads, only will show when request method is POST
            {
                if ($report->validate($_POST))
                {
                    $report->insert($_POST);

                    redirect('admin/reports');
                }
            }
        }else
        if ($action == 'edit')
        {
            $data['row'] = $report->first(['id'=>$id]);

            if ($_SERVER['REQUEST_METHOD'] == "POST")
            {
                if ($report->validate($_POST, $id)) // we're  supplying id here, so it knows it's an edit
                {
                    $report->update($id, $_POST);

                    redirect('admin/reports');
                }
            }
        }else
        if ($action == 'delete')
        {
            $data['row'] = $report->first(['id'=>$id]);

            if ($_SERVER['REQUEST_METHOD'] == "POST")
            {
                $report->delete($id);

                redirect('admin/reports');
            }
        }

        $data['errors'] = $report->errors;

        $this->view('admin/reports', $data);
    }
}


