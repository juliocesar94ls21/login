<?php

class db{
    private $HOST = "localhost";
    private $USER = "root";
    private $BANCO = "wdlogin";
    private $PASS = "3b59Rt6G@";

    public function getConnection(){
        $conn = new PDO('mysql:host='.$this->HOST.';dbname='.$this->BANCO, $this->USER, $this->PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$conn->exec("SET CHARACTER SET utf8");
        return $conn;
    }
}

?>