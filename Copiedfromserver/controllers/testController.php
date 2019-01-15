<?php
require_once '../models/Ticket.php'; 
require_once'../models/User.php';
require_once'../models/Disposition.php';
require_once '../models/Employee.php';
require_once '../models/UserManager.php';
require_once '../models/database.php';


$conn = new database();
$id = intval($_REQUEST['id']);
$ticket = Ticket::createFromID($conn, $id)


?>

<div id="changeme"> <?php echo $ticket->getSubject() ?> </div>


