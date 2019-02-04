

<div id="submitTicket" class="jumbotron"style = <?php
// check if any errors exist
// if so, show form on reload with errors displayed
$issue = false;
foreach ($ticketSubmitErrors as $errors) {

    if ($errors[1] == 1) {

        $issue = true;
        break;
    }
}

if ($issue) {


    echo "\"" . "display: block;" . "\"";
} else {

    echo "\"" . "display: hidden;" . "\"";
}
?>

     >

    <form class="form-horizontal" action ="ticketsController.php" method ="post" id="submitTicketForm" class = "form">
        <h1 style ="text-align: center;">Create New Ticket</h1>

        <div class="form-group">
            <label for="subject">Subject:</label>
            <input class="form-control"  type ="text" name ="subject" placeholder ="please enter subject">
<?php if ($ticketSubmitErrors['subject'][1] == 1) {
    echo $ticketSubmitErrors['subject'][0];
} ?>
        </div>
        <div class="form-group">
            <label for="details">Ticket Details - Please Explain the Issue:</label>
            <textarea class="form-control"rows="3" name ="details" id="submitTicketDetails" form="submitTicketForm"></textarea>
        </div>






        <div class="form-group">
            <label for="requestedby">Requested By:</label>

            <select class="custom-select" name="requestedby">

<?php
// pull all employees and display
// $allusers is in ticketsController.php
//$allEmployees = Employee::getEmployees();

foreach ($employees as $employee) {

    echo '<option value=' . $employee->getEmail() . '>' . $employee->getFirstName() . " " . $employee->getLastName() . " (" . $employee->getEmail() . ")" . '</option>';
}
?>
            </select>
                <?php if ($ticketSubmitErrors['requestedby'][1] == 1) {
                    echo $ticketSubmitErrors['requestedby'][0];
                } ?>


        </div>

        <div>Order ID: </div>
        <div><input class="form-control" type ="text" name ="orderid" placeholder ="(If applicable)"></div>

        
        
        <?php
        
        $vendors = [
        "Marazzi USA", "American Olean","Stone Mosaics","Porcelanosa","Arley Wholesale","Island Stone","Sita Tile Distributors","WOW USA INC.","Ferguson Enterprises Inc.","Marble Systems","Lunada Bay Tile","Wet Dog Tile","Florida Tile","Garden State Tile Distributors","StoneMar Natural Stone Company LLC","Glazzio Tiles","Medicine Bluff Studio","Custom Building Products Inc.","Standard Tile Supply Co.","Standard Tile Imports Inc.","Cosa Marble Company","Renaissance Ceramic Tile and Marble","American TileMakers (Ken Mason)","SQF Studios","Artistic Tile","Tile Gallery","Elon Inc.","Stone Impressions","Mir Mosaic","Ironrock Capital"," Inc. (Metropolitan)","National Pool Tile","Panaria","Daltile Distribution Inc.","New Ravenna","The Cleftstone Works","Landmark MetalCoat","Stone Art","BellaVita Tile","Heartland Ceramic Tile Dist.","Stone Partnership","Mark E. Industries","Alpha Concrete Products Inc.","Trikeenan Tileworks","Caribe International","J.J. Haines and Company Inc.","MS International","Imer U.S.A.","Jeffrey Court","Barwalt Tool Company","Original Style LTD","Mapei Corporation","Imola North America","Chesapeake Tile and Marble","Sawmaster Diamond Tools","T N Master Tile","Quemere International LLC","Noble Company","B and F Ceramics","Boulder Creek Stone and Brick Company","Surving Studios","Honor Life","Dewalt Service Center","Alpha Professional Tools","Bisazza North America Inc.","AKDO Intertrade Inc.","European Granite and Marble Of New Jersey","United States Gypsum Company","Watts Water Technologies Inc.","Innovis Corporation","Rubitools USA Inc.","Marshalltown","Schluter Systems L.P.","Nelson Watson","TileWare Products","Power Line Imports","Laticrete","Onyx France","Delos Mosaics","Adex USA","Solistone","Paloma Pewter","Maniscalco","Bostik","Florim USA Inc.","Cepac Tile","SYZYGY","Architectural Ceramics","National Gypsum","ISLA","Rondine","Astor Gruppo Beta","Ermes","Imola","Ceramica Sant Agostino","Florim Ceramiche SPA","Grespania","Bella Casa","Argenta (WSG)","Ape","Adex - Spain","Porcelanicos HDC","OTHER"];

        
        
        
        ?>
      
        <div>Vendor: </div>
        

        
        <select id="vendor-select" class="custom-select" name="vendor">

<?php

foreach ($vendors as $vendor) {

    echo "<option value=" . "\"" . $vendor . "\">" . $vendor . "</option>";
}
?>
        </select>
        
        
        
        
        
        <div id="vendor-other" style="display: none;"><input id="vendor-other-id" class="form-control" type ="text" name ="vendor-hidden" placeholder ="Enter Vendor Name"></div>
        
      
        <!-- picked from an editable dynamic list of all possible categories -->
        <div>Category:</div>

        <select class="custom-select" name="category">

<?php
$categories = [
    "Need ETA",
    "Pricing Issue",
    "Build Items",
    "Expedite Needed",
    "Labels Needed",
    "Shipping Issue",
    "Freight Quote Needed",
    "Product Broken",
    "Research Required",
    "Product Return",
    "Other Misc",
];
foreach ($categories as $category) {

    echo "<option value=" . "\"" . $category . "\">" . $category . "</option>";
}
?>
        </select>
            <?php if ($ticketSubmitErrors['category'][1] == 1) {
                echo $ticketSubmitErrors['category'][0];
            } ?>





        <fieldset class="form-group">
            <div>Priority:</div>
            <div class="form-check">
                <label class="form-check-label" for="priority">
                    <input name="priority" class="form-check-input" id="optionsRadios1" type="radio" checked="" value="3">
                    3 (Lowest) 
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="priority">
                    <input name="priority" class="form-check-input" id="optionsRadios2" type="radio" value="2">
                    2
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="priority">
                    <input name="priority" class="form-check-input" id="optionsRadios3" type="radio" value="1">
                    1 (Highest)
                </label>
            </div>
        </fieldset>


        <!-- Assigned To: -->
        <div class="form-group">
            <div>Assigned To:</div>
            <select class="custom-select" name="assignedto">

<?php
// pull all users and display
// $allusers is in ticketsController.php

foreach ($allusers as $user) {

    echo '<option value=' . $user->getFirstName() . '>' . $user->getFirstName() . '</option>';
}
?>
            </select>
                <?php if ($ticketSubmitErrors['assignedto'][1] == 1) {
                    echo $ticketSubmitErrors['assignedto'][0];
                } ?>

        </div>

        <br/>
        <!-- submit button -->
        <input  id  ="submitTicketButton" class="btn btn-primary btn-lg btn-block" type ="submit" value ="Submit Ticket" name ="submitticketbutton">
        <br/>
        <div id ="submitTicketCancel"><button class="btn btn-secondary" id="closeSubmitTicketButton"> CANCEL </button></div>

    </form>
</div>
