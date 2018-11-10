<?php

// Connect to database
require('db_connect.php');

// import class files into controller
include('Ticket.php');




// show all tickets
// return array of all ticket objects from database
$allTickets = Ticket::getTickets($dbc);
include("ticketsView.php");



// *******************TESTING AREA*******************


/*

$id = 0;
$subject = "OOP Test #3";
$body = "This is a test of MVC second constructor";
$userID = "mgillman";
$requestedBy = 'Gretel';   
$orderID = '1076369';
$priority = 1;
$assignedTo = 'Bryan';
$completed = 'NO';        
$date = date("Y-m-d H:i:s");
$status = 'Awaiting Agent Reply';
$c = "Need ETA";
//$ticket1 = Ticket::create($id, $subject, $body, $userID,$requestedBy, $dateSubmitted, $dateResolved, $orderID, $priority, $category, $status, $assignedTo, $completed);
$ticket1 = Ticket::create($id, $subject, $body, $userID,$requestedBy, $date, $date, $orderID, $priority, $c, $status, $assignedTo, $completed);
$ticket1->add($dbc);


//$ticket2 = Ticket::createFromID(40, $dbc);
//print_r($ticket2);

*/
?>