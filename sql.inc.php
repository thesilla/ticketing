<?php
$sql_showTix = "SELECT * FROM tickets";

$sql_deleteTix;


$sql_addTix = "INSERT INTO `tickets` (`ticketID`, `subject`, `body`, `userID`, `datesubmitted`, `dateresolved`, `orderID`, `priority`, `category`, `status`) VALUES (NULL,'$this->subject','$this->body', '$this->userID','$this->dateSubmitted',NULL,'$this->orderID', '$this->priority','$this->category','$this->status')";


$sql_editTix;


// need to add SQL for all getters and setters
