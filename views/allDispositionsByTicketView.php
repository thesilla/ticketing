
<br/>
<hr class="my-4">

<h1 class = "table" style="text-align: center; font-weight: 566pt;"> Dispositions</h1>
<hr class="my-4">

<?php
if (count($allDispositions) != 0) {
    ?>
    <p style = "color: red;">*Click field headers to sort</p>
    <div> 
        <!-- Table headers -->
        <table class="table" id="displayTickets">
            <tr class="table-primary">


                <th onclick='sortTable(0)' style="text-align: center;">Submitted By:</th>
                <th onclick='sortTable(1)' style="text-align: center;">Date Submitted</th>
                <th onclick='sortTable(2)' style="text-align: center;">Details</th>
                <th></th>


            </tr>

            <?php
// grab all dispos from database

            foreach ($allDispositions as $disposition) {

                echo "<tr class='table-active'>";

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
} else {
    ?>

    <br/>
    <h5 style="text-align: center; font-style: italic;"> There are no dispositions to display at this time. Click "Add Disposition" in the ticket control panel above to post an update about this ticket. </h5>
    <br/>

    <?php
}
?>

<hr class="my-4">

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


    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("displayTickets");
        switching = true;
        // Set the sorting direction to ascending:
        dir = "asc";
        /* Make a loop that will continue until
         no switching has been done: */
        while (switching) {
            // Start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /* Loop through all table rows (except the
             first, which contains table headers): */
            for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching:
                shouldSwitch = false;
                /* Get the two elements you want to compare,
                 one from current row and one from the next: */
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                /* Check if the two rows should switch place,
                 based on the direction, asc or desc: */
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                /* If a switch has been marked, make the switch
                 and mark that a switch has been done: */
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                // Each time a switch is done, increase this count by 1:
                switchcount++;
            } else {
                /* If no switching has been done AND the direction is "asc",
                 set the direction to "desc" and run the while loop again. */
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }




</script>