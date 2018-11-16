<?php

// Connect to database
require('db_connect.php');

// import class files into controller
include('Ticket.php');
include('User.php');
include('Disposition.php');

//initialize error variable
// TODO - create class that handles errors and generates appropriate messages
// - OR create error functionality within Ticket class??? need to decide
$problem;

// if ticket form submitted
if ($_SERVER['REQUEST_METHOD']==='POST'){
    
    
    if (!empty($_POST['subject'])){
        
        $subject = $_POST['subject'];
    } else {
        
        echo "<div> Please Enter Subject </div>";
        $problem = true;
        
    }
    
    if (!empty($_POST['details'])){
        
        $body = $_POST['details'];
    } else {
        
        echo "<div> Please Enter ticket details </div>";
        $problem = true;
        
    }
    
    
    if (!empty($_POST['requestedby'])){
        
        $requestedBy = $_POST['requestedby'];
    } else {
        
        echo "<div> Please provide the name of individual requesting ticket </div>";
        $problem = true;
        
    }
       
    if (!empty($_POST['orderid'])){
        
        $orderID = $_POST['orderid'];
    } 
    
    if (!empty($_POST['priority'])){
        
        $priority = $_POST['priority'];
    } else {
        
        echo "<div> Please provide priority level </div>";
        $problem = true;
        
    }
    
    if (!empty($_POST['category'])){
        
        $category = $_POST['category'];
    } else {
        
        echo "<div> Please provide topic category </div>";
        $problem = true;
        
    }
    
    if (!empty($_POST['assignedto'])){
        
        $assignedTo = $_POST['assignedto'];
    } else {
        
        echo "<div> Please indicate which agent ticket will be assigned to </div>";
        $problem = true;
        
    }
    
    $id = 0;
    //date_default_timezone_set('Australia/Melbourne');
    $dateSubmitted = date('m/d/Y h:i:s a');
    $status = "Waiting on Agent";
    $completed = "NO";
    $dateResolved = NULL;
    
    // TODO - pull user from current session, dont always use mgillman
    $userID = "mgillman";
    
    
    // TODO -use objects to verify errors etc?
    if (!$problem){
        
        $ticket1 = Ticket::create($id, $subject, $body, $userID, $requestedBy, $dateSubmitted, $dateResolved, $orderID, $priority, $category, $status, $assignedTo, $completed);
        $ticket1->add($dbc);
        
    }
    

    

    
}










// show all tickets
// return array of all ticket objects from database
$allTickets = Ticket::getTickets($dbc);

$allusers = User::getUsers($dbc);

include("ticketsView.php");
include("ticketSubmitView.php");



require('footer2.php');
?>