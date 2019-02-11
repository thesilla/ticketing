<?php

// Connect to database
//require('db_connect.php');

// import class files into controller
require_once '../models/Ticket.php'; 
require_once'../models/User.php';
require_once'../models/Disposition.php';
require_once '../models/Employee.php';
require_once '../models/UserManager.php';
require_once '../models/database.php';
include'../content/header1.php';










//echo phpinfo();

//initialize error variable
// TODO - create class that handles errors and generates appropriate messages
// - OR create error functionality within Ticket class??? need to decide
$problem = false;
// Must initialize here to avoid error since this field is not mandatory
$orderID = "";
$vendor = "";
$dbc = new database();
// if ticket form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
    
    
}


//include reports home view






require('../content/footer2.php');
?>
