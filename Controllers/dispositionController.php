<?php

//require('header1');


// import class files into controller
include('../Models/Ticket.php');
include('../Models/Disposition.php');
include('../Models/User.php');
//require('footer1');
// TODO - Disposition submit logic here
//  - Then re route back to Ticket Detail View
//  - - build dynamic get request and send back to proper ticket detail page
// TODO - USER ID should be taken from session variable
//  - user that is currently logged in
// TODO - Fix DATE SUBMITTED time stamp - not currently working
// initialize ticket ID variable for future use
$ticketno;

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if (!empty($_POST['ticketno'])) {

        // store ticket number in variable for later
        $ticketno = $_POST['ticketno'];

        if (!empty($_POST['disposition'])) {

            // Set default time zone
            date_default_timezone_set('America/New_York');

            $dispoID = 0;
            $userID = "mgillman"; // FIXME - MAKE THIS DYNAMIC IN THE FUTURE - PULL FROM SESSION
            $body = $_POST['disposition'];
            
            // --Technically time doesn't matter, submitted on SQL/server side
            //$dateSubmitted = date('m-d-Y h:i:s');
            //$t = time();
            //$dateSubmitted = date("Y-m-d", $t);
            $dateSubmitted ="";
            
            $ticketID = $ticketno;
            $disposition = Disposition::create($dispoID, $userID, $body, $dateSubmitted, $ticketID);
            $disposition->add();
        }
    }

    if (!empty($_POST['editDispo'])) {



        if (!empty($_POST['dispono'])) {

            // store ticket number in variable for later
            $dispoID = $_POST['dispono'];
        }

        if (!empty($_POST['newDispoBody'])) {


            $body = $_POST['newDispoBody'];
        }

        $dispo = Disposition::createFromDispoID($dispoID);
        $dispo->setBody($body);
        $dispo->update();

        // get ticket number to pass into header and re-direct back to ticket detail controller
        $ticketno = $dispo->getTicketID();
    }

    // Delete disposition

    if (!empty($_POST['deleteDispo'])) {


        if (!empty($_POST['dispono'])) {

            // store ticket number in variable for later
            $dispoID = $_POST['dispono'];
        }

        $dispo = Disposition::createFromDispoID($dispoID);
        $dispo->delete();


        // get ticket number to pass into header and re-direct back to ticket detail controller
        $ticketno = $dispo->getTicketID();
    }
}


// re-direct back to ticket details controller
// use GET request and current ticket number in URL
$url = "Location: ticketDetailController.php?ticketno=" . $ticketno;
header($url);
exit;
?>