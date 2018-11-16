function editTicket(){
    
   	var ticketContainer1 = document.getElementById('editTicket');
	
	ticketContainer1.style.display = "block"; 
    
    
}

function closeEditTicket(){
    
   	var ticketContainer2 = document.getElementById('editTicket');
	
	ticketContainer2.style.display = "none"; 
    
    
}

function addDisposition(){
    
       	var newDispoContainer1 = document.getElementById('new-disposition-container');
	
	newDispoContainer1.style.display = "block"; 
    
}


function closeAddDisposition(){
    
        var newDispoContainer2 = document.getElementById('new-disposition-container');
	
	newDispoContainer2.style.display = "none"; 
    
    
    
}



var addDispositionButton = document.getElementById('addDispositionButton');
addDispositionButton.onclick = addDisposition;

var closeAddDispositionButton = document.getElementById('closeAddDispositionButton');
closeAddDispositionButton.onclick = closeAddDisposition;


var closeEditTicketButton = document.getElementById('closeEditTicket');
closeEditTicketButton.onclick = closeEditTicket;

var editTicketButton = document.getElementById('editTicketButton');
editTicketButton.onclick = editTicket;

