







<!-- Close ticket modal -->
<?php
// Reasons for closing ticket
$reasons = array("No Response From Customer", "No Response From Vendor", "Issue Resolved", "Customer Cancelled", "Product Unavailable");
?>







<div  id="ticket-close-container" class="alert alert-dismissible alert-secondary" >

    <div>
        <form method ="post" action ="ticketDetailController.php">
            <div class="form-group">
                
                <?php
                if ($ticket->getCompleted()=="NO"){
                ?>
                
                <h4>Please select reason for closing your ticket: </h4>
                <?php
                
                } else {
                
                
                
                ?>
              
                <h4>Are you sure you want to re-open this closed ticket?</h4>
                
                <?php
                
                }
                
                ?>
                
                <br/>
                
                <?php
                    if ($ticket->getCompleted()=="NO"){
                ?>
                <select class="form-control" id="ticketCloseReasons" name="reason">
                    <?php
                    foreach ($reasons as $reason) {

                        echo "<option>";
                        echo $reason;
                        echo "</option>";
                    }
                    }
                    ?>

                </select>
                <input type="hidden" name ="tickno2" value =<?php echo "\"" . $ticket->getId() . "\""; ?>>
                <br/>
                <div id="closeDispositionControls">

                    <input type ="submit" class ="btn btn-warning" name = "submitCloseTicket" value = <?php if ($ticket->getCompleted()=="NO"){ echo "Close Ticket"; } else { echo "Re-Open Ticket";} ?>  >
                    <button type="button" id="cancelCloseTicket" class="btn btn-secondary"> Cancel </button>
                </div>

            </div>
        </form>
    </div>
</div>




<script>



    function showCloseTicket() {

        var ticketCloseContainer = document.getElementById('ticket-close-container');

        ticketCloseContainer.style.display = "block";


    }


    var closeTicketButton = document.getElementById('closeTicketButton');
    closeTicketButton.onclick = showCloseTicket;



    function cancelShowCloseTicket() {

        var ticketCloseContainer2 = document.getElementById('ticket-close-container');

        ticketCloseContainer2.style.display = "none";


    }

    var cancelCloseTicket = document.getElementById('cancelCloseTicket');
    cancelCloseTicket.onclick = cancelShowCloseTicket;


</script>

