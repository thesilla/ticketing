<?php
require_once '../Models/UserManager.php';
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href = '../Controllers/homeController.php'><img src ="../Images/tmod.jpg"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor02">
        <!--<ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Tools</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Maintenence</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
        </ul>
        

        
.dropdown1 {
    position: relative;
    display: inline-block;
}

.dropdown-content1 {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 12px 16px;
    z-index: 1;
}

.dropdown1:hover .dropdown-content1 {
    display: block;
}

        -->

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#home">Home</a>
            <li class="nav-item dropdown" id="tools-dropdown">
                <a  class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Tools</a>
                <div id="tools-dropdown-content">
                    <a class="dropdown-item" href="#">Container Multiplier Calculator</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Ticketing and Cases</a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#home">About</a>
            </li>


        </ul>

    </div>


    <div id="account-greeting"><h3><?php
if (UserManager::isLoggedIn()) {

    echo "<div> Welcome, " . $_SESSION['fname'] . "!</div>";
}
?></h3></div>

    <div id="adminButton"> <!-- btn btn-outline-primary dropdown1 -- > put this back in admin button class -->
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
<br/>

