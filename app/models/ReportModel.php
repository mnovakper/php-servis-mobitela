<?php

class ReportModel
{
    use Model;
    protected $table = 'reports'; // odabrana tablica

    // editable stupci
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

    // provjera input podataka
    public function validate($data, $id = null)
    {
        $this->errors = [];

        if (empty($data['name_surname']))
        {
            $this->errors['name_surname'] = "Ime i prezime su obavezni";
        }

        if (empty($data['address']))
        {
            $this->errors['address'] = "Adresa je obavezna";
        }

        if (empty($data['contact_number']))
        {
            $this->errors['contact_number'] = "Kontakt broj je obavezan";
        }

        if (empty($data['email']))
        {
            $this->errors['email'] = "Email je obavezan";
        }else
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        {
            $this->errors['email'] = "Email nije valjan";
        }

        if (empty($data['phone_model']))
        {
            $this->errors['phone_model'] = "Model je obavezan";
        }

        if (empty($data['phone_imei']))
        {
            $this->errors['phone_imei'] = "IMEI je obavezan";
        }

        if (empty($data['phone_damage']))
        {
            $this->errors['phone_damage'] = "Opis oštećenja je obavezan";
        }

        if (empty($data['phone_malfunction']))
        {
            $this->errors['phone_malfunction'] = "Kvar je obavezan";
        }

        if (empty($data['phone_status']))
        {
            $this->errors['phone_status'] = "Status je obavezan";
        }

        if(empty($this->errors))
        {
            return true;
        }

        return false;
    }
}

