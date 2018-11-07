<?php

// Connect to database
require('db_connect.php');

// import class files into controller
include('class.php');




// show all tickets
// return array of all ticket objects from database
$allTickets = Ticket::getTickets($dbc);
include("ticketsView.php");



// *******************TESTING AREA*******************

/*
$date = date("Y-m-d H:i:s");
$status = 'Awaiting Agent Reply';
$c = "Need ETA";

$ticket1 = Ticket::create(0, "OOP Test #2", "This is a test of MVC second constructor", "thesilla", $date, $date, 5, 1, $c, $status);
//$ticket1->add($dbc);


$ticket2 = Ticket::createFromID(40, $dbc);
print_r($ticket2);
*/

?>