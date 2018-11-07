<?php

// Tickets Model
class Ticket {

// Ticket attributes
    private $id;
    private $subject;
    private $body;
    private $userID;
    private $dateSubmitted;
    private $dateResolved;
    private $orderID;
    private $category;
    private $priority;
    private $status;

    
    


// Constructor: create new Ticket object (template)
    public function __construct() {

    }
    
// ************PHP does not allow for multiple constructors - Static Function Constructors below************

        // Constructor with arguments for every attribute - create object from scratch
        public static function create($id, $subject, $body, $userID, $dateSubmitted, $dateResolved, $orderID, $priority, $category, $status) {
        $instance = new self();
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
        return $instance;
    }
    
        // Constructor which will instantiate a new object pulled from database given a Ticket ID #
        // - Takes Ticket ID # and a Database Connection object
        public static function createFromID($id,$dbc) {
        
        $sql_getTicketFromDB = "SELECT * FROM tickets where ticketID = '$id'";
            
        if ($result = $dbc->query($sql_getTicketFromDB)) {

            $row = $result->fetch();
            $instance = new self();

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
            return $instance;

        } else {

            echo "<p> Could not run query </p>";
        }
  
    }

// static method pulling all tickets - DB/SQL object argument
// return an array of Ticket objects from the database, to keep all db logic in model side
    public static function getTickets($dbc) {
        
        // FIXME: Can't sql files, '$this' is outside scope? Look into thi
        //include('sql.inc.php');
        
        // for now (or permanently) directly include SQL here
        $sql_showTix = "SELECT * FROM tickets";


        if ($result = $dbc->query($sql_showTix)) {

            // Create tickets array
            $tickets = [];

            while ($row = $result->fetch()) {

                $tickets[] = Ticket::create($row['ticketID'], $row['subject'], $row['body'], $row['userID'], $row['datesubmitted'], $row['dateresolved'], $row['orderID'], $row['priority'], $row['category'], $row['status']);

                // TODO delete this, for testing only
                //print_r($tickets);
            }

            return $tickets;
        } else {

            echo "<p> Could not run query </p>";
        }
    }

//  method takes a DB object and ADDS the ticket to the database
    public function add($dbc) {

        // FIXME: Can't sql files, '$this' is outside scope? Look into this
        //include('sql.inc.php');
        
        // for now (or permanently) directly include SQL here
        $sql_addTix = "INSERT INTO `tickets` (`ticketID`, `subject`, `body`, `userID`, `datesubmitted`, `dateresolved`, `orderID`, `priority`, `category`, `status`) VALUES (NULL,'$this->subject','$this->body', '$this->userID','$this->dateSubmitted',NULL,'$this->orderID', '$this->priority','$this->category','$this->status')";
        
        if ($dbc->query($sql_addTix)) {

           //TODO - DO SOMETHING MORE ELABORATE THAT INDICATES SUCESSFUL SUBMISSION FOR NOW JUST PRINT SUCCESS
           echo "<p> Ticket Successfully Submited </p>";
           return true;

        } else {

            echo "<p> Could not run query </p>";
            return false; 
           
        }

        // TODO: generate actual function
        //echo "<p> Ticket Successfully Added to Database </p>";
    }

//  method takes a DB object and DELETES the ticket to the database
    public function deleteTicket($dbc) {

        // TODO: generate actual function
        echo "<p> Ticket Successfully deleted from the Database </p>";
    }

//  method takes a DB object and edits the ticket and updates the database
    public function edit($dbc) {

        // TODO: generate actual function
        echo "<p> Ticket Successfully deleted from the Database </p>";
    }

// GETTERS AND SETTERS 
    
    function getId() {
        return $this->id;
    }

    function getSubject() {
        return $this->subject;
    }

    function getBody() {
        return $this->body;
    }

    function getUserID() {
        return $this->userID;
    }

    function getDateSubmitted() {
        return $this->dateSubmitted;
    }

    function getDateResolved() {
        return $this->dateResolved;
    }

    function getOrderID() {
        return $this->orderID;
    }

    function getCategory() {
        return $this->category;
    }

    function getPriority() {
        return $this->priority;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSubject($subject) {
        $this->subject = $subject;
    }

    function setBody($body) {
        $this->body = $body;
    }

    function setUserID($userID) {
        $this->userID = $userID;
    }

    function setDateSubmitted($dateSubmitted) {
        $this->dateSubmitted = $dateSubmitted;
    }

    function setDateResolved($dateResolved) {
        $this->dateResolved = $dateResolved;
    }

    function setOrderID($orderID) {
        $this->orderID = $orderID;
    }

    function setCategory($category) {
        $this->category = $category;
    }

    function setPriority($priority) {
        $this->priority = $priority;
    }

    function setStatus($status) {
        $this->status = $status;
    }
    
}


?>