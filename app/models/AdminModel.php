<?php

class AdminModel
{
    use Model;
    protected $table = 'admins'; // table choice

    // columns allowed to be editable
    protected $allowedColumns = [
        'username',
        'password',
        'email'
    ];

    public function validate($data, $id = null)
    {
        $this->errors = [];

        if (empty($data['username']))
        {
            $this->errors['username'] = "Username is required";
        }else
        if (!preg_match("/^[a-zA-Z]+$/", $data['username']))
        {
            $this->errors['username'] = "Username can only have letters";
        }else
        if ($this->first(['username'=>$data['username']], ['id'=>$id])) //I want to find record with email of what user supplied AND that should not have id equal to id supplied here
        {
            $this->errors['username'] = "Username already exists";
        }

        if (!$id && empty($data['password'])) // if no id and empty pass required, if id exists then it means we're editing (we don't have to change pass)
        {
            $this->errors['password'] = "Password is required";
        }

        if (empty($data['email']))
        {
            $this->errors['email'] = "Email is required";
        }else
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        {
            $this->errors['email'] = "Email is not valid";
        }

        if(empty($this->errors))
        {
            return true;
        }

        return false;
    }

    // saving user row in our session
    public function authenticate($row)
    {
        $_SESSION['ADMIN'] = $row;
    }

    // logout/deauthenticate user
    public function logout()
    {
        if (!empty($_SESSION['ADMIN']))
            unset($_SESSION['ADMIN']);
    }

    // check if somebody is logged in
    public function logged_in()
    {
        if (!empty($_SESSION['ADMIN']))
            return true;

        return false;
    }

    // create table... could've done it through phpMyAdmin...
    public function create_table()
    {
        $query  ="CREATE TABLE IF NOT EXISTS admins(
    
            id int primary key auto_increment,
            username varchar(50) not null,
            password varchar(255) not null,
    
            key username (username)
        )";

        $this->query($query);
    }
}
