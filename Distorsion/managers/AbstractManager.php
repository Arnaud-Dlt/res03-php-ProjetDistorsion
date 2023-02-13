<?php

abstract class AbstractManager {
    
    protected PDO $db;

    public function __construct(string $dbName, string $port, string $host, string $username, string $password)
    {
            $this->db = new PDO(
            "mysql:host=$host;port=$port;dbname=$dbName",
            $username,
            $password
        );
    }
}


?>