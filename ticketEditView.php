<!-- Hidden HTML for editing ticket - displayed through JS -->
<div id = "editTicket"  class="alert alert-dismissible alert-secondary">
    <button id="closeEditTicket"> &times; </button>
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
        <input id ="changeStatus" name ="status" type ="text" value =<?php echo "\"" . $ticket->getStatus() . "\""; ?>>
        
        <div> Completed? </div>
        <input type="checkbox" name="completed" value="completed">

        <div>
            <input name = 'ticketno' id = 'editTicket' type = 'hidden' value = <?php echo "\"" . $ticket->getId() . "\""; ?>> 
            <input id ="editTicketSubmit" name ="submit" type ="submit" value ="Update Ticket">
        </div>

    </form>    


</div>
