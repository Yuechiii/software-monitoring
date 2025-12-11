<?php

class Connector {
    private $host = 'localhost';
    private $db_name = 'software_monitoring';
    private $username = "root";
    private $password = "root";
    protected $conn;

    function __construct()
    {
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
    }

}
    
