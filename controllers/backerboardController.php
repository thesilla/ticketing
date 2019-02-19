<?php

// import class files into controller
require_once '../models/Ticket.php'; 
require_once'../models/User.php';
require_once'../models/Disposition.php';
require_once '../models/Employee.php';
require_once '../models/UserManager.php';
//require_once '../models/database.php';
require_once '../models/msdatabase.php';
require_once '../models/BackerboardReport.php';
include'../content/header1.php';





$dbc = new msdatabase();
$report = new BackerboardReport($dbc);








// run reports
// get results, pass to view
$report->runPerma12();

$perma12usage = $report->getPerma12usage();
$perma12stock = $report->getPerma12stock();


$report->runPerma14();
$perma14usage = $report->getPerma14usage();
$perma14stock = $report->getPerma14stock();

$report->runHardi12();
$hardi12usage = $report->getHardi12usage();
$hardi12stock = $report->getHardi12stock();

$report->runHardi14();
$hardi14usage = $report->getHardi14usage();
$hardi14stock = $report->getHardi14stock();

//echo "<div>" . $report->getPerma12usage() . "</div>";
//echo "<div>" . $report->getPerma12stock() ."</div>";






//include report view
require_once('../views/backerboardReportView.php');





require_once('../content/footer2.php');
?>
</div> 