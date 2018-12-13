<?php

// TODO: Add Vendor field (option, NULL)

// - edit views and controller calls
// - get list of vendors to show in drop-down
// Tickets Model
require_once('Database.php');
class Ticket {

// Ticket attributes
    private $id;
    private $subject;
    private $body;
    private $userID;
    private $requestedBy;
    private $dateSubmitted;
    private $orderID;
    private $category;
    private $priority;
    private $status;
    private $assignedTo;
    private $completed;
    private $dateResolved;
    private $vendor;
    private $reason;
    private $dbc;

// Constructor: create new Ticket object (template)
// takes and sets db connection object
    public function __construct(Database $conn) {
        
        $this->dbc = $conn->getDbc();
        
    }

// ************PHP does not allow for multiple constructors - Static Function Constructors below************
    // Constructor with arguments for every attribute - create object from scratch, and takes a Database Connection object
    public static function create($conn, $id, $subject, $body, $userID, $requestedBy, $dateSubmitted, $dateResolved, $orderID, $priority, $category, $status, $assignedTo, $completed, $vendor, $reason) {
        $instance = new self($conn);
        $instance->id = $id;
        $instance->subject = $subject;
        $instance->body = $body;
        $instance->userID = $userID;
        $instance->dateSubmitted = $dateSubmitted;
        $instance->dateResolved = $dateResolved;
        $instance->orderID = $orderID;
        $instance->priority = $priority;
        $instance->category = $category;
        $instance->status = $status;
        $instance->requestedBy = $requestedBy;
        $instance->assignedTo = $assignedTo;
        $instance->completed = $completed;
        $instance->vendor = $vendor;
        $instance->reason = $reason;
        //$instance->dbc = $conn->getDbc();
        return $instance;
    }

    // Constructor which will instantiate a new object pulled from database given a Ticket ID #
    // - Takes Ticket ID # and a Database Connection object
    public static function createFromID($conn, $id) {

        // set static database connection
        $dbc = $conn->getDbc();
        
        
        $sql_getTicketFromDB = "SELECT * FROM tickets where ticketID = '$id'";

        if ($result = $dbc->query($sql_getTicketFromDB)) {

            $row = $result->fetch();
            $instance = new self($conn);

            $instance->setID($row['ticketID']);
            $instance->setSubject($row['subject']);
            $instance->setBody($row['body']);
            $instance->setUserID($row['userID']);
            $instance->setDateSubmitted($row['datesubmitted']);
            $instance->setDateResolved($row['dateresolved']);
            $instance->setOrderID($row['orderID']);
            $instance->setPriority($row['priority']);
            $instance->setCategory($row['category']);
            $instance->setStatus($row['status']);
            $instance->setRequestedBy($row['requestedby']);
            $instance->setAssignedTo($row['assignedto']);
            $instance->setCompleted($row['completed']);
            $instance->setVendor($row['vendor']);
            $instance->setReason($row['reason']);
            return $instance;
        } else {

            echo "<p> Could not run query </p>";
        }
    }

