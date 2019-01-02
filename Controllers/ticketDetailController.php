





<?php

//TODO - FORM SHOULD HANDLE POSSIBLE SITUATIONS WHEN FIELDS CONTAIN NOTHING???
ob_start();

// Connect to database

require '../Content/header1.php';
// TODO: - do one of the following:
// 1. Create functions thats translate view input variables OR
// PROBABLY DO THIS --> 2. Make views into functions that include the HTML view files and take input and convert inputs to correct variables, etc AKA make another layer <--
//require('db_connect.php');
// import class files into controller
require_once '../Models/Ticket.php';
require_once'../Models/User.php';
require_once'../Models/Disposition.php';
require_once '../Models/Employee.php';
require_once '../Models/UserManager.php';
require_once '../Models/Database.php';

// initialize default values for optional entries
$details = "";
$orderid = "";
$vendor = "";


// array of errors
//set inner array to 1 if problem
//pass to view
$ticketEditErrors = array(
    "subject" => array("<p class='text-danger'> ***Please submit valid ticket subject*** </p>", 0),
    "status" => array("<p class='text-danger'> ***Please submit valid ticket status*** </p>", 0),
    "assignedto" => array("<p class='text-danger'> ***Please submit valid user to assign task to*** </p>", 0)
);




$dbc = new Database();
$ticket;
// generate Ticket object
// if any form submitted at all:
// when page is first loaded it will GET. After that with CRUD commands it will POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {




    //verify get and posts requests to avoid errors
    // when accessing page from all tickets view, GET is used
    if (!empty($_GET['ticketno'])) {

        $ticket = Ticket::createFromID($dbc, $_GET['ticketno']);
    }
    // when submitting edit ticket form, post is used
    if (!empty($_POST['ticketno'])) {


        // create initial ticket object that will pull current ticket from db as is
        $ticket_initialize = Ticket::createFromID($dbc, $_POST['ticketno']);

        // define variables for updated ticket
        // non-editable fields will be pulled from $ticket_initialize
        // attributes changed by user will be pulled from post variable

        $ticketID = $ticket_initialize->getId();

        if (!empty($_POST['subject'])) {

            $subject = htmlentities($_POST['subject']);
        } else {

            $ticketEditErrors['subject'][1] = 1;
        }

        if (!empty($_POST['details'])) {

            $details = htmlentities($_POST['details']);
        }


        if (!empty($_POST['orderid'])) {

            $orderid = htmlentities($_POST['orderid']);
        } 

        if (!empty($_POST['priority'])) {

            $priority = htmlentities($_POST['priority']);
        }

        if (!empty($_POST['status'])) {

            $status = htmlentities($_POST['status']);
        } else {

            $ticketEditErrors['status'][1] = 1;
        }

        if (!empty($_POST['category'])) {

            $category = htmlentities($_POST['category']);
        }

        if (!empty($_POST['assignedto'])) {

            $assignedto = htmlentities($_POST['assignedto']);
        } else {


            $ticketEditErrors['assignedto'][1] = 1;
        }

        
        
        if (!empty($_POST['requestedby'])) {

            $requestedby = htmlentities($_POST['requestedby']);
        } else {


            //$requestedby = $ticket_initialize->getRequestedBy();
        }
        
        


        $userID = $ticket_initialize->getUserID();
        
        $datesubmitted = $ticket_initialize->getDateSubmitted();
        $completed = $ticket_initialize->getCompleted();
        $dateresolved = NULL;
        $vendor = $_POST['vendor'];
        $reason = NULL;
        $issue = false;

        // check to see if any errors
        foreach ($ticketEditErrors as $errors) {

            if ($errors[1] == 1) {

                $issue = true;
                break;
            }
        }
        // if no issue, update ticket
        if(!$issue){
            
            // create NEW updated ticket object from user form.
            $ticket = Ticket::create($dbc, $ticketID, $subject, $details, $userID, $requestedby, $datesubmitted, $dateresolved, $orderid, $priority, $category, $status, $assignedto, $completed, $vendor, $reason);

            // update this ticket (and subsquently equivallant ticket in db
            $ticket->update();
            
        // if issue, set ticket back to default ticket
        } else {
            
            $ticket = $ticket_initialize;
            
        }

 
    }

    if (!empty($_POST['submitCloseTicket'])) {

        $ticket = Ticket::createFromID($dbc, $_POST['tickno2']);


        if (!empty($_POST['reason']) && $ticket->getCompleted() == "NO") {


            $reason = htmlentities($_POST['reason']);
            $completed = "YES";


            $ticket->close($reason);
        } else {




            $ticket = Ticket::createFromID($dbc, $_POST['tickno2']);
            $ticket->open();

        }
    }


    if (!empty($_POST['submitDeleteTicket'])) {

        $ticket = Ticket::createFromID($dbc, $_POST['tickno3']);
        $ticket->delete();

        // redirect back to tickets page since ticket details are from object and no longer valid
        header('Location: ticketsController.php');
    }
}

$id = $ticket->getId();
$allDispositions = Disposition::getDispositionsByTicket($dbc, $id);
// generate views

$ticket = Ticket::createFromID($dbc, $id);



$employees = Employee::getEmployees($dbc);
$users = User::getUsers($dbc);
include("../Views/ticketDetailView.php");
include("../Views/ticketEditView.php");


include("../Views/allDispositionsByTicketView.php");


include('../Views/dispositionSubmitView.php');
require('../Views/closeTicketViewModal.php');
include('../Views/deleteTicketViewModal.php');

// close master container div
echo "</div>";








require('../Content/footer1.php');
?>
