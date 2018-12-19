


<div class="jumbotron">
    <h1> Purchasing Tickets </h1>
    <hr class="my-4">
    <div><button id="showTicketSubmit" class="btn btn-primary btn-lg" >Submit New Ticket</button></div>
    <hr class="my-4">
    <p style = "color: red;">*Click field headers to sort</p>

    <div id="tickets-container">

        <button id="openTicketsOnly" class="btn btn-secondary" >Open Tickets</button>

        <button id="showAllTickets" class="btn btn-secondary" >Show All Tickets</button>

        <button id="closedTicketsOnly" class="btn btn-secondary" >Closed Tickets</button>


        <table class="table table-hover" id="displayTickets">
            <tr>

                <th onclick="sortTable(0)">Ticket ID#</th>
                <th onclick="sortTable(1)">Requested By</th>
                <th onclick="sortTable(2)">Submitted By</th>
                <th onclick="sortTable(3)">Date Submitted</th>
                <th onclick="sortTable(4)">Category</th>
                <th onclick="sortTable(5)">Subject</th>


                <th onclick="sortTable(6)">Priority</th>
                <th onclick="sortTable(7)">Assigned To</th>
                <th onclick="sortTable(8)">Order ID</th>
                <th onclick="sortTable(9)">Vendor</th>
                <th onclick="sortTable(10)">Status</th>
                <th onclick="sortTable(11)">Completed?</th>
                <th onclick="sortTable(12)">Date Completed</th>
                <th></th>
                <th></th>


            </tr>

            <?php
// grab all tickets from database

            foreach ($allTickets as $ticket) {

                if ($ticket->getPriority() == 1) {

                    echo "<tr class='table-danger'>";
                } else {

                    if ($ticket->getPriority() == 2) {


                        echo "<tr class='table-warning'>";
                    } else {


                        echo "<tr class='table-primary'>";
                    }
                }




                // display data
                echo "<td>" . $ticket->getid() . "</td>";
                echo "<td>" . $ticket->getRequestedBy() . "</td>";
                echo "<td>" . $ticket->getUserID() . "</td>";
                echo "<td>" . $ticket->getDateSubmitted() . "</td>";
                echo "<td>" . $ticket->getCategory() . "</td>";
                echo "<td>" . $ticket->getSubject() . "</td>";

                /* DEFAULT: Hide ticket body from alltickets view
                  // Body Conditional
                  //      if string is less than # of characters, show entire string
                  //      else trim string to length # of characters, add "..." to it and print
                  if (strlen($ticket->getBody()) < 100) {

                  echo "<td>" . $ticket->getBody() . "</td>";
                  } else {

                  echo "<td>" . substr($ticket->getBody(), 0, 100) . "...</td>";
                  }

                 */






                echo "<td>" . $ticket->getPriority() . "</td>";
                echo "<td>" . $ticket->getAssignedTo() . "</td>";
                echo "<td>" . $ticket->getOrderID() . "</td>";
                echo "<td>" . $ticket->getVendor() . "</td>";
                echo "<td>" . $ticket->getStatus() . "</td>";
                echo "<td class ='completedtd'>" . $ticket->getCompleted() . "</td>";
                echo "<td>" . $ticket->getDateResolved() . "</td>";
                $id = $ticket->getid();

                echo "<td> <form action = 'ticketDetailController.php' method = 'get'><input name = 'ticketno' id = 'editTicket' type = 'hidden' value = $id> <input class='btn btn-success' type = 'submit' name = 'submit1' value = 'Details'></form> </td>";
                //echo "<td> <form action = 'ticketsController.php' method = 'post'><input name = 'ticketno' id = 'editTicket' type = 'hidden' value = $id> <input class='btn btn-danger' type = 'submit' name = 'delete-ticket' value = 'Delete'></form> </td>";
                echo "</tr>";
            }
            ?>

        </table>


    </div>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>

</div> 

