<?php

namespace System\Core;
class Database
{
    protected $connection;

    public function __construct($host, $username, $password, $database){
        $this->connection = new \mysqli($host, $username, $password, $database);

        if($this->connection->connect_error){
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function query($sql){
        return $this->connection->query($sql);
    }
}