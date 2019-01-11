<?php
require_once '../Models/Ticket.php'; 
require_once'../Models/User.php';
require_once'../Models/Disposition.php';
require_once '../Models/Employee.php';
require_once '../Models/UserManager.php';
require_once '../Models/Database.php';


$conn = new Database();
$id = intval($_REQUEST['id']);
$ticket = Ticket::createFromID($conn, $id)


?>

<div id="changeme"> <?php echo $ticket->getSubject() ?> </div>


