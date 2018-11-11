<?php
// Connect to database


// TODO: - do one of the following:
// 1. Create functions thats translate view input variables OR
// PROBABLY DO THIS --> 2. Make views into functions that include the HTML view files and take input and convert inputs to correct variables, etc AKA make another layer <--


require('db_connect.php');

// import class files into controller
include('Ticket.php');
include('Disposition.php');

// generate Ticket object
$ticket = Ticket::createFromID($_POST['ticketno'], $dbc);
include("ticketDetailView.php");

$id = $ticket->getId();
$allDispositions = Disposition::getDispositionsByTicket($id,$dbc);
include("allDispositionsByTicketView.php");


?>
