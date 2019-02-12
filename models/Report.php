<?php

// Root class for all report models
// TODO: Create an abstract model/class for Record, can return an array of records, subclasses created for each type of report

require_once('database.php');

abstract class Report {

    private $dbc;
    private $stmt;

    // all Report objects must have run function 
    // must be declared in child class (but not here)
    abstract function run();

    // NO CONSTRUCTOR IN PARENT ABSTRACT CLASS - ONLY IN SUBCLASSES


    function getDbc() {
        return $this->dbc;
    }

    function setDbc($dbc) {
        $this->dbc = $dbc;
    }

    function getStmt() {
        return $this->stmt;
    }

    function setStmt($stmt) {
        $this->stmt = $stmt;
    }

}

?>