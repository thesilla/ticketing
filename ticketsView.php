<html>
    <head>
        <link rel="stylesheet" type="text/css" href="superhero.css">
        <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
    </head>


    <body>
        <div id="tickets-container">
            <!-- Table headers -->
            <!--<table id="displayTickets">-->
            <table class="table table-hover">
                <tr><thead>
                <th onclick='sortTable(0)'>Ticket ID#</th>
                <th onclick='sortTable(2)'>Requested By</th>
                <th onclick='sortTable(3)'>Submitted By</th>
                <th onclick='sortTable(4)'>Date Submitted</th>
                <th onclick='sortTable(5)'>Category</th>
                <th onclick='sortTable(6)'>Subject</th>
                <th onclick='sortTable(7)'>Details</th>
                <th onclick='sortTable(8)'>Priority</th>
                <th onclick='sortTable(9)'>Assigned To</th>
                <th onclick='sortTable(10)'>Order ID</th>
                <th onclick='sortTable(11)'>Status</th>
                <th onclick='sortTable(12)'>Completed?</th>
                <th onclick='sortTable(13)'>Date Completed</th>
                </thead>
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
                    echo "<td>" . $ticket->getBody() . "</td>";
                    echo "<td>" . $ticket->getPriority() . "</td>";
                    echo "<td>" . $ticket->getAssignedTo() . "</td>";
                    echo "<td>" . $ticket->getOrderID() . "</td>";
                    echo "<td>" . $ticket->getStatus() . "</td>";
                    echo "<td>" . $ticket->getCompleted() . "</td>";
                    echo "<td>" . $ticket->getDateResolved() . "</td>";
                    $id = $ticket->getid();

                    echo "<td> <form action = 'ticketDetailController.php' method = 'get'><input name = 'ticketno' id = 'editTicket' type = 'hidden' value = $id> <input class='btn btn-success' type = 'submit' name = 'submit1' value = 'Details'></form> </td>";
                    echo "<td> <form action = 'ticketDetailController.php' method = 'get'><input name = 'ticketno' id = 'editTicket' type = 'hidden' value = $id> <input class='btn btn-danger' type = 'submit' name = 'delete-ticket' value = 'Delete'></form> </td>";
                    echo "</tr>";
                }
                ?>

            </table>


        </div>



