<?PHP
// must define $ticket variable with Ticket object for this to work

/*
if($ticket->getCompleted()=="YES"){
    
    echo '<span class="badge badge-danger">CLOSED</span>';
} else {
    
    echo '<span class="badge badge-success">OPEN</span>';
    
}

*/

?>


<div><a href = "ticketsController.php">Return To Tickets</a></div>

<div id="ticketHeader" style= <?php if($ticket->getCompleted()=="YES"){echo "\"" . "color: red;" . "\"";} else {echo "\"" . "color: green;" . "\"";}  ?>    >
    <h3 id="title" class="display-4"> TICKET # <?php if($ticket->getCompleted()=="YES"){echo " " . $ticket->getId() . " - <strong>CLOSED<strong>";}else {echo " " . $ticket->getId() . " - <strong>OPEN<strong>";} ?>  </h3>
    <div id = "priorityAlert" class="<?php
    if ($ticket->getPriority() == 1) {
        echo "alert alert-dismissible alert-danger";
    } else {
        if ($ticket->getPriority() == 2) {
            echo "alert alert-dismissible alert-warning";
        } else {
            echo "alert alert-dismissible alert-primary";
        }
    }
    ?>">



<?php echo "Priority " . $ticket->getPriority(); ?>


    </div>
</div>
<!-- Ticket controls -->
<div class="ticketControls">


    <button id="editTicketButton" type="button" class="btn btn-primary">Edit Ticket Details</button>
    <button id ="closeTicketButton" type="button" class="btn btn-warning">Close Ticket</button>
    <button id="deleteTicketDisplayButton" type="button" class="btn btn-danger">Delete Ticket </button>
    <button id="addDispositionButton" class="btn btn-success"> Add Disposition </button>

</div>
<hr class="my-4">




<h4>Subject</h4><div id = "subject">  <?php echo $ticket->getSubject(); ?> </div>

<!-- <div id="ticketNumber">Ticket Number: <?php //echo $ticket->getId();        ?> </div> -->
<h4>Submitted By</h4><div id="userID"><?php echo $ticket->getUserID(); ?> </div>
<h4>Category</h4><div id = "category"> <?php echo $ticket->getCategory(); ?> </div>

<h4>Details</h4><div id = "body">  <?php echo $ticket->getBody(); ?> </div>
<h4>Date Submitted</h4><div id = "dateSubmitted"> <?php echo $ticket->getDateSubmitted(); ?> </div>
<!--<h4>Priority</h4><div id = "priority"> <?php echo $ticket->getPriority(); ?> </div> -->
<h4>Date Resolved</h4><div id = "dateResolved">  <?php echo $ticket->getDateResolved(); ?> </div>
<h4>Status:</h4><div id = "status"> <?php echo $ticket->getStatus(); ?> </div>
<h4> Originally Requested By</h4><div id = "requestedBy"> <?php echo $ticket->getRequestedBy(); ?> </div>
<h4> Assigned To </h4><div id = "assignedto"><?php echo $ticket->getAssignedTo(); ?> </div>
<h4> Order ID</h4><div id = "orderid"> <?php echo $ticket->getOrderID(); ?> </div>
<h4> Vendor</h4><div id = "vendor"><?php echo $ticket->getVendor(); ?> </div>
<!--<div id = "completed"> Complete? <?php echo $ticket->getCompleted(); ?> </div> -->


<!--<button id="editTicketButton" class="btn btn-warning" > Edit Ticket Details </button> -->





