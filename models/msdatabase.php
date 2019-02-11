<?php

require_once('database.php');
class msdatabase extends database {
    
    
    public function __construct() {
        
         $dbc = new PDO("sqlsrv:Server=192.168.2.6;Database=P21_V12_15", 'webaccess', 'TileM@rket');

    }
    
    
}



?>