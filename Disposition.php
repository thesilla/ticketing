<?php

class Disposition {
    
    private $dispoID;
    private $userID;
    private $body;
    private $dateSubmitted;
    private $ticketID;


        // Constructor: create new Disposition object (template)
    public function __construct() {

    }
// ************PHP does not allow for multiple constructors - Static Function Constructors below************

    // Constructor with arguments for every attribute - create object from scratch
    public static function create($dispoID, $userID, $body, $dateSubmitted, $ticketID) {
       
        $instance = new self();
        $instance->setDispoID($dispoID);
        $instance->setUserID($userID);
        $instance->setBody($body);     
        $instance->setDateSubmitted($dateSubmitted);
        $instance->setTicketID($ticketID);
        return $instance;
        
    }
    
    
    
    // Constructor which will instantiate a new object pulled from database given a Ticket ID #
        // - Takes Ticket ID # and a Database Connection object
    public static function createFromDispoID($dispoID,$dbc) {
        
        $sql_getDispoFromDB = "SELECT * FROM dispositions where dispoID = '$dispoID'";
            
        if ($result = $dbc->query($sql_getDispoFromDB)) {

            $row = $result->fetch();
            $instance = new self();

            $instance->setDispoID($row['dispoID']);
            $instance->setUserID($row['userID']);
            $instance->setBody($row['body']);
            $instance->setDateSubmitted($row['datesubmitted']);
            $instance->setTicketID($row['ticketID']);
           
            return $instance;

        } else {

            echo "<p> Could not run query </p>";
        }
  
    }
    

    
    // static method pulling all tickets - DB/SQL object argument
    // return an array of Disposition objects from the database, to keep all db logic in model side
    public static function getDispositions($dbc) {
        
        
        // for now (or permanently) directly include SQL here
        $sql_showDispos = "SELECT * FROM dispositions";


        if ($result = $dbc->query($sql_showDispos)) {

            // Create tickets array
            $dispos = [];

            while ($row = $result->fetch()) {

                $dispos[] = Disposition::create($row['dispoID'],$row['userID'],$row['body'],$row['datesubmitted']);

                // TODO delete this, for testing only
                //print_r($tickets);
            }
            // return tickets array
            return $dispos;
        } else {

            echo "<p> Could not run query </p>";
        }
    }
    
    
    public static function getDispositionsByTicket($ticketID,$dbc) {
        
        
        // for now (or permanently) directly include SQL here
        $sql_showDispos = "SELECT * FROM dispositions where ticketID = '$ticketID'";


        if ($result = $dbc->query($sql_showDispos)) {

            // Create dispositions array
            $dispos = [];

            while ($row = $result->fetch()) {

                $dispos[] = Disposition::create($row['dispoID'],$row['userID'],$row['body'],$row['datesubmitted'],$row['ticketID']);

   
            }
            // return tickets array
            return $dispos;
        } else {

            echo "<p> Could not run query </p>";
        }
    }
    
    
    
    
    
    
    
    function getDispoID() {
        return $this->dispoID;
    }

    function getUserID() {
        return $this->userID;
    }

    function getBody() {
        return $this->body;
    }

    function getDateSubmitted() {
        return $this->dateSubmitted;
    }

    function setDispoID($dispoID) {
        $this->dispoID = $dispoID;
    }

    function setUserID($userID) {
        $this->userID = $userID;
    }

    function setBody($body) {
        $this->body = $body;
    }

    function setDateSubmitted($dateSubmitted) {
        $this->dateSubmitted = $dateSubmitted;
    }
    
    function getTicketID() {
        return $this->ticketID;
    }

    function setTicketID($ticketID) {
        $this->ticketID = $ticketID;
    }


    
    
}










?>