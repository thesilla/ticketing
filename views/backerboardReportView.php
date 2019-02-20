<div class="jumbotron">
    <h2> Backer Board Calculator </h2>
    <hr class="my-4">


<!-- for toggling permabase calculator -->
<div id="permabase" > 

 <table class = "table"> 
    <tr>
        <th scope="col">Item</th>
        <th scope="col">Weight</th>
        <th scope="col">Monthly Usage</th>
        <th scope="col">Total Stock - All Locations</th>
        <th scope="col">Months Remaining</th>
    </tr>

    <tr>
        
        <td>CB3612</td>
        <td>45.00</td>
        <td><?php echo $perma12usage;  ?></td>
        <td><?php echo $perma12stock;  ?></td>
        <td><?php echo $perma12stock/$perma12usage; ?></td>



    </tr>


    <tr>
        
        <td>CB2314</td>
        <td>30.00</td>
        <td><?php echo $perma14usage;  ?></td>
        <td><?php echo $perma14stock;  ?></td>
        <td><?php echo $perma14stock/$perma14usage; ?></td>


    </tr>


 </table>

</div>
    


<!-- for toggling hardibacker calculator -->
<div id="hardibacker">

<table class = "table"> 
    <tr>
        <th scope="col">Item</th>
        <th scope="col">Weight</th>
        <th scope="col">Monthly Usage</th>
        <th scope="col">Total Stock - All Locations</th>
        <th scope="col">Months Remaining</th>
    </tr>

    <tr>
        
        <td>HARDI030512</td>
        <td>45.00</td>
        <td ><?php echo $hardi12usage;  ?></td>
        <td><?php echo $hardi12stock;  ?></td>
        <td><?php echo $hardi12stock/$hardi12usage; ?></td>



    </tr>


    <tr>
        
        <td>HARDI030514</td>
        <td>30.00</td>
        <td><?php echo $hardi14usage;  ?></td>
        <td><?php echo $hardi14stock;  ?></td>
        <td><?php echo $hardi14stock/$hardi14usage; ?></td>


    </tr>


 </table>







 </div>

</div>