

<div id="submitTicket" class="jumbotron"style = <?php
// check if any errors exist
// if so, show form on reload with errors displayed
$issue = false;
foreach ($ticketSubmitErrors as $errors) {

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

    <form class="form-horizontal" action ="ticketsController.php" method ="post" id="submitTicketForm" class = "form">
        <h1 style ="text-align: center;">Create New Ticket</h1>

        <div class="form-group">
            <label for="subject">Subject:</label>
            <input class="form-control"  type ="text" name ="subject" placeholder ="please enter subject">
<?php if ($ticketSubmitErrors['subject'][1] == 1) {
    echo $ticketSubmitErrors['subject'][0];
} ?>
        </div>
        <div class="form-group">
            <label for="details">Ticket Details - Please Explain the Issue:</label>
            <textarea class="form-control"rows="3" name ="details" id="submitTicketDetails" form="submitTicketForm"></textarea>
        </div>






        <div class="form-group">
            <label for="requestedby">Requested By:</label>

            <select class="custom-select" name="requestedby">

<?php
// pull all employees and display
// $allusers is in ticketsController.php
//$allEmployees = Employee::getEmployees();

foreach ($employees as $employee) {

    echo '<option value=' . $employee->getEmail() . '>' . $employee->getFirstName() . " " . $employee->getLastName() . " (" . $employee->getEmail() . ")" . '</option>';
}
?>
            </select>
                <?php if ($ticketSubmitErrors['requestedby'][1] == 1) {
                    echo $ticketSubmitErrors['requestedby'][0];
                } ?>


        </div>






        <div>Order ID: </div>
        <div><input class="form-control" type ="text" name ="orderid" placeholder ="(If applicable)"></div>

        <div>Vendor: </div>
        <div><input class="form-control" type ="text" name ="vendor" placeholder ="(If applicable)"></div>

        <!-- IN THE FUTURE, this should be picked from an editable dynamic list of all possible categories -->
        <div>Category:</div>

        <select class="custom-select" name="category">

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
    "Product Return",
    "Other Misc",
];
foreach ($categories as $category) {

    echo '<option value=' . $category . '>' . $category . '</option>';
}
?>
        </select>
            <?php if ($ticketSubmitErrors['category'][1] == 1) {
                echo $ticketSubmitErrors['category'][0];
            } ?>





        <fieldset class="form-group">
            <div>Priority:</div>
            <div class="form-check">
                <label class="form-check-label" for="priority">
                    <input name="priority" class="form-check-input" id="optionsRadios1" type="radio" checked="" value="3">
                    3 (Lowest) 
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="priority">
                    <input name="priority" class="form-check-input" id="optionsRadios2" type="radio" value="2">
                    2
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="priority">
                    <input name="priority" class="form-check-input" id="optionsRadios3" type="radio" value="1">
                    1 (Highest)
                </label>
            </div>
        </fieldset>


        <!-- Assigned To: -->
        <div class="form-group">
            <div>Assigned To:</div>
            <select class="custom-select" name="assignedto">

<?php
// pull all users and display
// $allusers is in ticketsController.php

foreach ($allusers as $user) {

    echo '<option value=' . $user->getFirstName() . '>' . $user->getFirstName() . '</option>';
}
?>
            </select>
                <?php if ($ticketSubmitErrors['assignedto'][1] == 1) {
                    echo $ticketSubmitErrors['assignedto'][0];
                } ?>

        </div>

        <br/>
        <!-- submit button -->
        <input  id  ="submitTicketButton" class="btn btn-primary btn-lg btn-block" type ="submit" value ="Submit Ticket" name ="submitticketbutton">
        <br/>
        <div id ="submitTicketCancel"><button class="btn btn-secondary" id="closeSubmitTicketButton"> CANCEL </button></div>

    </form>
</div>
