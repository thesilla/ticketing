<?php

require_once '../Models/Ticket.php';
require_once'../Models/User.php';
require_once'../Models/Disposition.php';
require_once '../Models/Employee.php';
require_once '../Models/UserManager.php';
require_once '../Models/Database.php';

include'../Content/header2.php';


$ticketno;
$conn = new Database();

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if (!empty($_POST['ticketno'])) {

        // store ticket number in variable for later
        $ticketno = $_POST['ticketno'];

        if (!empty($_POST['disposition'])) {

            // Set default time zone
            date_default_timezone_set('America/New_York');

            $dispoID = 0;
            $userID = $_SESSION['username']; // FIXME - MAKE THIS DYNAMIC IN THE FUTURE - PULL FROM SESSION
            $body = htmlentities($_POST['disposition']);

            // --Technically time doesn't matter, submitted on SQL/server side
            $dateSubmitted = "";

            $ticketID = $ticketno;
            $disposition = Disposition::create($conn, $dispoID, $userID, $body, $dateSubmitted, $ticketID);
            $disposition->add();
        }
    }

    if (!empty($_POST['editDispo'])) {



        if (!empty($_POST['dispono'])) {

            // store ticket number in variable for later
            $dispoID = htmlentities($_POST['dispono']);
        }

        if (!empty($_POST['newDispoBody'])) {


            $body = htmlentities($_POST['newDispoBody']);
        }

        $dispo = Disposition::createFromDispoID($conn, $dispoID);
        $dispo->setBody($body);
        $dispo->update();

        // get ticket number to pass into header and re-direct back to ticket detail controller
        $ticketno = $dispo->getTicketID();
    }

    // Delete disposition

    if (!empty($_POST['deleteDispo'])) {


        if (!empty($_POST['dispono'])) {

            // store ticket number in variable for later
            $dispoID = htmlentities($_POST['dispono']);
        }

        $dispo = Disposition::createFromDispoID($conn, $dispoID);
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