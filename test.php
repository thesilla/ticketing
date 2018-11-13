<?php


// Connect to database
require('db_connect.php');

// import class files into controller
include('Ticket.php');
include('User.php');
include('Disposition.php');



// *******************TESTING AREA*******************





// test add user - WORKS
//test update user - WORKS

//$sayward = User::create("sperregrino", "Sayward", "update worked", "sperregrino@tilemarketofde.com", "Purchasing MASTER", "tilemarket1");
//$sayward->update($dbc);
//test add
//$sayward->add($dbc);

//user delete test - WORKS
//$userID = "sperregrino";
//$sayward = User::createFromID($userID, $dbc);
//$sayward->delete($dbc);

//ticket delete test - WORKS
//$ticket2 = Ticket::createFromID(4, $dbc);
//$ticket2->delete($dbc);



//dispo delete test
//$dispo1 = Disposition::createFromDispoID(2, $dbc);
//$dispo1->setBody("this means that the update method worked");
//$dispo1->update($dbc);
//$dispo1->delete($dbc);


/*

$id = 2;
$subject = "UPDATE TEST";
$body = "IF THIS IS IN DB IT UPDATED CORRECTLY";
$userID = "mgillman";
$requestedBy = 'Gretel';   
$orderID = 'AIDS';
$priority = 1;
$assignedTo = 'Bryan';
$completed = 'NO';        
$date = date("Y-m-d H:i:s");
$status = 'Awaiting Agent Reply';
$c = "Need ETA";
//$ticket1 = Ticket::create($id, $subject, $body, $userID,$requestedBy, $dateSubmitted, $dateResolved, $orderID, $priority, $category, $status, $assignedTo, $completed);
$ticket1 = Ticket::create($id, $subject, $body, $userID,$requestedBy, $date, $date, $orderID, $priority, $c, $status, $assignedTo, $completed);
//$ticket1->add($dbc);

//test of ticket update - WORKS
$ticket1->update($dbc);


*/



?>