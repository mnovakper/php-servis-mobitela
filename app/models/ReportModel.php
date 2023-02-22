<?php

class ReportModel
{
    use Model;
    protected $table = 'reports'; // table choice

    // columns allowed to be editable
    protected $allowedColumns = [
        'name_surname',
        'address',
        'contact_number',
        'email',
        'phone_model',
        'phone_imei',
        'phone_damage',
        'phone_malfunction',
        'phone_status',
        'cashier_name'
    ];

    public function validate($data, $id = null)
    {
        $this->errors = [];

        if (empty($data['name_surname']))
        {
            $this->errors['name_surname'] = "User name and surname is required";
        }

        if (empty($data['address']))
        {
            $this->errors['address'] = "User address is required";
        }

        if (empty($data['contact_number']))
        {
            $this->errors['contact_number'] = "Contact number is required";
        }

        if (empty($data['email']))
        {
            $this->errors['email'] = "Email is required";
        }else
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        {
            $this->errors['email'] = "Email is not valid";
        }

        if (empty($data['phone_model']))
        {
            $this->errors['phone_model'] = "Phone model is required";
        }

        if (empty($data['phone_imei']))
        {
            $this->errors['phone_imei'] = "Phone IMEI is required";
        }

        if (empty($data['phone_damage']))
        {
            $this->errors['phone_damage'] = "Phone damage description is required";
        }

        if (empty($data['phone_malfunction']))
        {
            $this->errors['phone_malfunction'] = "Phone malfunction description is required";
        }

        if (empty($data['phone_status']))
        {
            $this->errors['phone_status'] = "Phone status is required";
        }

        if(empty($this->errors))
        {
            return true;
        }

        return false;
    }
}

