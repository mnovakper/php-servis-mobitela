<?php

trait Model
{
    use Database;

    // limit & offset for pagination
    public $limit = 10;
    public $offset = 0;
    public $order_type = "asc"; // asc/desc
    public $order_column = "id";
    public $errors = [];

    // dumps everything from table
    public function findAll()
    {
        $query = " SELECT * FROM $this->table order by $this->order_column $this->order_type limit  $this->limit offset $this->offset";

        return $this->query($query);
    }

    // returns multiple rows, $data_not param is for what we're not looking for (optional)
    public function where($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key){
            $query .= $key . " = :" . $key . " && "; // :id tells PDO this is a variable, and we'll provide data later
        }

        foreach ($keys_not as $key){
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query," && ");
        $query .= " order by $this->order_column $this->order_type limit  $this->limit offset $this->offset";
        $data = array_merge($data, $data_not);

        return $this->query($query, $data);
    }

    //returns one row
    public function first($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key){
            $query .= $key . " = :" . $key . " && "; // :id tells PDO this is a variable, and we'll provide data later
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

    public function insert($data)
    {
        // unwanted data removal
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
        $query = "INSERT INTO $this->table (".implode(",", $keys).") VALUES (:".implode(",:", $keys).")"; // : cuz values will be provided separately
        $this->query($query, $data);

        return false;
    }

    public function update($id, $data, $id_column = 'id') // if name of id column is not id, then put it in $id_column variable
    {
        // unwanted data removal
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

    public function delete($id, $id_column = 'id') // $id_column = 'id' used if our column is not named id
    {
        $data[$id_column] = $id;
        $query = "DELETE FROM $this->table WHERE $id_column = :$id_column";
        $this->query($query, $data);

        return false;
    }
}