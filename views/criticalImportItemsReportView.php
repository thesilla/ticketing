
<?php




?>

<div class="jumbotron">
    <h2> Critical Import Items Report </h2>
    <hr class="my-4">
    <button class="btn btn-secondary"><a href = "../scripts/criticalImportItemsExcel.php">Export to Excel</a></button>
    <hr class="my-4">



    <table class="table table-hover" id="displayTickets">
        <tr>

            <th onclick="sortTable(0)">Item ID#</th>
            <th onclick="sortTable(1)">Item Description</th>
            <th onclick="sortTable(2)">On Hand</th>
            <th onclick="sortTable(3)">Allocated</th>
            <th onclick="sortTable(4)">Total Available</th>
            <th onclick="sortTable(5)">UoM</th>


            <th onclick="sortTable(6)">Supplier</th>
            <th onclick="sortTable(7)">Supplier ID</th>



        </tr>

        <?php

 
        while ($row = $results->fetch(PDO::FETCH_ASSOC)) {

           


            echo "<tr>";
            echo "<td>" . $row['item_id'] . "</td>";
            echo "<td>" . $row['item_desc'] . "</td>";
            echo "<td>" . $row['qty_on_hand'] . "</td>";
            echo "<td>" . $row['qty_allocated'] . "</td>";
            echo "<td style='color: red;'>" . $row['totalAvail'] . "</td>";
            echo "<td>" . $row['base_unit'] . "</td>";
            echo "<td>" . $row['supplier_name'] . "</td>";
            echo "<td>" . $row['supplier_id'] . "</td>";



            echo "</tr>";
        }
        

        
        ?>




    </table>


</div>




