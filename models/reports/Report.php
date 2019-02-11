<?php

// Root class for all report models

require_once('database.php');
class Report {
    
       private $dbc;
    
       public function __construct(database $conn) {
        
        $this->dbc = $conn->getdbc();
        
    } 
    
    
    
    
    
    
    
}






?>