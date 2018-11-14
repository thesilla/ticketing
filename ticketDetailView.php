<?PHP
// must define $ticket variable with Ticket object for this to work

?>




<div id="ticket-display">
    <h1> TICKET # <?php echo " " . $ticket->getId() . " "; ?> - DETAILS</h1>

    <!-- <div id="ticketNumber">Ticket Number: <?php //echo $ticket->getId(); ?> </div> -->
    <div id="userID">Submitted By: <?php echo $ticket->getUserID(); ?> </div>
    <div id = "category"> Category: <?php echo $ticket->getCategory(); ?> </div>
    <div id = "subject"> Subject: <?php echo $ticket->getSubject(); ?> </div>
    <div id = "body"> Details: <?php echo $ticket->getBody(); ?> </div>
    <div id = "dateSubmitted"> Date Submitted: <?php echo $ticket->getDateSubmitted(); ?> </div>
    <div id = "priority"> Priority: <?php echo $ticket->getPriority(); ?> </div>
    <div id = "dateResolved"> Date Resolved: <?php echo $ticket->getDateResolved(); ?> </div>
    <div id = "status"> Status: <?php echo $ticket->getStatus(); ?> </div>
    <div id = "requestedBy"> Originally Requested By: <?php echo $ticket->getRequestedBy(); ?> </div>
    <div id = "assignedto"> Assigned To: <?php echo $ticket->getAssignedTo(); ?> </div>
    <div id = "orderid"> Order ID: <?php echo $ticket->getOrderID(); ?> </div>
    <div id = "completed"> Complete? <?php echo $ticket->getCompleted(); ?> </div>

    

</div>
<button id="editTicketButton"> Edit Ticket Details </button>
<!-- Hidden HTML for editing ticket - displayed through JS -->
<div id = "editTicket">
    <button id="closeEditTicket"> X </button>
    <h2>Ticket #: <?php echo $ticket->getId(); ?></h2>
    <div>Submitted By: <?php echo $ticket->getUserID(); ?></div>
    <div>Date Submitted: <?php echo $ticket->getDateSubmitted(); ?></div>


    <form id = "editTicketForm" action = "ticketDetailController.php" method = "post">
        <div> Category: </div>
        <input id ="changeCategory" name ="category" type ="text" value =<?php echo "\"" . $ticket->getCategory() . "\""; ?>>
        <div> Subject: </div>
        <input id ="changeSubject" name ="subject" type ="text" value =<?php echo "\"" . $ticket->getSubject() . "\""; ?>>
       
        <div> Details: </div>
        <textarea rows="10" name="details" form="editTicketForm"><?php echo  $ticket->getBody(); ?> </textarea>
  
        <div> Priority: </div>
        <input id ="changeSubject" name ="priority" type ="text" value =<?php echo "\"" . $ticket->getPriority() . "\""; ?>>
        <div> Assigned To: </div>
        <input id ="changeAssignedTo" name ="assignedto" type ="text" value =<?php echo "\"" . $ticket->getAssignedTo() . "\""; ?>>
        <div> Order ID: </div>
        <input id ="changeOrderID" name ="orderid" type ="text" value =<?php echo "\"" . $ticket->getOrderID() . "\""; ?>>
        <div> Status: </div>
        <input id ="changeStatus" name ="status" type ="text" value =<?php echo "\"" . $ticket->getOrderID() . "\""; ?>>
        
        <div> Completed? </div>
        <input type="checkbox" name="completed" value="completed">

        <div>
            <input name = 'ticketno' id = 'editTicket' type = 'hidden' value = <?php echo "\"" . $ticket->getId() . "\""; ?>> 
            <input id ="editTicketSubmit" name ="submit" type ="submit" value ="Update Ticket">
        </div>

    </form>    


</div>




