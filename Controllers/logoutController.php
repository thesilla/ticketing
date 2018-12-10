<?php
session_start();
require_once("../Models/UserManager.php");

if(UserManager::logout()){
    
    echo "<div> you have logged out </div>";
    echo "<div> <a href = 'homeController.php'> Return to Login </a> </div>";
    
} else {
    
    
    echo "<div> logout didnt work </div>";
    
}
    
    
    
    



?>