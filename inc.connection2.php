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

    //^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
    ///////////////////////////////////

    // private $servername = "localhost";
    // private $username = "wikikosm_satu";
    // private $password = "Wikikos123456";
    // private $dbname = "wikikosm_satu";
    // public $conn;

    // function __construct()
    // {
    //     $this->connect();
    // }

    // function connect()
    // {

    // $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);

    // }
    // pakai ini kalau mau ngetes database dengan hosting pc 
    //========================================================


}
