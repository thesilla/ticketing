<!-- Hidden HTML for editing ticket - displayed through JS -->
<div id = "editTicket"  class="jumbotron" style = <?php
// check if any errors exist
// if so, show form on reload with errors displayed
$issue = false;
foreach ($ticketEditErrors as $errors) {

    if ($errors[1] == 1) {

        $issue = true;
        break;
    }
}

if ($issue) {


    echo "\"" . "display: block;" . "\"";
} else {

    echo "\"" . "display: hidden;" . "\"";
}
?>

     >


    <form class="form-horizontal" id = "editTicketForm" action = "ticketDetailController.php" method = "post">
        <h1 style ="text-align: center;">Ticket #: <?php echo $ticket->getId(); ?> - Modify</h1>

        <hr class="my-4">

        <div style ="text-align: center;">Submitted By: <?php echo $ticket->getUserID(); ?></div>
        <div style ="text-align: center;">Date Submitted: <?php echo $ticket->getDateSubmitted(); ?></div>

        <hr class="my-4">

        <div class="form-group">
            <label for="subject">Subject</label>
            <input class="form-control"  type ="text" name ="subject" value =<?php echo "\"" . $ticket->getSubject() . "\""; ?>>
            <?php
            if ($ticketEditErrors['subject'][1] == 1) {
                echo $ticketEditErrors['subject'][0];
            }
            ?>
        </div>



        <div class="form-group">
            <label for="status">Status</label>
            <select class="custom-select" name="status">

                <?php
//TODO - add more statuses
                $statuses = array("Awaiting Agent Reply", "Awaiting Vendor Reply", "Awaiting Sales Reply", "Awaiting Warehouse Reply", "IT Case Pending");

                foreach ($statuses as $status) {

                    echo '<option value=' . $status . '>' . $status . '</option>';
                }
                ?>
            </select>
            <?php
            if ($ticketEditErrors['status'][1] == 1) {
                echo $ticketEditErrors['status'][0];
            }
            ?>
        </div>



        <div class="form-group">
            <label for="details">Ticket Details</label>
            <textarea class="form-control" rows="5" name ="details" id="submitTicketDetails" form="editTicketForm"><?php echo $ticket->getBody(); ?></textarea>
        </div>




        <!-- requestedby not in original edit form -->

        <div class="form-group">
            <label for="requestedby">Requested By:</label>

            <select class="custom-select" name="requestedby">

                <?php
// pull all employees and display
// $allusers is in ticketsController.php


                foreach ($employees as $employee) {

                    echo '<option value=' . $employee->getEmail() . '>' . $employee->getFirstName() . " " . $employee->getLastName() . " (" . $employee->getEmail() . ")" . '</option>';
                }
                ?>
            </select>


        </div>

        <div>Order ID: </div>
        <div><input class="form-control" type ="text" name ="orderid" value =<?php echo "\"" . $ticket->getOrderID() . "\""; ?>></div>

        <div>Vendor: </div>
        <div><input class="form-control" type ="text" name ="vendor" value =<?php echo "\"" . $ticket->getVendor() . "\""; ?>></div>

        <!-- IN THE FUTURE, this should be picked from an editable dynamic list of all possible categories -->
        <div>Category:</div>
        <div class="form-group">
            <select class="custom-select" name="category" form="editTicketForm">

                <?php
                $categories = [
                    "Need ETA",
                    "Pricing Issue",
                    "Build Items",
                    "Expedite Needed",
                    "Labels Needed",
                    "Shipping Issue",
                    "Product Broken",
                    "Research Required",
                    "Other Misc",
                ];
                foreach ($categories as $category) {

                    echo '<option value=' . $category . '>' . $category . '</option>';
                }
                ?>
            </select>

        </div>



        <fieldset class="form-group">
            <div>Priority:</div>
            <div class="form-check">
                <label class="form-check-label" for="priority">
                    <input name="priority" class="form-check-input" id="optionsRadios1" type="radio" checked="" value="3">3 (Lowest)
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="priority">
                    <input name="priority" class="form-check-input" id="optionsRadios2" type="radio" value="2">2
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="priority">
                    <input name="priority" class="form-check-input" id="optionsRadios3" type="radio" value="1">1 (Highest)
                </label>
            </div>
        </fieldset> 


        <!-- Assigned To: -->
        <div class="form-group">
            <div>Assigned To:</div>
            <select class="custom-select" name="assignedto" form="editTicketForm">

                <?php
// pull all users and display
// $allusers is in ticketsController.php

                foreach ($users as $user) {

                    $selected;
                    // iterate through users
                    //  -- if ticket assignedTo property is equal to a user name, make that User name default select value
                    if ($ticket->getAssignedTo() === $user->getFirstName()) {
                        $selected = $ticket->getAssignedTo();
                        echo '<option selected=' . $selected . 'value=' . $user->getFirstName() . '>' . $user->getFirstName() . '</option>';
                    } else {

                        echo '<option value=' . $user->getFirstName() . '>' . $user->getFirstName() . '</option>';
                    }
                }
                ?>
            </select>
<?php
if ($ticketEditErrors['assignedto'][1] == 1) {
    echo $ticketEditErrors['assignedto'][0];
}
?>
        </div>

        <br/>

        <div class="closeEditTicketControls">
            <input name = 'ticketno' id = 'editTicket' type = 'hidden' value = <?php echo "\"" . $ticket->getId() . "\""; ?>> 
            <input class="btn btn-success" id ="editTicketSubmit" name ="submit" type ="submit" value ="Update Ticket">
            <button type = "button" class="btn btn-default" id="closeEditTicket"> Cancel </button>
        </div>
        <!-- submit button 
        <input  id  ="submitTicketButton" class="btn btn-primary btn-lg btn-block" type ="submit" value ="Submit Ticket" name ="submitticketbutton">
        <br/>
        <div id ="submitTicketCancel"><button class="btn btn-secondary" id="closeSubmitTicketButton"> CANCEL </button></div>
        -->
    </form>


</div>


<script>

    function editTicket() {

        var ticketContainer1 = document.getElementById('editTicket');

        ticketContainer1.style.display = "block";


    }

    function closeEditTicket() {

        var ticketContainer2 = document.getElementById('editTicket');

        ticketContainer2.style.display = "none";


    }


    var closeEditTicketButton = document.getElementById('closeEditTicket');
    closeEditTicketButton.onclick = closeEditTicket;

    var editTicketButton = document.getElementById('editTicketButton');
    editTicketButton.onclick = editTicket;



</script>