    /*
    // get database connection
    public function getConnection() {

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
    
    
        public static function getStaticConnection(){
        
                // set database connection
        try {


            $dbc = new PDO("mysql:host=localhost;dbname=ticketing", "root", "");

            $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $dbc;

            //echo "<div> Sucessfully connected to Database </div>";
        } catch (PDOException $e) {
            $output = 'Unable to connect to the database server.';

            echo "<div style='color:red;'>" . $e->getMessage() . "</div>";

            
            exit();
        }
        
    }
    */
    

// static method pulling all tickets - DB/SQL object argument
// takes db object, return an array of Ticket objects from the database
    public static function getTickets($conn) {

        
        
        // set static database connection (not datbase object)
        $dbc = $conn->getDbc();
        

        $sql_showTix = "SELECT * FROM tickets";


        if ($result = $dbc->query($sql_showTix)) {

            
            // Create tickets array
            $tickets = [];

            while ($row = $result->fetch()) {

                $tickets[] = Ticket::create($conn, $row['ticketID'], $row['subject'], $row['body'], $row['userID'], $row['requestedby'], $row['datesubmitted'], $row['dateresolved'], $row['orderID'], $row['priority'], $row['category'], $row['status'], $row['assignedto'], $row['completed'], $row['vendor'], $row['reason']);

                // TODO delete this, for testing only
                //print_r($tickets);
            }
            // return tickets array
            return $tickets;
        } else {

            echo "<p> Could not run query </p>";
        }
    }
    
    
    // returns array of only open tickets
        public static function getOpenTickets($conn) {

        
        
        // set static database connection (not datbase object)
        $dbc = $conn->getDbc();
        

        $sql_showTix = "SELECT * FROM tickets where completed = 'NO'";


        if ($result = $dbc->query($sql_showTix)) {

            
            // Create tickets array
            $tickets = [];

            while ($row = $result->fetch()) {

                $tickets[] = Ticket::create($conn, $row['ticketID'], $row['subject'], $row['body'], $row['userID'], $row['requestedby'], $row['datesubmitted'], $row['dateresolved'], $row['orderID'], $row['priority'], $row['category'], $row['status'], $row['assignedto'], $row['completed'], $row['vendor'], $row['reason']);

                // TODO delete this, for testing only
                //print_r($tickets);
            }
            // return tickets array
            return $tickets;
        } else {

            echo "<p> Could not run query </p>";
        }
    }
    
        // returns array of only open tickets
        public static function getClosedTickets($conn) {

        
        
        // set static database connection (not datbase object)
        $dbc = $conn->getDbc();
        

        $sql_showTix = "SELECT * FROM tickets where completed = 'YES'";


        if ($result = $dbc->query($sql_showTix)) {

            
            // Create tickets array
            $tickets = [];

            while ($row = $result->fetch()) {

                $tickets[] = Ticket::create($conn, $row['ticketID'], $row['subject'], $row['body'], $row['userID'], $row['requestedby'], $row['datesubmitted'], $row['dateresolved'], $row['orderID'], $row['priority'], $row['category'], $row['status'], $row['assignedto'], $row['completed'], $row['vendor'], $row['reason']);

                // TODO delete this, for testing only
                //print_r($tickets);
            }
            // return tickets array
            return $tickets;
        } else {

            echo "<p> Could not run query </p>";
        }
    }
    
    
    
    
    
    
    

//  method takes a DB object and ADDS the ticket to the database
    public function add() {

        // get database connection
        // (already established when object created)
        //$this->getConnection();

        $sql_addTix = "INSERT INTO `tickets` (`ticketID`, `subject`, `body`, `userID`,`requestedBy`, `datesubmitted`, `dateresolved`, `orderID`, `priority`, `category`, `status`,`assignedTo`,`completed`,`vendor`,`reason`) VALUES (NULL,'$this->subject','$this->body', '$this->userID','$this->requestedBy', NOW(),NULL,'$this->orderID', '$this->priority','$this->category','$this->status','$this->assignedTo','$this->completed','$this->vendor','$this->reason')";

        if ($this->dbc->query($sql_addTix)) {

            //TODO - DO SOMETHING MORE ELABORATE THAT INDICATES SUCESSFUL SUBMISSION FOR NOW JUST PRINT SUCCESS
            echo '<div class="alert alert-dismissible alert-success"> Ticket Successfully Submited </div>';
            return true;
        } else {

            echo "<p> Could not run query </p>";
            return false;
        }
    }

//  method takes a DB object and DELETES the ticket to the database
    public function delete() {
        
        // get database connection
        // (already established when object created)
        //$this->getConnection();
        //first delete all corresponding dispositions to satisfy SQL foreign key requirement
        $sql_delete_dispos = "delete from dispositions where ticketID = '$this->id'";

        //delete ticket
        $sql_delete = "delete from tickets where ticketID = '$this->id'";

        if ($this->dbc->query($sql_delete_dispos) && $this->dbc->query($sql_delete)) {

            echo '<div class="alert alert-dismissible alert-success"> Ticket Successfully Deleted </div>';
            return true;
        } else {

            echo "<p> Could not run query </p>";
            return false;
        }
    }

//  method edits the ticket and updates the database (IF OBJECT -> TICKET ID# ACTUALLY EXISTS)
    public function update() {

        // get database connection
        // (already established when object created)
        //$this->getConnection();
        
        $sql_update = "update tickets SET subject = '$this->subject', body = '$this->body', orderID = '$this->orderID', priority = '$this->priority', category = '$this->category', status = '$this->status', assignedto = '$this->assignedTo', completed = '$this->completed', dateresolved = '$this->dateResolved', vendor = '$this->vendor', reason = '$this->reason' where ticketID = '$this->id'";
        if ($this->dbc->query($sql_update)) {

            echo '<div class="alert alert-dismissible alert-success"> Ticket Successfully Updated </div>';
            return true;
        } else {

            echo "<p> Could not run query </p>";
            return false;
        }
    }

