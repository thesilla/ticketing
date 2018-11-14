<?php

// Connect to database
require('db_connect.php');

// import class files into controller
include('Ticket.php');
include('User.php');
include('Disposition.php');




// show all tickets
// return array of all ticket objects from database
$allTickets = Ticket::getTickets($dbc);

$allusers = User::getUsers($dbc);

include("ticketsView.php");


?>