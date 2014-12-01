<?php
class model{
    public $connect; 
    
    public function __construct() {
        $options=array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        );
        try{ 
            $this->connect= new PDO("mysql:host=".HOST.";dbname=".NAME,USER,PASS,$options); 
       	
	} catch (PDOException $e){
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
