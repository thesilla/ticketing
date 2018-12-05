
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
            $currentController = basename($_SERVER['PHP_SELF']);
            // Stores Disposition ID# for persistence 
            $id = $disposition->getDispoID();
            echo "<td>";
            // hidden field to store dispo number
            echo "<input name = 'dispono' id = 'currentRow' type = 'hidden' value = $id>";
            echo "<button class='editButton btn btn-default'> Edit </button>";

//echo "<td><form action = $currentController method = 'post'><input name = 'dispono' id = 'editTicket' type = 'hidden' value = $id> <input id = 'editDispoButton' class='btn btn-outline-primary' type = 'button' name = 'editDispo' value = 'Edit'></form></td>";;
            echo "</td>";
            echo "</tr>";
        }
        ?>

    </table>


</div>





<?php
// create hidden modals for editing dispositions
foreach ($allDispositions as $disposition) {


    //$currentController =  basename($_SERVER['PHP_SELF']);
    $currentController = 'dispositionController.php';
    echo "<div class='hiddenDispoEdit alert alert-dismissible alert-secondary'>";

    // display data
    $dispoID = $disposition->getDispoID();
    echo "<h3> Edit Disposition #" . $dispoID . "</h3>";
    echo "<form action=$currentController method='post'>";
    echo "<input name = 'dispono' type='hidden' value = $dispoID class='hiddenDispoInput'>";
    echo "<textarea name='newDispoBody' rows='7'>" . $disposition->getBody() . "</textarea>";
    echo "<div id='editDispositionModalControls'>";
    echo "<input class = 'btn btn-primary' name = 'editDispo' type = 'submit' value='Submit Changes'>";
    echo "<input class = 'btn btn-danger' name = 'deleteDispo' type = 'submit' value='Delete Disposition'>";
    echo '<button type = "button" class="closeEditDispositionButton btn btn-secondary" id="closeEditDispositionButton"> Cancel </button>'; 
    echo "</div>";
    echo "</form>";
    echo "</div>";
}
?>




<script>


    //attaches all dispo edit buttons to dispo edit submission boxes
    // also attaches close functions to cancel buttons

    function addFunction(button, element) {

        button.onclick = function () {

            element.style.display = "block";

        }

    }
    
        function closeFunction(button, element) {

        button.onclick = function () {

            element.style.display = "none";

        }

    }

    var allHiddenDispoInputs = document.getElementsByClassName('hiddenDispoInput');
    var allEditButtons = document.getElementsByClassName('editButton');
    var allEditContainers = document.getElementsByClassName('hiddenDispoEdit');
    var allCloseButtons = document.getElementsByClassName('closeEditDispositionButton');


    var i = 0;
    for (i; i < allEditButtons.length; i++) {


        var button = allEditButtons[i];
        var element = allEditContainers[i];
        addFunction(button, element);

    }
    
    var j = 0;
    for (j; j < allEditButtons.length; j++) {


        var button = allCloseButtons[j];
        var element = allEditContainers[j];
        closeFunction(button, element);

    }
    

    
    
    
    

</script>