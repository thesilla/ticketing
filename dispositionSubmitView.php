



<form action = "dispositionController.php" method = "post" id ="new-disposition">
    
    <div> Enter Disposition Details: </div>
    <textarea rows="10" name="disposition" form="new-disposition"> </textarea>
    <input type ="hidden" name ="ticketno" value = <?php echo "\"" . $ticket->getId() . "\""; ?>>
    <div><input type = "submit" value ="Submit Disposition" name ="submit-disposition"></div>
  
</form>
