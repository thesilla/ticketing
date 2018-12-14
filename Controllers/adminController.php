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


// create instance of tickets database
$conn = new Database();


//
$firstname;
$lastname;
$email;
$username;
$position;
$password;

$problem = false;

// get variables from form if they are set, otherwise error and show form again 
// just pass in variables here, dont perform any checks besides sanitation
// FIXME - SQL SANITIZE THIS
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (!empty($_POST['firstname']) && isset($_POST['firstname'])) {

        $firstname = htmlspecialchars($_POST['firstname']);
    } else {

        $problem = true;
    }
    if (!empty($_POST['lastname']) && isset($_POST['lastname'])) {

        $lastname = htmlspecialchars($_POST['lastname']);
    }


    if (!empty($_POST['username']) && isset($_POST['username'])) {

        $username = htmlspecialchars($_POST['username']);
    } else {

        $problem = true;
    }

    if (!empty($_POST['password1']) && isset($_POST['password1'])) {

        $password = htmlspecialchars($_POST['password1']);
    } else {

        $problem = true;
    }

    if (!empty($_POST['position']) && isset($_POST['position'])) {

        $position = htmlspecialchars($_POST['position']);
    } else {

        $problem = true;
    }

    if (!empty($_POST['email']) && isset($_POST['email'])) {



        $email = htmlspecialchars($_POST['email']);
    } else {

        $problem = true;
    }

    // if no problem to this point (must keep checking $problem variable to avoid null input into User object);
    // create User object from form submission info which was just put into variables
    // --->generate User object from input variables


    if (!$problem) {

        $user = User::create($conn, $username, $firstname, $lastname, $email, $position, $password);

        // Create userManager object to process validity of desired User data
        $userManager = new UserManager($user);

        // validate whether or not user should be created, i.e. user already exists or email already exists
        if ($userManager->userExists()) {

            $problem = true;
            echo "USER EXISTS";
        }

        if ($userManager->emailExists()) {

            $problem = true;
            echo "EMAIL EXISTS";
        }


        // if no problems, add user to database
        if (!$problem) {

            $user->add();
        }
    }
}



// then create UserManager to 
// send confirmation/verification code email
// redirect to Manage Account page cant do this because another user still logged in
// users cannot register themself
require_once("../views/createNewAccountView.php");
?>