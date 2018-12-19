


<div id="ticket-display" class="jumbotron">
    <div><a href = "ticketsController.php">Return To Tickets</a></div>





    <div id="ticketHeader">


        <div id="titlePanel" class=" <?php
        if ($ticket->getCompleted() == 'NO') {
            echo "card text-white bg-success mb-3";
        } else {
            echo "card text-white bg-danger mb-3";
        }
        ?>" </div>
        <div class="card-header">Ticket #<?php
        echo $ticket->getId();
        ?>
        </div>
        <div class="card-body">
            <h4 class="card-title"><?php
                if ($ticket->getCompleted() == "YES") {
                    echo "<strong>CLOSED<strong>";
                } else {
                    echo "<strong>OPEN<strong>";
                }
                ?></h4>
            <p class="card-text"><?php echo "Subject: " . $ticket->getSubject(); ?></p>
        </div>
    </div>


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



        <?php
        if ($ticket->getPriority() == 1) {
            echo "Priority " . $ticket->getPriority();
            echo " HIGH";
        } else {
            if ($ticket->getPriority() == 2) {
                echo "Priority " . $ticket->getPriority();
                echo " MEDIUM";
            } else {
                echo "Priority " . $ticket->getPriority();
                echo " LOW";
            }
        }
        ?>


    </div>
</div>
<!-- Ticket controls -->
<div class="ticketControls">


    <button id="editTicketButton" type="button" class="btn btn-primary">Edit Ticket Details</button>

    <?php
    if ($ticket->getCompleted() == "YES") {

        echo '<button id ="closeTicketButton" type="button" class="btn btn-warning">Re-Open Ticket</button>';
    } else {

        echo '<button id ="closeTicketButton" type="button" class="btn btn-warning">Close Ticket</button>';
    }
    ?>







    <button id="deleteTicketDisplayButton" type="button" class="btn btn-danger">Delete Ticket </button>
    <button id="addDispositionButton" class="btn btn-success"> Add Disposition </button>

</div>
<hr class="my-4">



<div class="details-row">
    <div class="card border-secondary mb-3" style="max-width: 20rem;">
        <div class="card-header">Submitted By</div>
        <div class="card-body">
            <h4 class="card-title"><?php echo $ticket->getUserID(); ?></h4>
        </div>
    </div>

    <div class="card border-secondary mb-3" style="max-width: 20rem;">
        <div class="card-header">Category</div>
        <div class="card-body">
            <h4 class="card-title"><?php echo $ticket->getCategory(); ?></h4>
        </div>
    </div>
    <div class="card border-secondary mb-3" style="max-width: 20rem;">
        <div class="card-header">Date Submitted</div>
        <div class="card-body">
            <h4 class="card-title"><?php echo $ticket->getDateSubmitted(); ?></h4>

        </div>

    </div>

    <div class="card border-secondary mb-3" style="max-width: 20rem;">
        <div class="card-header">Assigned To</div>
        <div class="card-body">
            <h4 class="card-title"><?php echo $ticket->getAssignedTo(); ?></h4>
        </div>
    </div>
</div>

<div class="card border-secondary mb-3">
    <div class="card-header">Details</div>
    <div class="card-body">
        <p class="card-text"><?php echo $ticket->getBody(); ?></p>
    </div>
</div>


<div class="details-row">
    <div class="card border-secondary mb-3" style="max-width: 20rem;">
        <div class="card-header">Date Resolved</div>
        <div class="card-body">
            <h4 class="card-title"><?php echo $ticket->getDateResolved(); ?></h4>
        </div>
    </div>

    <div class="card border-secondary mb-3" style="max-width: 20rem;">
        <div class="card-header">Status</div>
        <div class="card-body">
            <h4 class="card-title"><?php echo $ticket->getStatus(); ?></h4>
        </div>
    </div>

    <div class="card border-secondary mb-3" style="max-width: 20rem;">
        <div class="card-header">Originally Requested By</div>
        <div class="card-body">
            <h4 class="card-title"><?php echo $ticket->getRequestedBy(); ?></h4>
        </div>
    </div>



    <div class="card border-secondary mb-3" style="max-width: 20rem;">
        <div class="card-header"> Order ID</div>
        <div class="card-body">
            <h4 class="card-title"><?php echo $ticket->getOrderID(); ?></h4>
        </div>
    </div>

    <div class="card border-secondary mb-3" style="max-width: 20rem;">
        <div class="card-header"> Vendor</div>
        <div class="card-body">
            <h4 class="card-title"><?php echo $ticket->getVendor(); ?></h4>
        </div>
    </div>

</div>






