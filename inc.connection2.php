<?php

class Connection2
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "wikikos_db";
    public $conn;

    function __construct()
    {
        $this->connect();
    }

    function connect()
    {
        $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
    }
}
