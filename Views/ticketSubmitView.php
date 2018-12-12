

<div id="submitTicket" class="jumbotron">

    <form action ="ticketsController.php" method ="post" id="submitTicketForm" class = "form">
        <h1>Create New Ticket</h1>
        <hr class="my-4">
        <div class="form-group">
            <label for="subject">Subject:</label>
            <input class="form-control"  type ="text" name ="subject" placeholder ="please enter subject">
        </div>
        <div class="form-group">
            <label for="details">Ticket Details - Please Explain the Issue:</label>
            <textarea class="form-control"rows="5" name ="details" id="submitTicketDetails" form="submitTicketForm"></textarea>
        </div>






        <div class="form-group">
            <label for="requestedby">Requested By:</label>

            <select class="custom-select" name="requestedby">

                <?php
                // pull all employees and display
                // $allusers is in ticketsController.php

                //$allEmployees = Employee::getEmployees();

                foreach ($employees as $employee) {

                    echo '<option value=' . $employee->getEmail() . '>' . $employee->getFirstName() . " " .   $employee->getLastName() . " (" .  $employee->getEmail() . ")" . '</option>';
                }
                ?>
            </select>


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
                "Other Misc",
            ];
            foreach ($categories as $category) {

                echo '<option value=' . $category . '>' . $category . '</option>';
            }
            ?>
        </select>





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
        </div>

        <br/>
        <!-- submit button -->
        <input  id  ="submitTicketButton" class="btn btn-primary btn-lg btn-block" type ="submit" value ="Submit Ticket" name ="submitticketbutton">
        <br/>
        <div id ="submitTicketCancel"><button class="btn btn-secondary" id="closeSubmitTicketButton"> CANCEL </button></div>

    </form>
</div>
