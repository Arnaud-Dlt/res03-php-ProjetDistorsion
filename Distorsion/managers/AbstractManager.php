<?php

abstract class AbstractManager {
    
    protected PDO $db;

    public function __construct(string $host, string $port, string $dbName, string $username, string $password)
    {

        $this->db = new PDO(
            "mysql:host=$host;port=$port;dbname=$dbName",
            $username,
            $password
        );
    }
}


?>