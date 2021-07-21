<?php

class Dbh {
    
    private $host =  "localhost";
    private $user =  "root";
    private $pwd =  "password";
    private $dbname =  "dbname";
    private $pdo;

    public function connect() {
        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' .$this->dbname;
            if (!isset($this->pdo)) {
                $this->pdo = new PDO($dsn, $this->user,$this->pwd);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            }
            return $this->pdo;
            
        } catch (PDOException $e) {
            exit('Error Connecting To DataBase');
        }
        
    }
    
}

?>