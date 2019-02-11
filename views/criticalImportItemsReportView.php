<?php




?>


<div class="jumbotron">
    <h1> Critical Import Items Report </h1>
    <hr class="my-4">



        <table class="table table-hover" id="displayTickets">
            <tr>

                <th onclick="sortTable(0)">Item ID#</th>
                <th onclick="sortTable(1)">Item Description</th>
                <th onclick="sortTable(2)">On Hand</th>
                <th onclick="sortTable(3)">Allocated</th>
                <th onclick="sortTable(4)">Total Available</th>
                <th onclick="sortTable(5)">UOM</th>


                <th onclick="sortTable(6)">Supplier</th>
                <th onclick="sortTable(7)">Supplier ID</th>



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
                echo "<td>" . $ticket->getRequestedby() . "</td>";
                echo "<td>" . $ticket->getUserID() . "</td>";
                echo "<td>" . $ticket->getDateSubmitted() . "</td>";
                echo "<td>" . $ticket->getCategory() . "</td>";
                echo "<td><div class='subdiv'>" . $ticket->getSubject() . "</div></td>";

     





                echo "<td>" . $ticket->getPriority() . "</td>";
                
                
                if($ticket->getAssignedTo()=='Max'){
                    
                    echo "<td><div class='assignedToUser1'>" . $ticket->getAssignedTo() . "</td>";
                    
                } else if ($ticket->getAssignedTo()=='Bryan'){
                    
                    echo "<td><div class='assignedToUser2'>" . $ticket->getAssignedTo() . "</td>";
                    
                } else {
                    
                    echo "<td><div class='assignedToUser3'>" . $ticket->getAssignedTo() . "</td>";
                    
                }
                
         
                
                
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

