<?php

// Connect to database
//require('db_connect.php');

// import class files into controller
require_once '../models/Ticket.php'; 
require_once'../models/User.php';
require_once'../models/Disposition.php';
require_once '../models/Employee.php';
require_once '../models/UserManager.php';
//require_once '../models/database.php';
require_once '../models/msdatabase.php';
require_once '../models/CriticalImportItemsReport.php';
include'../content/header1.php';





$dbc = new msdatabase();
$report = new CriticalImportItemsReport($dbc);

// get results, pass to view
$results = $report->run();



//include report view
require_once('../views/criticalImportItemsReportView.php');





require_once('../content/footer2.php');
?>
</div> 