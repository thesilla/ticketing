function displaySubmitTicket() {

    var newTicketContainer1 = document.getElementById('submitTicket');

    newTicketContainer1.style.display = "block";


}

function closeSubmitTicket() {

    var newTicketContainer2 = document.getElementById('submitTicket');

    newTicketContainer2.style.display = "none";


}




var showTicketSubmitButton = document.getElementById('showTicketSubmit');
showTicketSubmitButton.onclick = displaySubmitTicket;

var closeTicketSubmitButton = document.getElementById('closeSubmitTicketButton');
closeTicketSubmitButton.onclick = closeSubmitTicket;



//var closestTr = document.querySelector("#openTicketsOnly").closest("tr");   
//FIXME - JS TICKET FILTER DOESNT WORK 




function unhideAll() {

    var c = document.getElementById("displayTickets").rows;

    var i;
    for (i = 0; i < c.length; i++) {

        c[i].style.display = "";



    }




}

var showAllTickets = document.getElementById('showAllTickets');
showAllTickets.onclick = unhideAll;

// TODO RENAME THIS
function hideCompleted() {

    unhideAll();
    var allCompleted = document.getElementsByClassName("completedtd");
    var i = 0;


    while (i < allCompleted.length) {



        if (allCompleted[i].innerHTML.indexOf("YES") !== -1) {


            allCompleted[i].closest("tr").style.display = "none";

        }
        i = i + 1;
    }
}

var button1 = document.getElementById("openTicketsOnly");
button1.onclick = hideCompleted;


function hideClosed() {
    unhideAll();
    var allCompleted = document.getElementsByClassName("completedtd");
    var i = 0;


    while (i < allCompleted.length) {



        if (allCompleted[i].innerHTML.indexOf("NO") !== -1) {


            allCompleted[i].closest("tr").style.display = "none";

        }
        i = i + 1;
    }
}


var button2 = document.getElementById("closedTicketsOnly");
button2.onclick = hideClosed;








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
            x = rows[i].getElementsByTagName("td")[n];
            y = rows[i + 1].getElementsByTagName("td")[n];
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


// if vendorSelect = OTHER, 
// 1. change name of first vendor box away from vendor so post doesnt grab value
// 2. change name of new other vendor box to vendor so post grabs that instead
// 3. reveal other vendor box, text input box
// 4. hide original vendor select list
var vendorSelect = document.getElementById("vendor-select");
var vendorOther = document.getElementById("vendor-other");
var vendorOtherInput = document.getElementById("vendor-other-id");

function showOtherBox(){
     
    if(vendorSelect.value == "OTHER"){
         
         
         vendorOther.style.display = "block";
         vendorOtherInput.setAttribute('name', 'vendor');
         vendorSelect.setAttribute('name', 'vendor-old');
         vendorSelect.style.display = "none";
     }

}

vendorSelect.onclick = showOtherBox;

//show only open tickets upon pageload
window.onload = hideCompleted();

// default sort by priority
window.onload = sortTable(6);