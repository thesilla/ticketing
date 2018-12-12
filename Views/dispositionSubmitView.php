


<div  id="new-disposition-container" class="alert alert-dismissible alert-secondary" >
    <div class="form-group">
    <!--<button class="close" type="button" data-dismiss="alert" id="closeAddDispositionButton">&times;</button> -->
    
    <form action = "dispositionController.php" method = "post" id ="new-disposition" class = "form">

        <h3> Enter Disposition Details: </h3>
        <textarea class="form-control"rows="5"name="disposition" form="new-disposition"> </textarea>
        
        <input type ="hidden" name ="ticketno" value = <?php echo "\"" . $ticket->getId() . "\""; ?>>
            
            
        
        <br/>
        <div id="closeAddDisposition">
            <div id="dispositionSubmitButtonContainer"><input type = "submit" class="btn btn-success" value ="Submit Disposition" name ="submit-disposition"></div>
            <button type = "button" class="btn btn-secondary" id="closeAddDispositionButton"> Cancel </button> 
        </div>
    </form>
    </div>
</div>

<!-- <button id="addDispositionButton" class="btn btn-success"> Add Disposition </button> -->































<script>
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
    </script>