    // method takes reason for closing ticket, and closes the ticket 
    public function close($reason) {

        // get database connection
        // (already established when object created)
        //$this->getConnection();
        
        $completed = "YES";
        $this->setReason($reason);
        $this->setCompleted($completed);

        $sql_close = "update tickets SET completed = '$this->completed', reason =  '$this->reason', dateresolved = NOW() where ticketID = '$this->id'";

        if ($this->dbc->query($sql_close)) {

            echo '<div class="alert alert-dismissible alert-success"> Ticket Successfully Closed </div>';
            return true;
        } else {

            echo "<p> Could not run query </p>";
            return false;
        }
    }

    //re-open closed ticket
    public function open() {

        // get database connection
        // (already established when object created)
        //$this->getConnection();
        
        $completed = "NO";
        $reason = "";
        $this->setReason($reason);
        $this->setCompleted($completed);

        $sql_open = "update tickets SET completed = '$this->completed', reason =  '$this->reason', dateresolved = '' where ticketID = '$this->id'";

        if ($this->dbc->query($sql_open)) {

            echo '<div class="alert alert-dismissible alert-success"> Ticket Successfully Re-opened </div>';
            return true;
        } else {

            echo "<p> Could not run query </p>";
            return false;
        }
    }

// GETTERS AND SETTERS 

    public function getId() {
        return $this->id;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function getBody() {
        return $this->body;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function getDateSubmitted() {
        return $this->dateSubmitted;
    }

    public function getDateResolved() {
        return $this->dateResolved;
    }

    public function getOrderID() {
        return $this->orderID;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getPriority() {
        return $this->priority;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function setDateSubmitted($dateSubmitted) {
        $this->dateSubmitted = $dateSubmitted;
    }

    public function setDateResolved($dateResolved) {
        $this->dateResolved = $dateResolved;
    }

    public function setOrderID($orderID) {
        $this->orderID = $orderID;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function setPriority($priority) {
        $this->priority = $priority;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getRequestedBy() {
        return $this->requestedBy;
    }

    public function getAssignedTo() {
        return $this->assignedTo;
    }

    public function getCompleted() {
        return $this->completed;
    }

    public function setRequestedBy($requestedBy) {
        $this->requestedBy = $requestedBy;
    }

    public function setAssignedTo($assignedTo) {
        $this->assignedTo = $assignedTo;
    }

    public function setCompleted($completed) {
        $this->completed = $completed;
    }

    public function getVendor() {
        return $this->vendor;
    }

    public function setVendor($vendor) {
        $this->vendor = $vendor;
    }

    public function getReason() {
        return $this->reason;
    }

    public function setReason($reason) {
        $this->reason = $reason;
    }

}
?>











