
        <div> 
            <!-- Table headers -->
            <table class="table" id="displayTickets">
                <tr>
                <thead>
                    
                    <th onclick='sortTable(0)'>Submitted By:</th>
                    <th onclick='sortTable(1)'>Date Submitted</th>
                    <th onclick='sortTable(2)'>Details</th>
                    <th></th>
                </thead>
                    
                </tr>

                <?php
// grab all dispos from database

                foreach ($allDispositions as $disposition) {

                    echo "<tr>";

                    // display data
                   
                    echo "<td>" . $disposition->getUserID() . "</td>";
                    echo "<td>" . $disposition->getDateSubmitted() . "</td>";
                    echo "<td>" . $disposition->getBody() . "</td>";
                  
                    // Should POST back to current controller, whatever that is
                    $currentController =  basename($_SERVER['PHP_SELF']);
                    // Stores Disposition ID# for persistence 
                    $id = $disposition->getDispoID();
                    echo "<td> <form action = $currentController method = 'post'><input name = 'ticketno' id = 'editTicket' type = 'hidden' value = $id> <input type = 'submit' name = 'submit1' value = 'Edit'></form>  <form action = $currentController method = 'post'><input name = 'ticketno' id = 'editTicket' type = 'hidden' value = $id> <input type = 'submit' name = 'submit1' value = 'Delete'></form></td>";;

                    echo "</tr>";
                }
                ?>

            </table>

        
        </div>

