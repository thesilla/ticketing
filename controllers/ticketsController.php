<?php

// Connect to database
//require('db_connect.php');

// import class files into controller
require_once '../models/Ticket.php'; 
require_once'../models/User.php';
require_once'../models/Disposition.php';
require_once '../models/Employee.php';
require_once '../models/UserManager.php';
require_once '../models/database.php';
include'../content/header1.php';







// array of errors
//set inner array to 1 if problem
//pass to view
$ticketSubmitErrors = array(
    "subject" => array("<p class='text-danger'> *Please submit valid ticket subject </p>", 0),
    "requestedby" => array("<p class='text-danger'> *Please provide name of requesting individual </p>", 0),
    "category" => array("<p class='text-danger'> *Please assign category</p>", 0),
    "assignedto" => array("<p class='text-danger'> *Please submit valid user to assign task to </p>", 0)
);









//echo phpinfo();

//initialize error variable
// TODO - create class that handles errors and generates appropriate messages
// - OR create error functionality within Ticket class??? need to decide
$problem = false;
// Must initialize here to avoid error since this field is not mandatory
$orderID = "";
$vendor = "";
$dbc = new database();
// if ticket form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // if Ticket DELETE button is clicked
    if (!empty($_POST['delete-ticket']) && $_POST['delete-ticket'] == 'Delete') {

        $tempid = $_POST['ticketno'];

        Disposition::deleteDispositionsByTicket($tempid);
        $tempTicket = Ticket::createFromID($tempid);
        $tempTicket->delete();
        echo "<div> Ticket " . $tempid . " deleted </div>";
    }

    // if Ticket Submit form submitted
    if (!empty($_POST['submitticketbutton']) && $_POST['submitticketbutton'] == 'Submit Ticket') {


        if (!empty($_POST['subject'])) {

            $subject = htmlentities($_POST['subject']);
        } else {

            $ticketSubmitErrors['subject'][1]=1;
            $problem = true;
        }

        if (!empty($_POST['details'])) {

            $body = htmlentities($_POST['details']);
        }

        if (!empty($_POST['requestedby'])) {

            $requestedby = htmlentities($_POST['requestedby']);
        } else {

            $ticketSubmitErrors['requestedby'][1] = 1;
            $problem = true;
        }

        if (!empty($_POST['orderid'])) {

            $orderID = htmlentities($_POST['orderid']);
        }
        
        if (!empty($_POST['vendor'])) {

            $vendor = $_POST['vendor'];
        }
        
        

        if (!empty($_POST['priority'])) {

            $priority = htmlentities($_POST['priority']);
        } else {

            echo "<div> Please provide priority level </div>";
            $problem = true;
        }

        if (!empty($_POST['category'])) {

            $category = htmlentities($_POST['category']);
            //echo "<div>" . $category . "</div>";
            //echo "<div>Post Variable: " . $_POST['category'] . "</div>";
        } else {

            $ticketSubmitErrors['category'][1] = 1;
            $problem = true;
        }

        if (!empty($_POST['assignedto'])) {

            $assignedTo = htmlentities($_POST['assignedto']);
        } else {

            $ticketSubmitErrors['assignedto'][1] = 1;
            $problem = true;
        }

        $id = 0;
  
        
        // Time doesn't really matter, timestamp added on SQL/server side
        $dateSubmitted = "";
        $status = "Waiting on Agent";
        $completed = "NO";
        $dateResolved = "N/A";
        $reason = NULL;

        
        $userID = $_SESSION['username'];


        
        if (!$problem) {

            $ticket1 = Ticket::create($dbc, $id, $subject, $body, $userID, $requestedby, $dateSubmitted, $dateResolved, $orderID, $priority, $category, $status, $assignedTo, $completed, $vendor, $reason);
            $ticket1->add();
        }
    }
}










// show all tickets
// return array of all ticket objects from database
$allTickets = Ticket::getTickets($dbc);
$employees = Employee::getEmployees($dbc);
$allusers = User::getUsers($dbc);

include("../views/ticketSubmitView.php");
include("../views/ticketsView.php");




require('../content/footer2.php');
?>
