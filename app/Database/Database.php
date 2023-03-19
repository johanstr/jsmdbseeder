<?php

namespace App\Database;
use PDOException;

class Database
{
    private $dbhost = '';
    private $dbname = '';
    private $dbuser = '';
    private $dbpass = '';

    private $connection = null;
    private $statement = null;

    public function __construct($config)
    {
        // $config = include '../../config/dbconnection.php';
        
        $this->dbhost = $config['host'];
        $this->dbname = $config['dbname'];
        $this->dbuser = $config['username'];
        $this->dbpass = $config['password'];

        $this->connect();
    }

    private function connect() : void
    {
        if(is_null($this->connection)) {
            try {
                $this->connection = new \PDO("mysql:host={$this->dbhost};dbname={$this->dbname}", $this->dbuser, $this->dbpass);
            } catch(PDOException $error) {
                echo $error->getMessage();
                exit();
            }
        }
    }


    private function prepareSQL($table, $columns_and_values) : string
    {
        $sql = 'INSERT INTO `' . $table . '` (';
        $values = " VALUES (";
        $columns = array_keys($columns_and_values);
        $first = true;

        foreach($columns as $column) {
            if($first) {
                $sql .= "`{$column}`";
                $values .= ":{$column}";
                $first = false;
            } else {
                $sql .= ", `{$column}`";
                $values .= ", :{$column}";
            }
        }

        $values .= ')';
        $sql .= ') ' . $values;

        return $sql;
    }

    private function prepareExecuteArray($columns_and_values) : array
    {
        $columns = array_keys($columns_and_values);
        $result = [];

        foreach($columns as $column) {
            $result[":{$column}"] = $columns_and_values[$column];
        }

        return $result;
    }

    public function insert($table, $columns_and_values) : void
    {
        $values = $this->prepareExecuteArray($columns_and_values);
        $sql = $this->prepareSQL($table, $columns_and_values);

        if($this->connection) {
            try {
                $this->statement = $this->connection->prepare($sql);

                $this->statement->execute($values);
            } catch(PDOException $e) {
                echo $e->getMessage();
                exit();
            }
        }
    }
}