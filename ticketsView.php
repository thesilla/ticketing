
<div> 
    <!-- Table headers -->
    <table id="displayTickets">
        <tr>
            <th onclick='sortTable(0)'>Ticket ID#</th>
            <th onclick='sortTable(1)'>Submitted By</th>
            <th onclick='sortTable(2)'>Date Submitted</th>
            <th onclick='sortTable(3)'>Subject</th>
            <th onclick='sortTable(4)'>Category</th>
            <th onclick='sortTable(5)'>Priority</th>
            <th onclick='sortTable(6)'>Details</th>
            <th onclick='sortTable(7)'>Order ID</th>
            <th onclick='sortTable(8)'>Status</th>
            <th></th>
        </tr>

        <?php
// grab all tickets from database
        
        foreach ($allTickets as $ticket) {

            echo "<tr>";

            // display data
            echo "<td>" . $ticket->getid() . "</td>";
            echo "<td>" . $ticket->getUserID() . "</td>";
            echo "<td>" . $ticket->getDateSubmitted() . "</td>";
            echo "<td>" . $ticket->getSubject() . "</td>";
            echo "<td>" . $ticket->getCategory() . "</td>";
            echo "<td>" . $ticket->getPriority() . "</td>";
            echo "<td>" . $ticket->getBody() . "</td>";
            echo "<td>" . $ticket->getOrderID() . "</td>";
            echo "<td>" . $ticket->getStatus() . "</td>";
            $id = $ticket->getid();
            echo "<td> <form action = 'ticketDetailView.php' method = 'post'><input name = 'ticketno' id = 'editTicket' type = 'hidden' value = $id> <input type = 'submit' name = 'submit1' value = 'Details'></form> </td>";

            echo "</tr>";
        }
        ?>

    </table>
    
    <script src="functions.js"></script>
</div>

