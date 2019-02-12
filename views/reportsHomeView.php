<?php
require '../content/header1.php';
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


<div class="jumbotron">
    
    <h1> Purchasing Reports </h1>
    <hr>
    <ul>
        <li><h4><a href = "../controllers/criticalImportItemsReportController.php">Critical Import Items</a></h4></li>
    
    </ul>
    
    
</div>