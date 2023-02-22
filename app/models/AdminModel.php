<?php

class AdminModel
{
    use Model;
    protected $table = 'admins'; // odabrana tablica

    // editable stupci
    protected $allowedColumns = [
        'username',
        'password',
        'email'
    ];

    // provjera input podataka
    public function validate($data, $id = null)
    {
        $this->errors = [];

        if (empty($data['username']))
        {
            $this->errors['username'] = "Korisničko ime je obavezno";
        }else
        if (!preg_match("/^[a-zA-Z]+$/", $data['username']))
        {
            $this->errors['username'] = "Korisničko ime može sadržavati samo slova";
        }else
        if ($this->first(['username'=>$data['username']], ['id'=>$id]))
        {
            $this->errors['username'] = "Korisničko ime već postoji";
        }

        if (!$id && empty($data['password'])) // ako id postoji znaci da editiramo
        {
            $this->errors['password'] = "Lozinka je obavezna";
        }

        if (empty($data['email']))
        {
            $this->errors['email'] = "Email je obavezan";
        }else
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        {
            $this->errors['email'] = "Email nije valjan";
        }

        if(empty($this->errors))
        {
            return true;
        }

        return false;
    }

    // spremanje admin row u sesiju
    public function authenticate($row)
    {
        $_SESSION['ADMIN'] = $row;
    }

    // logout admina
    public function logout()
    {
        if (!empty($_SESSION['ADMIN']))
            unset($_SESSION['ADMIN']);
    }

    // provjera jel netko logiran
    public function logged_in()
    {
        if (!empty($_SESSION['ADMIN']))
            return true;

        return false;
    }
}
