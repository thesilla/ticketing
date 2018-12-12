
<!--
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="superhero.css">
<!-- <link rel="stylesheet" type="text/css" href="styles.css"> 
</head>


<body>
-->





<br/>
<div class="jumbotron">
    <h1> Purchasing Tickets </h1>
    <hr class="my-4">
    <div><button id="showTicketSubmit" class="btn btn-primary btn-lg" >Submit New Ticket</button></div>
    <hr class="my-4">
    <br/>

    <div id="tickets-container">
        <button id="openTicketsOnly" class="btn btn-secondary" >Open Tickets Only</button>
        <button id="closedTicketsOnly" class="btn btn-secondary" >Closed Tickets Only</button>
        <!-- Table headers -->
        <!--<table id="displayTickets">-->
        <table class="table table-hover" id="displayTickets">
            <tr><thead>
            <th onclick='sortTable(0)'>Ticket ID#</th>
            <th onclick='sortTable(1)'>Requested By</th>
            <th onclick='sortTable(2)'>Submitted By</th>
            <th onclick='sortTable(3)'>Date Submitted</th>
            <th onclick='sortTable(4)'>Category</th>
            <th onclick='sortTable(5)'>Subject</th>
             <!-- <th onclick='sortTable(7)'>Details</th> -->
            
            <th onclick='sortTable(6)'>Priority</th>
            <th onclick='sortTable(7)'>Assigned To</th>
            <th onclick='sortTable(8)'>Order ID</th>
            <th onclick='sortTable(9)'>Vendor</th>
            <th onclick='sortTable(10)'>Status</th>
            <th onclick='sortTable(11)'>Completed?</th>
            <th onclick='sortTable(12)'>Date Completed</th>
            <th></th>
            <th></th>
            </thead>

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
                echo "<td>" . $ticket->getCompleted() . "</td>";
                echo "<td>" . $ticket->getDateResolved() . "</td>";
                $id = $ticket->getid();

                echo "<td> <form action = 'ticketDetailController.php' method = 'get'><input name = 'ticketno' id = 'editTicket' type = 'hidden' value = $id> <input class='btn btn-success' type = 'submit' name = 'submit1' value = 'Details'></form> </td>";
                //echo "<td> <form action = 'ticketsController.php' method = 'post'><input name = 'ticketno' id = 'editTicket' type = 'hidden' value = $id> <input class='btn btn-danger' type = 'submit' name = 'delete-ticket' value = 'Delete'></form> </td>";
                echo "</tr>";
            }
            ?>

        </table>


    </div>

</div> 

<script>
    

 //var closestTr = document.querySelector("#openTicketsOnly").closest("tr");   
//FIXME - JS TICKET FILTER DOESNT WORK 
 /*
 function hideCompleted(){
     
    var allCompleted = document.getElementsByTagName("TD");
 
    var i  = 11;
    while (i<allCompleted.length){
        
        if(allCompleted[i].innerHTML == "YES"){
            
            var closestTr = allCompleted[i].closest("tr");
            closestTr.style.display = "none"; 
            
        }
        
        i = i + 11;
    }   
}    
    var filterClosedTixButton =  document.getElementById("openTicketsOnly");
    filterClosedTixButton.onclick = hideCompleted();
    
    
    
    function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("displayTickets");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
    */
    
    
    </script>