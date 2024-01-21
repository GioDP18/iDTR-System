<?php

class DBConnection{

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "core_idtr_system";
    
    public $conn;
    
    public function __construct(){

        if(!isset($this->conn)){
            
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            
            if(!$this->conn){
                echo 'Cannot connect to database server';
                exit;
            }
            $this->conn->query("UPDATE interns SET remaining_hours = TIMEDIFF(target_hours, completed_hours)");

        }    

        
        
    }
    public function __destruct(){
        $this->conn->close();
    }
}

?>