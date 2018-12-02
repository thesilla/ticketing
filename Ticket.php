<?php
// TODO: Add Vendor field (option, NULL)
// - edit all methods and static constructors - DONE
// - alter database to include field - DONE
// - edit views and controller calls
// - get list of vendors to show in drop-down


// Tickets Model
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

  



// Constructor: create new Ticket object (template)
    public function __construct() {
        
    }

// ************PHP does not allow for multiple constructors - Static Function Constructors below************
    // Constructor with arguments for every attribute - create object from scratch
    public static function create($id, $subject, $body, $userID, $requestedBy, $dateSubmitted, $dateResolved, $orderID, $priority, $category, $status, $assignedTo, $completed, $vendor, $reason) {
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
        $instance->requestedBy = $requestedBy;
        $instance->assignedTo = $assignedTo;
        $instance->completed = $completed;
        $instance->vendor = $vendor;
        $instance->reason = $reason;
        return $instance;
    }

    // Constructor which will instantiate a new object pulled from database given a Ticket ID #
    // - Takes Ticket ID # and a Database Connection object
    public static function createFromID($id, $dbc) {

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

                $tickets[] = Ticket::create($row['ticketID'], $row['subject'], $row['body'], $row['userID'], $row['requestedby'], $row['datesubmitted'], $row['dateresolved'], $row['orderID'], $row['priority'], $row['category'], $row['status'], $row['assignedto'], $row['completed'],$row['vendor'],$row['reason']);

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
    public function add($dbc) {

        // FIXME: Can't sql files, '$this' is outside scope? Look into this
        //include('sql.inc.php');
        // for now (or permanently) directly include SQL here
        $sql_addTix = "INSERT INTO `tickets` (`ticketID`, `subject`, `body`, `userID`,`requestedBy`, `datesubmitted`, `dateresolved`, `orderID`, `priority`, `category`, `status`,`assignedTo`,`completed`,`vendor`,`reason`) VALUES (NULL,'$this->subject','$this->body', '$this->userID','$this->requestedBy', NOW(),NULL,'$this->orderID', '$this->priority','$this->category','$this->status','$this->assignedTo','$this->completed','$this->vendor','$this->reason')";

        if ($dbc->query($sql_addTix)) {

            //TODO - DO SOMETHING MORE ELABORATE THAT INDICATES SUCESSFUL SUBMISSION FOR NOW JUST PRINT SUCCESS
            echo "<p> Ticket Successfully Submited </p>";
            return true;
        } else {

            echo "<p> Could not run query </p>";
            return false;
        }
    }

//  method takes a DB object and DELETES the ticket to the database
    public function delete($dbc) {

        //first delete all corresponding dispositions to satisfy SQL foreign key requirement
        $sql_delete_dispos = "delete from dispositions where ticketID = '$this->id'";
        
        //delete ticket
        $sql_delete = "delete from tickets where ticketID = '$this->id'";
        
        if ($dbc->query($sql_delete_dispos) && $dbc->query($sql_delete)) {

            echo "<p> Ticket Successfully Deleted </p>";
            return true;
        } else {

            echo "<p> Could not run query </p>";
            return false;
        }
    }

//  method takes a DB object and edits the ticket and updates the database (IF OBJECT -> TICKET ID# ACTUALLY EXISTS)
    public function update($dbc) {

        $sql_update = "update tickets SET subject = '$this->subject', body = '$this->body', orderID = '$this->orderID', priority = '$this->priority', category = '$this->category', status = '$this->status', assignedto = '$this->assignedTo', completed = '$this->completed', dateresolved = '$this->dateResolved', vendor = '$this->vendor', reason = '$this->reason' where ticketID = '$this->id'";
        if ($dbc->query($sql_update)) {

            echo "<p> Ticket Successfully Updated </p>";
            return true;
        } else {

            echo "<p> Could not run query </p>";
            return false;
        }
    }
    
   // method takes a DB object and reason for closing ticket, and closes the ticket 
    public function close($dbc, $reason){
        
        $completed = "YES";
        $this->setReason($reason);
        $this->setCompleted($completed);
        
        $sql_close = "update tickets SET completed = '$this->completed', reason =  '$this->reason', dateresolved = NOW() where ticketID = '$this->id'";
        
        if ($dbc->query($sql_close)) {

            echo "<p> Ticket Successfully Closed </p>";
            return true;
        } else {

            echo "<p> Could not run query </p>";
            return false;
        }
        
    }

    
        public function open($dbc){
        
        $completed = "NO";
        $reason ="";
        $this->setReason($reason);
        $this->setCompleted($completed);
        
        $sql_open = "update tickets SET completed = '$this->completed', reason =  '$this->reason', dateresolved = '' where ticketID = '$this->id'";
        
        if ($dbc->query($sql_open)) {

            echo "<p> Ticket Successfully Re-opened </p>";
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












