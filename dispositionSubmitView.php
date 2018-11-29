


<div  id="new-disposition-container" class="alert alert-dismissible alert-secondary" >
    <div class="form-group">
    <!--<button class="close" type="button" data-dismiss="alert" id="closeAddDispositionButton">&times;</button> -->
    <button class="close" id="closeAddDispositionButton"> &times; </button> 
    <form action = "dispositionController.php" method = "post" id ="new-disposition" class = "form">

        <div> Enter Disposition Details: </div>
        <textarea class="form-control"rows="5"name="disposition" form="new-disposition"> </textarea>
        <input type ="hidden" name ="ticketno" value = <?php echo "\"" . $ticket->getId() . "\""; ?>>
        <br/>
        <div><input type = "submit" class="btn btn-success" value ="Submit Disposition" name ="submit-disposition"></div>

    </form>
    </div>
</div>

<!-- <button id="addDispositionButton" class="btn btn-success"> Add Disposition </button> -->

