





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

        // if completed it checked, change to YES.
        // If not, submit as NO
        // remove completed from ticket edit view functionality
        //if (!empty($_POST['completed'])) {

        //    $completed = "YES";
        //} else {


        //    $completed = "NO";
        //}


        // create initial ticket object that will pull current ticket from db as is
        $ticket_initialize = Ticket::createFromID($dbc, $_POST['ticketno']);
        
        // define variables for updated ticket
        // non-editable fields will be pulled from $ticket_initialize
        // attributes changed by user will be pulled from post variable
        // TODO: - Add filtering to post items for security purposes
        $ticketID = $ticket_initialize->getId();
        
        if (!empty($_POST['subject'])){
            
            $subject = $_POST['subject'];
            
        }
        
        if (!empty($_POST['details'])){
            
            $details = $_POST['details'];
            
        } else {
            
            $details = "not working";
            
            
        }
        
        
        if (!empty($_POST['orderid'])){
            
            $orderid = $_POST['orderid'];
            
        }
        
        if (!empty($_POST['priority'])){
            
            $priority = $_POST['priority'];
            
        }
        
        if (!empty($_POST['status'])){
            
            $status = $_POST['status'];
            
        }
        
        if (!empty($_POST['category'])){
            
            $category = $_POST['category'];
            
        }
        
        if (!empty($_POST['assignedto'])){
            
            $assignedto = $_POST['assignedto'];
            
        }
        
     
        
        $userID = $ticket_initialize->getUserID();
        $requestedby = $ticket_initialize->getRequestedBy();
        $datesubmitted = $ticket_initialize->getDateSubmitted();
        $completed = $ticket_initialize->getCompleted();
        $dateresolved = NULL;
        $vendor = $_POST['vendor'];
        $reason = NULL;
        
        // create NEW updated ticket object from user form.
        $ticket = Ticket::create($dbc, $ticketID, $subject, $details, $userID, $requestedby, $datesubmitted, $dateresolved, $orderid, $priority, $category, $status, $assignedto, $completed, $vendor, $reason);
        $ticket->update();
        
    }
    
    if (!empty($_POST['submitCloseTicket'])) {
        
        $ticket = Ticket::createFromID($dbc, $_POST['tickno2']);
        
        
        if(!empty($_POST['reason']) && $ticket->getCompleted()=="NO"){
        

        $reason = $_POST['reason'];
        $completed = "YES";
        
        
        $ticket->close($reason);
        
            
        } else {
            
            
            

            $ticket = Ticket::createFromID($dbc, $_POST['tickno2']);
            $ticket->open();
            
            
            
       
            // SHOW ERROR MESSAGE - FIELD IS EMPTY
            
        }
        
        
        
        
    }
    
    
   if (!empty($_POST['submitDeleteTicket'])){
       
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

//echo '<div id="ticket-display" class="jumbotron">';

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
