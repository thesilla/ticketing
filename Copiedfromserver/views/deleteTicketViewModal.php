



<div  id="ticket-delete-container" class="alert alert-dismissible alert-secondary" >

    <div>
        <form method ="post" action ="ticketDetailController.php">
            <div class="form-group">
                <h4>Are you sure you want to permanently delete this ticket? </h4>
                <br/>

                <input type="hidden" name ="tickno3" value =<?php echo "\"" . $ticket->getId() . "\""; ?>>
                <br/>
                <div id="closeDispositionControls">
                    <input type ="submit" value ="Yes, Permanently Delete" class ="btn btn-danger" name ="submitDeleteTicket">
                    <button type="button" id="cancelDeleteTicketButton" class="btn btn-secondary"> Cancel </button>
                </div>

            </div>
        </form>
    </div>
</div>






<script>





    function showDeleteTicket() {

        var ticketCloseContainer = document.getElementById('ticket-delete-container');

        ticketCloseContainer.style.display = "block";


    }


    var deleteTicketDisplayButton = document.getElementById('deleteTicketDisplayButton');
    deleteTicketDisplayButton.onclick = showDeleteTicket;



    function cancelDeleteTicket() {

        var ticketCloseContainer2 = document.getElementById('ticket-delete-container');

        ticketCloseContainer2.style.display = "none";


    }

    var cancelDeleteTicketButton = document.getElementById('cancelDeleteTicketButton');
    cancelDeleteTicketButton.onclick = cancelDeleteTicket;




</script>
