<?php



require('db_connect.php');

// import class files into controller
include('Ticket.php');
include('Disposition.php');
include('User.php');


// TODO - Disposition submit logic here
//  - Then re route back to Ticket Detail View
//  - - build dynamic get request and send back to proper ticket detail page


// TODO - USER ID should be taken from session variable
//  - user that is currently logged in


// TODO - Fix DATE SUBMITTED time stamp - not currently working

// initialize ticket ID variable for future use
$ticketno;

if ($_SERVER['REQUEST_METHOD']==="POST"){
    
    if(!empty($_POST['ticketno'])){
        
        // store ticket number in variable for later
        $ticketno = $_POST['ticketno'];
        
        if(!empty($_POST['disposition'])){
            
            // Set default time zone
            date_default_timezone_set('America/New_York');
            
            $dispoID = 0;
            $userID = "mgillman"; // FIXME - MAKE THIS DYNAMIC IN THE FUTURE - PULL FROM SESSION
            $body = $_POST['disposition'];
            $dateSubmitted = date('m/d/Y h:i:s a', time());
            $ticketID = $ticketno;        
            $disposition = Disposition::create($dispoID, $userID, $body, $dateSubmitted, $ticketID);
            $disposition->add($dbc);
            
            
        }
        
        
    }
 
    
}


// re-direct back to ticket details controller
// use GET request and current ticket number in URL
$url = "Location: ticketDetailController.php?ticketno=" . $ticketno;
header($url);
exit;
?>