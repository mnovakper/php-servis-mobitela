<?php

trait Model
{
    use Database;

    // opcije i ostalo
    public $limit = 10;
    public $offset = 0;
    public $order_type = "asc"; // asc/desc
    public $order_column = "id";
    public $errors = [];

    // baca sve iz tablice
    public function findAll()
    {
        $query = " SELECT * FROM $this->table order by $this->order_column $this->order_type limit  $this->limit offset $this->offset";

        return $this->query($query);
    }

    // vraća više redaka, $data_not param je za ono što ne tražimo (izborno)
    public function where($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key){
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keys_not as $key){
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query," && ");
        $query .= " order by $this->order_column $this->order_type limit  $this->limit offset $this->offset";
        $data = array_merge($data, $data_not);

        return $this->query($query, $data);
    }

    // vraća jedan red
    public function first($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key){
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keys_not as $key){
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query," && ");
        $query .= " limit  $this->limit offset $this->offset";
        $data = array_merge($data, $data_not);

        $result = $this->query($query, $data);
        if($result)
            return $result[0];

        return false;
    }

    // umetanje u tablicu
    public function insert($data)
    {
        // stupi koje ne želimo
        if(!empty($this->allowedColumns))
        {
            foreach ($data as $key => $value){
                if (!in_array($key, $this->allowedColumns))
                {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "INSERT INTO $this->table (".implode(",", $keys).") VALUES (:".implode(",:", $keys).")";
        $this->query($query, $data);

        return false;
    }

    // promjena podataka u tablici
    public function update($id, $data, $id_column = 'id') // ako naziv id stupca nije id, tada ga stavi u varijablu $id_column
    {
        // stupi koje ne želimo
        if(!empty($this->allowedColumns))
        {
            foreach ($data as $key => $value){
                if (!in_array($key, $this->allowedColumns))
                {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "UPDATE $this->table SET ";

        foreach ($keys as $key){
            $query .= $key . " = :" . $key . ", ";
        }

        $query = trim($query,", ");
        $query .= " WHERE $id_column = :$id_column";
        $data[$id_column] = $id;
        $this->query($query, $data);

        return false;
    }

    // brisanje iz tablice
    public function delete($id, $id_column = 'id') // $id_column = 'id' se koristi ako naš stupac nije nazvan id
    {
        $data[$id_column] = $id;
        $query = "DELETE FROM $this->table WHERE $id_column = :$id_column";
        $this->query($query, $data);

        return false;
    }
}