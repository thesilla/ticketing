<?php


// Represents Data Access Layer
// Seperate DB Class to handle all database interaction
// FIXME --> Move all SQL to this object, create functions for dynamic queries?

class Database {

    public $dbc;

    public function __construct() {



        try {


            $this->dbc = new PDO("mysql:host=localhost;dbname=ticketing", "root", "");

            $this->dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //echo "<div> Sucessfully connected to Database </div>";
        } catch (PDOException $e) {
            $output = 'Unable to connect to the database server.';

            echo "<div style='color:red;'>" . $e->getMessage() . "</div>";


            exit();
        }
    }

    function getDbc() {
        return $this->dbc;
    }

    function setDbc($dbc) {
        $this->dbc = $dbc;
    }

}

?>