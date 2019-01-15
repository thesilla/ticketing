<?php


// Represents data Access Layer
// Seperate db Class to handle all database interaction
// FIXME --> Move all SQL to this object, create functions for dynamic queries?

class database {

    public $dbc;

    public function __construct() {



        try {


            $this->dbc = new PDO("mysql:host=localhost;dbname=ticketing", "root", "");

            $this->dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //echo "<div> Sucessfully connected to database </div>";
        } catch (PDOException $e) {
            $output = 'Unable to connect to the database server.';

            echo "<div style='color:red;'>" . $e->getMessage() . "</div>";


            exit();
        }
    }

    function getdbc() {
        return $this->dbc;
    }

    function setdbc($dbc) {
        $this->dbc = $dbc;
    }

}

?>