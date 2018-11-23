<?PHP
// must define $ticket variable with Ticket object for this to work

?>


<div><a href = "ticketsController.php">Return To Tickets</a></div>

<div id="ticket-display" class="jumbotron">
    <h1 class="display-3"> TICKET # <?php echo " " . $ticket->getId() . " "; ?> - DETAILS</h1>

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

<div class="jumbotron">
  <h1 class="display-2">Hello, world!</h1>
  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  <hr class="my-4">
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
  </p>
</div>



<!-- TODO - make this into its own view? -->  




