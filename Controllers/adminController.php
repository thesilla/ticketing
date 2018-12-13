<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../Models/Ticket.php'; 
require_once'../Models/User.php';
require_once'../Models/Disposition.php';
require_once '../Models/Employee.php';
require_once '../Models/UserManager.php';
require_once '../Models/Database.php';
include'../Content/header1.php';
require_once("../views/createNewAccountView.php");

// create instance of tickets database
$conn = new Database();


//


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    
    
    // get variables from form if they are set, otherwise error and show form again 
    // TODO
    //  - Down the road send an email upon registering and then require the user to submit code, etc.
    
    
    
    
}

// create User object from form submission info put into variables

// then create UserManager to validate whether or not user should be created, i.e. user already exists or email already exists

// then user->add


// send confirmation/verification code email

// redirect to Manage Account page

?>