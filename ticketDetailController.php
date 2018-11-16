





<?php

// Connect to database

require('header1.php');
// TODO: - do one of the following:
// 1. Create functions thats translate view input variables OR
// PROBABLY DO THIS --> 2. Make views into functions that include the HTML view files and take input and convert inputs to correct variables, etc AKA make another layer <--


require('db_connect.php');

// import class files into controller
include('Ticket.php');
include('Disposition.php');
include('User.php');

// generate Ticket object
// if any form submitted at all:
// when page is first loaded it will GET. After that with CRUD commands it will POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {



    //verify get and posts requests to avoid errors
    // when accessing page from all tickets view, GET is used
    if (!empty($_GET['ticketno'])) {

        $ticket = Ticket::createFromID($_GET['ticketno'], $dbc);
    }
    // when submitting edit ticket form, post is used
    if (!empty($_POST['ticketno'])) {

        // if completed it checked, change to YES.
        // If not, submit as NO
        if (!empty($_POST['completed'])) {

            $completed = "YES";
        } else {


            $completed = "NO";
        }


        // create initial ticket object that will pull current ticket from db as is
        $ticket_initialize = Ticket::createFromID($_POST['ticketno'], $dbc);
        
        // define variables for updated ticket
        // non-editable fields will be pulled from $ticket_initialize
        // attributes changed by user will be pulled from post variable
        // TODO: - Add filtering to post items for security purposes
        $ticketID = $ticket_initialize->getId();
        $subject = $_POST['subject'];
        $details = $_POST['details'];
        $orderid = $_POST['orderid'];
        $priority = $_POST['priority'];
        $status = $_POST['status'];
        $category = $_POST['category'];
        $assignedto = $_POST['assignedto'];
        $userID = $ticket_initialize->getUserID();
        $requestedby = $ticket_initialize->getRequestedBy();
        $datesubmitted = $ticket_initialize->getDateSubmitted();
        $dateresolved = NULL;
        
        // create NEW updated ticket object from user form.
        $ticket = Ticket::create($ticketID, $subject, $details, $userID, $requestedby, $datesubmitted, $dateresolved, $orderid, $priority, $category, $status, $assignedto, $completed);
        $ticket->update($dbc);
    }
}


// generate views
//$ticket = Ticket::createFromID($_GET['ticketno'], $dbc);
include("ticketDetailView.php");
include("ticketEditView.php");

$id = $ticket->getId();
$allDispositions = Disposition::getDispositionsByTicket($id, $dbc);
include("allDispositionsByTicketView.php");


include('dispositionSubmitView.php');










require('footer1.php');
?>
