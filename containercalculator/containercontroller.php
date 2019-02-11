<?php
ob_start();

// Connect to database

require '../content/header_container.php';
// TODO: - do one of the following:
// 1. Create functions thats translate view input variables OR
// PROBABLY DO THIS --> 2. Make views into functions that include the HTML view files and take input and convert inputs to correct variables, etc AKA make another layer <--
//require('db_connect.php');
// import class files into controller
require_once '../models/Ticket.php';
require_once'../models/User.php';
require_once'../models/Disposition.php';
require_once '../models/Employee.php';
require_once '../models/UserManager.php';
require_once '../models/database.php';
?>




<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="superhero.css">
        <title>Container Calculator - Landed Costs</title>
    </head>
    <body>

        <div class="jumbotron">

            <div id="logo">
                
                <div><h1>Container Calculator - Landed Costs</h1></div>
            </div>





<?php
// TODO - 
// in first form enter how many POs on groupage
// then generate second form with only as many boxes as needed

try {

    $dbc = new PDO("sqlsrv:server=SQL2012;database=P21_V12_15", "", "");

    $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $output = 'Unable to connect to the database server.';

    print "<div style='color:red;'>" . $e->getMessage() . "</div>";

    exit();
}





if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $duty = 0;
    $misc = 0;
    $freight = 0;
    $po1;
    $po2;
    $po3;
    $po4;
    $po5;

    $dutyMultiplier = 0.085;
    $freightMultiplier;
    $miscMultiplier;

    $totalP21Weight = 0;
    $totalP21Amount = 0;
    $totalP21CustomsDuty = 0;
    $totalCustomsDutyDifference = 0;

    $po1Weight;
    $po1Amount;
    $po1CustomsDuty;
    $po1AOFreight;
    $po1MiscCharge;
    $po1TotalLanded;

    $po2Weight;
    $po2Amount;
    $po2CustomsDuty;
    $po2AOFreight;
    $po2MiscCharge;
    $po2TotalLanded;

    $po3Weight;
    $po3Amount;
    $po3CustomsDuty;
    $po3AOFreight;
    $po3MiscCharge;
    $po3TotalLanded;

    $po4Weight;
    $po4Amount;
    $po4CustomsDuty;
    $po4AOFreight;
    $po4MiscCharge;
    $po4TotalLanded;

    $po5Weight;
    $po5Amount;
    $po5CustomsDuty;
    $po5AOFreight;
    $po5MiscCharge;
    $po5TotalLanded;





    if (!empty($_POST['duty'])) {

        $duty = floatval($_POST['duty']);
    } else {

        echo "<div class = 'error'> *Please enter duty from invoice </div>";
    }

    if (!empty($_POST['misc'])) {

        $misc = floatval($_POST['misc']);
    } else {

        echo "<div class = 'error'> *Please enter misc charges from invoice </div>";
    }

    if (!empty($_POST['freight'])) {

        $freight = floatval($_POST['freight']);
    } else {

        echo "<div class = 'error'> *Please enter freight from invoice </div>";
    }

    if (!empty($_POST['po1'])) {

        $po1 = intval($_POST['po1']);


        $sql1 = "
select q.po_no, sum(q.lineweight) as totalweight, sum(q.extendedcost) as totalvalue from

(select im.item_id, im.item_desc, pol.po_no, im.weight, pol.qty_ordered, (pol.unit_price*pol.qty_ordered) as extendedcost, (im.weight*pol.qty_ordered) as lineweight from po_line pol
inner join inv_mast im on pol.inv_mast_uid = im.inv_mast_uid

where pol.po_no = '$po1' AND pol.cancel_flag='N') q group by q.po_no";


        $stmt1 = $dbc->query($sql1);

        if ($stmt1) {

            while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {

                $po1Weight = $row['totalweight'];
                $po1Amount = $row['totalvalue'];
            }
        } else {
            print "couldnt run query";
        }


        // TODO - FINISH THESE AFTER MULTIPLIERS ARE DONE
        //$po1CustomsDuty = $po1Amount * 0.05;
        //$po1AOFreight;
        //$po1MiscCharge;
        //$po1TotalLanded;
        //add weight to P21 Total Weight
        $totalP21Weight += $po1Weight;

        //add amount to P21 Total Weight
        $totalP21Amount += $po1Amount;
        $po1CustomsDuty = $dutyMultiplier * $po1Amount;
        $totalP21CustomsDuty += $po1CustomsDuty;
    }

    if (!empty($_POST['po2'])) {

        $po2 = $_POST['po2'];

        $sql2 = "
select q.po_no, sum(q.lineweight) as totalweight, sum(q.extendedcost) as totalvalue from

(select im.item_id, im.item_desc, pol.po_no, im.weight, pol.qty_ordered, (pol.unit_price*pol.qty_ordered) as extendedcost, (im.weight*pol.qty_ordered) as lineweight from po_line pol
inner join inv_mast im on pol.inv_mast_uid = im.inv_mast_uid

where pol.po_no = '$po2' AND pol.cancel_flag='N') q group by q.po_no";

        $stmt2 = $dbc->query($sql2);

        if ($stmt2) {

            while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {

                $po2Weight = $row['totalweight'];
                $po2Amount = $row['totalvalue'];
            }
        } else {
            print "couldnt run query";
        }

        //add weight to P21 Total Weight
        $totalP21Weight += $po2Weight;

        //add amount to P21 Total Weight
        $totalP21Amount += $po2Amount;
        $po2CustomsDuty = $dutyMultiplier * $po2Amount;
        $totalP21CustomsDuty += $po2CustomsDuty;
    }
    if (!empty($_POST['po3'])) {

        $po3 = $_POST['po3'];


        $sql3 = "
select q.po_no, sum(q.lineweight) as totalweight, sum(q.extendedcost) as totalvalue from

(select im.item_id, im.item_desc, pol.po_no, im.weight, pol.qty_ordered, (pol.unit_price*pol.qty_ordered) as extendedcost, (im.weight*pol.qty_ordered) as lineweight from po_line pol
inner join inv_mast im on pol.inv_mast_uid = im.inv_mast_uid

where pol.po_no = '$po3' AND pol.cancel_flag='N') q group by q.po_no";


        $stmt3 = $dbc->query($sql3);

        if ($stmt3) {

            while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)) {

                $po3Weight = $row['totalweight'];
                $po3Amount = $row['totalvalue'];
            }
        } else {
            print "couldnt run query";
        }

        //add weight to P21 Total Weight
        $totalP21Weight += $po3Weight;

        //add amount to P21 Total Weight
        $totalP21Amount += $po3Amount;

        $po3CustomsDuty = $dutyMultiplier * $po3Amount;
        $totalP21CustomsDuty += $po3CustomsDuty;
    }
    if (!empty($_POST['po4'])) {

        $po4 = $_POST['po4'];
        $sql4 = "
select q.po_no, sum(q.lineweight) as totalweight, sum(q.extendedcost) as totalvalue from

(select im.item_id, im.item_desc, pol.po_no, im.weight, pol.qty_ordered, (pol.unit_price*pol.qty_ordered) as extendedcost, (im.weight*pol.qty_ordered) as lineweight from po_line pol
inner join inv_mast im on pol.inv_mast_uid = im.inv_mast_uid

where pol.po_no = '$po4' AND pol.cancel_flag='N') q group by q.po_no";

        $stmt4 = $dbc->query($sql4);

        if ($stmt4) {

            while ($row = $stmt4->fetch(PDO::FETCH_ASSOC)) {

                $po4Weight = $row['totalweight'];
                $po4Amount = $row['totalvalue'];
            }
        } else {
            print "couldnt run query";
        }

        //add weight to P21 Total Weight
        $totalP21Weight += $po4Weight;

        //add amount to P21 Total Weight
        $totalP21Amount += $po4Amount;
        $po4CustomsDuty = $dutyMultiplier * $po4Amount;
        $totalP21CustomsDuty += $po4CustomsDuty;
    }
    if (!empty($_POST['po5'])) {

        $po5 = $_POST['po5'];

        $sql5 = "
select q.po_no, sum(q.lineweight) as totalweight, sum(q.extendedcost) as totalvalue from

(select im.item_id, im.item_desc, pol.po_no, im.weight, pol.qty_ordered, (pol.unit_price*pol.qty_ordered) as extendedcost, (im.weight*pol.qty_ordered) as lineweight from po_line pol
inner join inv_mast im on pol.inv_mast_uid = im.inv_mast_uid

where pol.po_no = '$po5' AND pol.cancel_flag='N') q group by q.po_no";

        $stmt5 = $dbc->query($sql5);

        if ($stmt5) {

            while ($row = $stmt4->fetch(PDO::FETCH_ASSOC)) {

                $po4Weight = $row['totalweight'];
                $po4Amount = $row['totalvalue'];
            }
        } else {
            print "couldnt run query";
        }


        //add weight to P21 Total Weight
        $totalP21Weight += $po5Weight;

        //add amount to P21 Total Weight
        $totalP21Amount += $po5Amount;

        $po5CustomsDuty = $dutyMultiplier * $po5Amount;
        $totalP21CustomsDuty += $po5CustomsDuty;
    }



    $totalCustomsDutyDifference = $duty - $totalP21CustomsDuty;


    if ($totalP21Weight != 0) {

        $freightMultiplier = round($freight / $totalP21Weight, 6);
        $miscMultiplier = round(($totalCustomsDutyDifference + $misc) / $totalP21Weight, 6);
    } else {

        $freightMultiplier = 0.00;
        $miscMultiplier = 0.00;
    }

    // SHOW RESULTS/MULTIPLIERS

    print "<div id ='results'>";
    print "<p style='text-align: center; font-size: 16pt;'>Calculated Multipliers</p>";
    print "<table id = 'resultsTable'>";

    //print "<tr>";
    //print "<th> Item  </hr> <th>Multiplier</th> ";
    //print "</tr>";
    print "<tr>";

    print "<td class='resultslabel'> Customs Duty: </td><td class='results'> " . $dutyMultiplier . "</td>";
    print "</tr>";

    print "<tr>";
    print "<td class='resultslabel'> Freight: </td><td class='results'> " . $freightMultiplier . "</td>";
    print "</tr>";

    print "<tr>";
    print "<td class='resultslabel'> Misc Charge: </td><td class='results'> " . $miscMultiplier . "</td>";
    print "</tr>";


    print "</table>";
    print "</div>";
}
?>


            <!DOCTYPE html>


            <div id="innerContainer">
                <form action ="containercontroller.php" method ="post">
                    <div id="invoice">
                        <p>U.S. Customs Duty (As on invoice):</p>
                        <input type ="text" name ="duty" value = <?php
            if (!empty($_POST['duty'])) {
                echo $_POST['duty'];
            }
