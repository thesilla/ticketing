
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
                    echo "<td><form action = $currentController method = 'post'><input name = 'dispono' id = 'editTicket' type = 'hidden' value = $id> <input id = 'editDispoButton' class='btn btn-outline-primary' type = 'button' name = 'editDispo' value = 'Edit'></form></td>";;

                    echo "</tr>";
                }
                ?>

            </table>

        
        </div>


<div  id="edit-disposition-container" class="alert alert-dismissible alert-secondary" >
    
    
    EDIT DISPO
    
</div>


<script>
    
    
    //works on first instance of button only - FIXME
    function showEditDisposition(){
        
        var editDispositionContainer = document.getElementById('edit-disposition-container');
        editDispositionContainer.style.display = "block";
        
    }
    
    var editDispoButton = document.getElementById('editDispoButton');
    editDispoButton.onclick = showEditDisposition;
    
    
</script>