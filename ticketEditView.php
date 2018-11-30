<!-- Hidden HTML for editing ticket - displayed through JS -->
<div id = "editTicket"  class="alert alert-dismissible alert-secondary">
    
    <h2>Ticket #: <?php echo $ticket->getId(); ?> - Modify</h2>
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
        <div> Vendor: </div>
        <input id ="changeOrderID" name ="vendor" type ="text" value =<?php echo "\"" . $ticket->getVendor() . "\""; ?>>
        <div> Status: </div>
        <input id ="changeStatus" name ="status" type ="text" value =<?php echo "\"" . $ticket->getStatus() . "\""; ?>>


        <div>
            <input name = 'ticketno' id = 'editTicket' type = 'hidden' value = <?php echo "\"" . $ticket->getId() . "\""; ?>> 
            <input id ="editTicketSubmit" name ="submit" type ="submit" value ="Update Ticket">
            <button id="closeEditTicket"> Cancel </button>
        </div>

    </form>    


</div>


<script>

function editTicket(){
    
   	var ticketContainer1 = document.getElementById('editTicket');
	
	ticketContainer1.style.display = "block"; 
    
    
}

function closeEditTicket(){
    
   	var ticketContainer2 = document.getElementById('editTicket');
	
	ticketContainer2.style.display = "none"; 
    
    
}


var closeEditTicketButton = document.getElementById('closeEditTicket');
closeEditTicketButton.onclick = closeEditTicket;

var editTicketButton = document.getElementById('editTicketButton');
editTicketButton.onclick = editTicket;


    
</script>