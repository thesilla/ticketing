


<div id="ticket-display" class="jumbotron">
    <div style="font-size:12pt;"><a href = "ticketsController.php">Return To Tickets</a></div>

<br/>



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
        <div class="card-body" style="text-align: center;">
            <h4 class="card-title"><?php
                if ($ticket->getCompleted() == "YES") {
                    echo "<strong>CLOSED<strong>";
                } else {
                    echo "<strong>OPEN<strong>";
                }
                ?></h4>
            <p class="card-text"><?php echo $ticket->getSubject(); ?></p>

<!-- update status dropdown -->

            <form action = "ticketDetailController.php" method = "post">
                <input type ="hidden" name ="status-ticketno" value=<?php echo $ticket->getID();  ?>>
                <select  id="statusOnDetailPage" name="status-main" onchange="this.form.submit()">

                    <?php
//TODO - add more statuses
                    $statuses = array("Awaiting Agent Reply", "Awaiting Vendor Reply", "Awaiting Sales Reply", "Awaiting Warehouse Reply", "IT Case Pending");

                    foreach ($statuses as $status) {

                        if ($status == $ticket->getStatus()) {

                            echo "<option value=" . "\"" . $status . "\"" . "selected>" . $status . "</option>";
                        } else {

                            echo "<option value=" . "\"" . $status . "\">" . $status . "</option>";
                        }
                    }
                    ?>
                </select>
                <?php
                if ($ticketEditErrors['status'][1] == 1) {
                    echo $ticketEditErrors['status'][0];
                }
                ?>




                
            </form>




        </div>
    </div>


    <div id = "priorityAlert" class="<?php
    if ($ticket->getPriority() == 1) {
        echo "priority1";
    } else {
        if ($ticket->getPriority() == 2) {
            echo "priority2";
        } else {
            echo "priority3";
        }
    }
    ?>">



        <?php
        if ($ticket->getPriority() == 1) {
            echo "<p>Priority </p><p>" . $ticket->getPriority();
            echo " </p><p>HIGH</p>";
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

<div id="details-container">
    <table class="details-display-table">
        <tr>
            
            <th>Requested By</th>
            <th>Submitted By</th>
            <th>Assigned To</th>
            
            
            
 
        </tr>
        <tr>
            <td><div class = "detail-div"><?php echo $ticket->getRequestedby(); ?></div></td>
            <td><div class = "detail-div"><?php echo $ticket->getUserID(); ?></div></td>
            <td><div class = "detail-div"><?php echo $ticket->getAssignedTo(); ?></div></td>
        </tr>

        <tr>
            
            
            <th>Category</th>
            <th>Vendor</th>
            <th>Order ID</th>
          
            
            
            
        </tr>
        <tr>
            
            
            <td><div class = "detail-div"><?php echo $ticket->getCategory(); ?></div></td>
            <td><div class = "detail-div"><?php echo $ticket->getVendor(); ?></div></td>
            <td><div class = "detail-div"><?php echo $ticket->getOrderID(); ?></div></td>
            
 
        </tr>
 

        
        <tr>
            <th>Date Submitted</th>
            <th>Date Resolved</th> 
            <th>Reason For Closure</th> 
            
        </tr>
        <tr>

            <td><div class = "detail-div"><?php echo $ticket->getDateSubmitted(); ?></div></td>
            <td><div class = "detail-div"><?php echo $ticket->getDateResolved(); ?></div></td>
            <td><div class = "detail-div"><?php echo $ticket->getReason(); ?></div></td>
            


        </tr>
    </table>
    
    
    
    
</div>

<!--
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
            <h4 class="card-title"><?php echo $ticket->getRequestedby(); ?></h4>
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
-->

<br/>
    <div class="card border-secondary mb-3">
        <div class="card-header"><h1>Details</h1></div>
    <div class="card-body">
        <p class="card-text"><?php echo $ticket->getBody(); ?></p>
    </div>
</div>


