


<div class="jumbotron">
    <h2> Backer Board Calculator </h2>
    <hr class="my-4">


<button id = "permabase-button" class = "btn btn-outline-success btn-lg">Permabase</button>
<button id = "hardibacker-button"  class = "btn btn-outline-warning btn-lg">Hardibacker</button>
<hr>

<div id = "backerboard">
<!-- for toggling permabase calculator -->





<div id="permabase" >
<div class = "backer-label" > <h3> Permabase </h3> </div>

<div id ="perma-total-weight" class = "total-weight">--</div>
 <table  style = "border: 1pt solid black;" >
    <tr>
        <th >Item</th>
        <th >Weight</th>
        <th >Monthly Usage</th>
        <th >Total Stock - All Locations</th>
        <th >Months Remaining</th>
        <th> Units To Purchase </th>
        


    </tr>

    <tr>

        <td>CB3612</td>
        <td id ="perma12wt">45.00</td>
        <td id = "perma12usage"><?php echo $perma12usage; ?></td>
        <td id = "perma12stock"><?php echo $perma12stock; ?></td>
        <td id = "perma12mr"><?php echo round($perma12stock / $perma12usage, 2); ?></td>
        <td id="perma-results12"></td>
       


    </tr>


    <tr>

        <td>CB2314</td>
        <td id ="perma14wt">30.00</td>
        <td id ="perma14usage"><?php echo $perma14usage; ?></td>
        <td id ="perma14stock"><?php echo $perma14stock; ?></td>
        <td id ="perma14mr"><?php echo round($perma14stock / $perma14usage, 2); ?></td>
        <td id="perma-results14"></td>

    </tr>


 </table >

 <div id = "perma-months-supply" class = "months-supply"> 

    <div> Month's Supply </div>
    <div><input id ="pms" type="text"></div>
    <button id = "perma-calc-button" class = "btn btn-primary"> Calculate Quantities </button>
 

 </div>

</div>






<!-- for toggling hardibacker calculator -->
<div id="hardibacker">
<div class = "backer-label" > <h3> Hardibacker </h3> </div>

<div id ="hardi-total-weight" class = "total-weight"> --</div>

<table  >
    <tr>
        <th >Item</th>
        <th >Weight</th>
        <th >Monthly Usage</th>
        <th >Total Stock - All Locations</th>
        <th >Months Remaining</th>
        <th> Units To Purchase </th>
    </tr>

    <tr>

        <td>HARDI030512</td>
        <td id ="hardi12wt">45.00</td>
        <td id ="hardi12usage"><?php echo $hardi12usage; ?></td>
        <td id ="hardi12stock"><?php echo $hardi12stock; ?></td>
        <td id ="hardi12mr"><?php echo round($hardi12stock / $hardi12usage, 2); ?></td>
        <td id="hardi-results12"></td>


    </tr>


    <tr>

        <td>HARDI030514</td>
        <td id ="hardi14wt">30.00</td>
        <td id ="hardi14usage"><?php echo $hardi14usage; ?></td>
        <td id ="hardi14stock"><?php echo $hardi14stock; ?></td>
        <td id ="hardi14mr"><?php echo round($hardi14stock / $hardi14usage, 2); ?></td>
        <td id="hardi-results14"></td>

    </tr>


 </table>

 <div id = "hardi-months-supply" class = "months-supply"> 

    <div> Month's Supply </div>
    <div><input id ="hms" type="text"></div>
    <button id = "hardi-calc-button" class = "btn btn-primary"> Calculate Quantities </button>
    

 </div>



 </div>
</div>

</div>






<script>

// ---------------- show/hide functions ---------------------------------

// buttons to calculate functions
var permabaseButton = document.getElementById("permabase-button");
var hardibackerButton = document.getElementById("hardibacker-button");

// containers
var permabaseContainer = document.getElementById("permabase");
var hardibackerContainer = document.getElementById("hardibacker");


function showPerma(){

    // hide hardibacker container
    hardibackerContainer.style.display = "none";

    // show permabase container

    permabaseContainer.style.display = "block";
}

