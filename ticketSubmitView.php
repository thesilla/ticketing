
<div id="submitTicket">
    <form action ="ticketsController.php" method ="post" id="submitTicketForm">
        <div>Subject:</div>
        <div><input type ="text" name ="subject" placeholder ="please enter subject"></div>
        <div>Details:</div>
        <textarea rows="10" name ="details" id="submitTicketDetails" form="submitTicketForm"></textarea>
        <div>Requested By:</div>
        <div><input type ="text" name ="requestedby" placeholder ="Who originally requested this inquiry?"></div>
        <div>Order ID: </div>
        <div><input type ="text" name ="orderid" placeholder ="(If applicable)"></div>

        <!-- IN THE FUTURE, this should be picked from an editable dynamic list of all possible categories -->
        <div>Category:</div>
        <div><input type ="text" name ="category" placeholder ="What category does this issue fall under?"></div>
        <div>Priority:</div>
        <div>
            <input type="radio" name="priority" value="3"> 3 (Lowest)<br>
            <input type="radio" name="priority" value="2"> 2 <br>
            <input type="radio" name="priority" value="1"> 1 (Highest)<br> 
        </div>

        <!-- Assigned To: -->
        <div>
            <select name="assignedto">

                <?php
                // pull all users and display
                // $allusers is in ticketsController.php

                foreach ($allusers as $user) {

                    echo '<option value=' . $user->getFirstName() . '>' . $user->getFirstName() . '</option>';
                }
                ?>
            </select>
        </div>
        
        <!-- submit button -->
        <div><input type ="submit" value ="Submit Ticket" name ="submitticketbutton"></div>
    </form>
</div>

                <?php
                /*
                  private $id; - auto
                  private $subject;- X
                  private $body; - X
                  private $userID; - auto
                  private $requestedBy; -X
                  private $dateSubmitted; -auto
                  private $orderID; -x
                  private $category; -x
                  private $priority; -x
                  private $status; - auto "WAITING ON AGENT" - but can be updated later on ticket detail side
                  private $assignedTo; - drop down menu containing all users
                  private $completed; auto -N
                  private $dateResolved; auto - NULL


                 */
                ?>