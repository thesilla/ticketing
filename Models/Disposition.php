<?php
require_once('Database.php');
class Disposition {

    private $dispoID;
    private $userID;
    private $body;
    private $dateSubmitted;
    private $ticketID;
    
    private $dbc;


        // Constructor: create new Disposition object (template)
    public function __construct(Database $conn) {
        
        $this->dbc = $conn->getDbc();
    }

// ************PHP does not allow for multiple constructors - Static Function Constructors below************
    // Constructor with arguments for every attribute - create object from scratch
    public static function create($conn, $dispoID, $userID, $body, $dateSubmitted, $ticketID) {

        $instance = new self($conn);
        $instance->setDispoID($dispoID);
        $instance->setUserID($userID);
        $instance->setBody($body);
        $instance->setDateSubmitted($dateSubmitted);
        $instance->setTicketID($ticketID);
        return $instance;
    }

    // Constructor which will instantiate a new object pulled from database given a Ticket ID #
    // - Takes Dispo ID # object, and db object
    public static function createFromDispoID($conn, $dispoID) {

        
        // set database connection
        $dbc = $conn->getDbc();

        $sql_getDispoFromDB = "SELECT * FROM dispositions where dispoID = '$dispoID'";

        if ($result = $dbc->query($sql_getDispoFromDB)) {

            $row = $result->fetch();
            $instance = new self($conn);

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
    // return an array of Disposition objects from the database, to keep all db logic in model side
    public static function getDispositions($conn) {

        // set static database connection
        $dbc = $conn->getDbc();
        

        
        // for now (or permanently) directly include SQL here
        $sql_showDispos = "SELECT * FROM dispositions";


        if ($result = $dbc->query($sql_showDispos)) {

            $dispos = [];

            while ($row = $result->fetch()) {

                $dispos[] = Disposition::create($conn, $row['dispoID'], $row['userID'], $row['body'], $row['datesubmitted']);
            }
            // return tickets array
            return $dispos;
        } else {

            echo "<p> Could not run query </p>";
        }
    }

    public static function getDispositionsByTicket($conn,$ticketID) {

        

        // set static database connection
        $dbc = $dbc = $conn->getDbc();


        $sql_showDispos = "SELECT * FROM dispositions where ticketID = '$ticketID'";


        if ($result = $dbc->query($sql_showDispos)) {

            // Create dispositions array
            $dispos = [];

            while ($row = $result->fetch()) {

                $dispos[] = Disposition::create($conn, $row['dispoID'], $row['userID'], $row['body'], $row['datesubmitted'], $row['ticketID']);
            }
            // return tickets array
            return $dispos;
        } else {

            echo "<p> Could not run query </p>";
        }
    }

    public static function deleteDispositionsByTicket($conn, $ticketID) {

        
        // set static database connection
        $dbc = $conn->getDbc();
        

 
        $sql_deleteDispos = "DELETE FROM dispositions where ticketID = '$ticketID'";


        if ($result = $dbc->query($sql_deleteDispos)) {

            echo '<div class="alert alert-dismissible alert-success"> Dispositions Successfully Deleted </div>';
        } else {

            echo "<p> Could not run query </p>";
        }
    }

    public function add() {

        // get database connection
        //$this->getConnection();

        $sql_addDispo = "INSERT INTO `dispositions` (`dispoID`, `userID`, `body`, `datesubmitted`, `ticketID`) VALUES (NULL,'$this->userID', '$this->body', NOW(),'$this->ticketID')";

        if ($this->dbc->query($sql_addDispo)) {

            //TODO - DO SOMETHING MORE ELABORATE THAT INDICATES SUCESSFUL SUBMISSION FOR NOW JUST PRINT SUCCESS
            echo '<div class="alert alert-dismissible alert-success"> Disposition Successfully Added </div>';
            return true;
        } else {

            echo "<p> Could not run query </p>";
            return false;
        }
    }

    //  method takes a DB object and DELETES the ticket to the database
    public function delete() {

        // get database connection
        //$this->getConnection();
        
        
        
        $sql_delete = "delete from dispositions where dispoID = '$this->dispoID'";
        if ($this->dbc->query($sql_delete)) {

            echo '<div class="alert alert-dismissible alert-success"> Disposition Successfully Deleted </div>';
            return true;
        } else {

            echo "<p> Could not run query </p>";
            return false;
        }
    }

//  method takes a DB object and edits the disposition and updates the database (IF OBJECT -> DISPOSITION ID ACTUALLY EXISTS)
    public function update() {

        // get database connection
        //$this->getConnection();
        
        
        $sql_update = "update dispositions SET body = '$this->body', datesubmitted = NOW() where dispoID = '$this->dispoID'";

        if ($this->dbc->query($sql_update)) {

            echo '<div class="alert alert-dismissible alert-success"> Disposition Successfully Updated </div>';
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
    
    
    function getDbc() {
        return $this->dbc;
    }

    function setDbc($dbc) {
        $this->dbc = $dbc;
    }

}

?>