function showHardi(){

    // show hardibacker container
    hardibackerContainer.style.display = "block";

    // hide permabase container

    permabaseContainer.style.display = "none";

}

// show buttons
permabaseButton.onclick = showPerma;
hardibackerButton.onclick = showHardi;


// ---------------- calculate functions ----------------------------------

// calc buttons
var calcHardiButton = document.getElementById("hardi-calc-button");
var calcPermaButton = document.getElementById("perma-calc-button");


// weight divs

var permaTotalWt = document.getElementById("perma-total-weight");
var hardiTotalWt = document.getElementById("hardi-total-weight");



// data from all cells

// --------permabase
var perma12wt = document.getElementById("perma12wt");
var perma12usage = document.getElementById("perma12usage");
var perma12stock = document.getElementById("perma12stock");
var perma12mr = document.getElementById("perma12mr");


var perma14wt = document.getElementById("perma14wt");
var perma14usage = document.getElementById("perma14usage");
var perma14stock = document.getElementById("perma14stock");
var perma14mr = document.getElementById("perma14mr");


// ---------hardibacker

var hardi12wt = document.getElementById("hardi12wt");
var hardi12usage = document.getElementById("hardi12usage");
var hardi12stock = document.getElementById("hardi12stock");
var hardi12mr = document.getElementById("hardi12mr");


var hardi14wt = document.getElementById("hardi14wt");
var hardi14usage = document.getElementById("hardi14usage");
var hardi14stock = document.getElementById("hardi14stock");
var hardi14mr = document.getElementById("hardi14mr");



// results cells - units to buy

var hardi12results = document.getElementById("hardi-results12");
var hardi14results = document.getElementById("hardi-results14");
var perma12results = document.getElementById("perma-results12");
var perma14results = document.getElementById("perma-results14");


// Month's supply input box - Permabase
var monthsSupplyPermabase = document.getElementById("pms")

// Month's supply input box - Hardibacker
var monthsSupplyHardibacker = document.getElementById("hms")



function calcHardibacker(){

    // pallet quantities for each size
    var pt14 = 60;
    var pt12 = 50;

    // pull values
    var ms = Number(monthsSupplyHardibacker.value);
    var u14= Number(hardi14usage.innerHTML);
    var u12= Number(hardi12usage.innerHTML);
    var s14 = Number(hardi14stock.innerHTML);
    var s12 = Number(hardi12stock.innerHTML);

    // store results
    var results14 = (u14 * ms) - s14;
    var results12 = (u12 * ms) - s12;
    
    // update HTML of Units to Buy cells
    // rounds down to lower pallet quantity

    var units12 = Math.floor(results12/pt12) * pt12;
    var units14 = Math.floor(results14/pt14) * pt14;

    hardi12results.innerHTML = units12;
    hardi14results.innerHTML = units14 ;
  
    var totalwt = (units12 * 45) + (units14 * 30);
    hardiTotalWt.innerHTML =  totalwt;

}

function calcPermabase(){


    // pallet quantities for each size
    var pt14 = 60;
    var pt12 = 50;

    // pull values
    var ms = Number(monthsSupplyPermabase.value);
    var u14= Number(perma14usage.innerHTML);
    var u12= Number(perma12usage.innerHTML);
    var s14 = Number(perma14stock.innerHTML);
    var s12 = Number(perma12stock.innerHTML);

    // store results
    var results14 = (u14 * ms) - s14;
    var results12 = (u12 * ms) - s12;
    
    // update HTML of Units to Buy cells
    // rounds down to lower pallet quantity

    var units12 = Number(Math.floor(results12/pt12) * pt12);
    var units14 = Number(Math.floor(results14/pt14) * pt14);

    perma12results.innerHTML = units12;
    perma14results.innerHTML = units14;

   

    var totalwt = (units12 * 45) + (units14 * 30);

    permaTotalWt.innerHTML =  totalwt;

}


calcHardiButton.onclick = calcHardibacker;
calcPermaButton.onclick = calcPermabase;
</script>
