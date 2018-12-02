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
    public static function createFromDispoID($dispoID, $dbc) {

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

            $dispos = [];

            while ($row = $result->fetch()) {

                $dispos[] = Disposition::create($row['dispoID'], $row['userID'], $row['body'], $row['datesubmitted']);
            }
            // return tickets array
            return $dispos;
        } else {

            echo "<p> Could not run query </p>";
        }
    }

    public static function getDispositionsByTicket($ticketID, $dbc) {


        // for now (or permanently) directly include SQL here
        $sql_showDispos = "SELECT * FROM dispositions where ticketID = '$ticketID'";


        if ($result = $dbc->query($sql_showDispos)) {

            // Create dispositions array
            $dispos = [];

            while ($row = $result->fetch()) {

                $dispos[] = Disposition::create($row['dispoID'], $row['userID'], $row['body'], $row['datesubmitted'], $row['ticketID']);
            }
            // return tickets array
            return $dispos;
        } else {

            echo "<p> Could not run query </p>";
        }
    }
    
        public static function deleteDispositionsByTicket($ticketID, $dbc) {


        // for now (or permanently) directly include SQL here
        $sql_deleteDispos = "DELETE FROM dispositions where ticketID = '$ticketID'";
        
        


        if ($result = $dbc->query($sql_deleteDispos)) {
            
           echo "<p> Dispositions Successfully Deleted </p>";

            } else {

            echo "<p> Could not run query </p>";
        }
    }
    

    public function add($dbc) {

   
        
        $sql_addDispo = "INSERT INTO `dispositions` (`dispoID`, `userID`, `body`, `datesubmitted`, `ticketID`) VALUES (NULL,'$this->userID', '$this->body', NOW(),'$this->ticketID')";

        if ($dbc->query($sql_addDispo)) {

            //TODO - DO SOMETHING MORE ELABORATE THAT INDICATES SUCESSFUL SUBMISSION FOR NOW JUST PRINT SUCCESS
            echo "<p> Disposition Successfully Added </p>";
            return true;
        } else {

            echo "<p> Could not run query </p>";
            return false;
        }
    }

    //  method takes a DB object and DELETES the ticket to the database
    public function delete($dbc) {

        $sql_delete = "delete from dispositions where dispoID = '$this->dispoID'";
        if ($dbc->query($sql_delete)) {

            echo "<p> Disposition Successfully Deleted </p>";
            return true;
        } else {

            echo "<p> Could not run query </p>";
            return false;
        }
    }

//  method takes a DB object and edits the disposition and updates the database (IF OBJECT -> DISPOSITION ID ACTUALLY EXISTS)
    public function update($dbc) {

        // --Use SQL NOW() function instead
        //$t = time();
        //$timestamp = date("Y-m-d", $t);
        //$this->setDateSubmitted($timestamp);

        $sql_update = "update dispositions SET body = '$this->body', datesubmitted = NOW() where dispoID = '$this->dispoID'";

        if ($dbc->query($sql_update)) {

            echo "<p> Disposition Successfully Updated </p>";
            return true;
        } else {

            echo "<p> Could not run query </p>";
            return false;
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