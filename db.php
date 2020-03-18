<?php




Class Database
{
    
    public $conn;
    public function __construct() {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "caffem";
        
            try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            //echo "Connection ok!";
            } catch (PDOException $e) {
            echo "Err: " . $e->getMessage();
            }
        
            //$conn = null;
    }

}