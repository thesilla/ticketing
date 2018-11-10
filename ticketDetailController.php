<?php
// Connect to database
require('db_connect.php');

// import class files into controller
include('Ticket.php');




// show all tickets
// return array of all ticket objects from database
$allTickets = Ticket::getTickets($dbc);
include("ticketDetailView.php");



?>
