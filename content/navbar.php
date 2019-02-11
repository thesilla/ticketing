<?php
require_once '../models/UserManager.php';
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href = '../controllers/homeController.php'><img src ="../images/tmod.jpg"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor02">


        <ul class="nav nav-tabs">

            <li class="nav-item dropdown" id="tools-dropdown">
                <a  class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Tools</a>
                <div id="tools-dropdown-content">
                    <a class="dropdown-item" href="../containercalculator/containercontroller.php">Container Multiplier Calculator</a>
                    <a class="dropdown-item" href="#">Backer Board Calculator</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../controllers/ticketsController.php">Ticketing and Cases</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../controllers/reportsController.php">Purchasing Reports</a>
                    
                </div>
            </li>


        </ul>

    </div>


    <div id="account-greeting"><h3><?php
            if (UserManager::isLoggedIn()) {

                echo "<div> Welcome, " . $_SESSION['fname'] . "!</div>";
            }
            ?></h3></div>

    <div id="adminButton"> 
        <button type="button" class ="btn btn-outline-primary dropdown1" ><div>ADMIN:</div></button>
        <!--  -->
        <div id="adminMenu"> 

            <div> <a href ="adminController.php"> Application Settings </a></div> 
            <div> <a href ="adminController.php"> Manage Users </a></div>
            <div> <a href ="adminController.php"> Manage Account </a></div>
            <div> <a href ="adminController.php"> Create New Account </a></div>
            <br/>
            <div id="logoutDiv"><a href ="logoutController.php"><button class="btn btn-info"> Log Out </button> </a></div> 


        </div>
    </div>
</nav>


