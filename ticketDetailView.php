<?PHP
require('db_connect.php');
include('class.php');
$ticket = Ticket::createFromID($_POST['ticketno'], $dbc);
//print_r($ticket);
?>






<div id="ticketNumber">Ticket Number: <?php echo $ticket->getId(); ?> </div>
<div id="userID">Submitted By: <?php echo $ticket->getUserID(); ?> </div>
<div id = "category"> Category: <?php echo $ticket->getCategory(); ?> </div>
<div id = "subject"> Subject: <?php echo $ticket->getSubject(); ?> </div>
<div id = "body"> Details: <?php echo $ticket->getBody(); ?> </div>
<div id = "dateSubmitted"> Date Submitted: <?php echo $ticket->getDateSubmitted(); ?> </div>
<div id = "priority"> Priority: <?php echo $ticket->getPriority(); ?> </div>
<div id = "dateResolved"> Date Resolved: <?php echo $ticket->getDateResolved(); ?> </div>

<button id="editTicketButton"> Edit Ticket Details </button>


<div id = "editTicket">

    <form action = "ticketDetailController.php" method = "post">
        <label for="category"> Category </label>
        <input id ="changeCategory" name ="category" type ="text" placeholder =<?php echo  "\"" . $ticket->getCategory() ."\""; ?>>
        <label for="subject"> Category </label>
        <input id ="changeSubject" name ="subject" type ="text" placeholder =<?php echo "\"" . $ticket->getSubject() . "\""; ?>>
        <input name = 'ticketno' id = 'editTicket' type = 'hidden' value = <?php echo "\"" . $ticket->getId() . "\""; ?>> 
        
        <input id ="editTicketSubmit" name ="submit" type ="submit" value ="Update Ticket">
    </form>    
    

</div>


<?php



// TODO


?>