?>>
                        <p>Misc Charge (added up on invoice):</p>
                        <input type ="text" name ="misc" value = <?php
                        if (!empty($_POST['misc'])) {
                            echo $_POST['misc'];
                        }
                        ?>>
                        <p>Air/Ocean Freight:</p>
                        <input type ="text" name ="freight" value = <?php
                        if (!empty($_POST['freight'])) {
                            echo $_POST['freight'];
                        }
                        ?>>
                    </div>

                    <div id="p21">
                        <p>Purchase Order #1:</p>
                        <input type ="text" name ="po1" value = <?php
                               if (!empty($_POST['po1'])) {
                                   echo $_POST['po1'];
                               }
                               ?>>
                        <p>Purchase Order #2:</p>
                        <input type ="text" name ="po2" value = <?php
                        if (!empty($_POST['po2'])) {
                            echo $_POST['po2'];
                        }
                        ?>>
                        <p>Purchase Order #3:</p>
                        <input type ="text" name ="po3" value = <?php
                        if (!empty($_POST['po3'])) {
                            echo $_POST['po3'];
                        }
                        ?>>
                        <p>Purchase Order #4:</p>
                        <input type ="text" name ="po4" value = <?php
                        if (!empty($_POST['po4'])) {
                            echo $_POST['po4'];
                        }
                        ?>>
                        <p>Purchase Order #5:</p>
                        <input type ="text" name ="po5" value = <?php
                        if (!empty($_POST['po5'])) {
                            echo $_POST['po5'];
                        }
                        ?>>
                    </div>
                    <br/>
                    <div><input class ="btn btn-primary"id = "submit" type ="submit" name ="submit" value="Generate Multipliers"></div>


                </form>


            </div>



        </div>





    </body>
</html>
