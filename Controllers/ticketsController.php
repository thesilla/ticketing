<?php

// Connect to database
//require('db_connect.php');

// import class files into controller
require_once '../Models/Ticket.php'; 
require_once'../Models/User.php';
require_once'../Models/Disposition.php';
require_once '../Models/Employee.php';
require_once '../Models/UserManager.php';
require_once '../Models/Database.php';
include'../Content/header1.php';

//echo phpinfo();

//initialize error variable
// TODO - create class that handles errors and generates appropriate messages
// - OR create error functionality within Ticket class??? need to decide
$problem = false;
// Must initialize here to avoid error since this field is not mandatory
$orderID = "";
$vendor = "";
$dbc = new Database();
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

            $subject = $_POST['subject'];
        } else {

            echo "<div> Please Enter Subject </div>";
            $problem = true;
        }

        if (!empty($_POST['details'])) {

            $body = $_POST['details'];
        } else {

            echo "<div> Please Enter ticket details </div>";
            $problem = true;
        }


        if (!empty($_POST['requestedby'])) {

            $requestedBy = $_POST['requestedby'];
        } else {

            echo "<div> Please provide the name of individual requesting ticket </div>";
            $problem = true;
        }

        if (!empty($_POST['orderid'])) {

            $orderID = $_POST['orderid'];
        }
        
        if (!empty($_POST['vendor'])) {

            $vendor = $_POST['vendor'];
        }
        
        

        if (!empty($_POST['priority'])) {

            $priority = $_POST['priority'];
        } else {

            echo "<div> Please provide priority level </div>";
            $problem = true;
        }

        if (!empty($_POST['category'])) {

            $category = $_POST['category'];
        } else {

            echo "<div> Please provide topic category </div>";
            $problem = true;
        }

        if (!empty($_POST['assignedto'])) {

            $assignedTo = $_POST['assignedto'];
        } else {

            echo "<div> Please indicate which agent ticket will be assigned to </div>";
            $problem = true;
        }

        $id = 0;
        //date_default_timezone_set('Australia/Melbourne');
        
        // Time doesn't really matter, timestamp added on SQL/server side
        //$t = time();
        //$dateSubmitted = date("Y-m-d", $t);
        $dateSubmitted = "";
        $status = "Waiting on Agent";
        $completed = "NO";
        $dateResolved = "N/A";
        $reason = NULL;

        // TODO - pull user from current session, dont always use mgillman
        $userID = "mgillman";


        // TODO -use objects to verify errors etc?
        if (!$problem) {

            $ticket1 = Ticket::create($dbc, $id, $subject, $body, $userID, $requestedBy, $dateSubmitted, $dateResolved, $orderID, $priority, $category, $status, $assignedTo, $completed, $vendor, $reason);
            $ticket1->add();
        }
    }
}










// show all tickets
// return array of all ticket objects from database
$allTickets = Ticket::getTickets($dbc);
$employees = Employee::getEmployees($dbc);
$allusers = User::getUsers($dbc);

include("../Views/ticketSubmitView.php");
include("../Views/ticketsView.php");




require('../Content/footer2.php');
?>