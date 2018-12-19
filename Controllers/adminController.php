<?php

require_once '../Models/Ticket.php';
require_once'../Models/User.php';
require_once'../Models/Disposition.php';
require_once '../Models/Employee.php';
require_once '../Models/UserManager.php';
require_once '../Models/Database.php';
include'../Content/header1.php';


// create instance of tickets database
$conn = new Database();


$createUserErrors = array(
    "firstname" => array("<p class='text-danger'> ***Please enter your FIRST name*** </p>", 0),
    "lastname" => array("<p class='text-danger'> ***Please enter your LAST name*** </p>", 0),
    "email" => array("<p class='text-danger'> ***Please enter a valid email address*** </p>", 0),
    "username" => array("<p class='text-danger'> ***Please enter desired username*** </p>", 0),
    "position" => array("<p class='text-danger'> ***Please enter occupational position*** </p>", 0),
    "password" => array("<p class='text-danger'> ***Please enter a valid password*** </p>", 0),
);

$firstname;
$lastname;
$email;
$username;
$position;
$password;

$problem = false;

// get variables from form if they are set, otherwise error and show form again 
// just pass in variables here, dont perform any checks besides sanitation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (!empty($_POST['firstname']) && isset($_POST['firstname'])) {

        $firstname = htmlspecialchars($_POST['firstname']);
    } else {

        $createUserErrors['firstname'][1] = 1;
    }
    if (!empty($_POST['lastname']) && isset($_POST['lastname'])) {

        $lastname = htmlspecialchars($_POST['lastname']);
    } else {

        $createUserErrors['lastname'][1] = 1;
    }


    if (!empty($_POST['username']) && isset($_POST['username'])) {

        $username = htmlspecialchars($_POST['username']);
    } else {

        $createUserErrors['username'][1] = 1;
    }

    if (!empty($_POST['password1']) && isset($_POST['password1'])) {

        $password = htmlspecialchars($_POST['password1']);
    } else {

        $createUserErrors['password'][1] = 1;
    }

    if (!empty($_POST['position']) && isset($_POST['position'])) {

        $position = htmlspecialchars($_POST['position']);
    } else {

        $createUserErrors['position'][1] = 1;
    }

    if (!empty($_POST['email']) && isset($_POST['email'])) {



        $email = htmlspecialchars($_POST['email']);
    } else {

        $createUserErrors['email'][1] = 1;
    }

    // if no problem to this point (must keep checking $problem variable to avoid null input into User object);
    // create User object from form submission info which was just put into variables
    // --->generate User object from input variables
    // check to see if any errors
    foreach ($createUserErrors as $errors) {

        if ($errors[1] == 1) {

            $problem = true;
            break;
        }
    }


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
// users cannot register themselves - must request an Admin do it
require_once("../views/createNewAccountView.php");
require_once("../Content/footer3.php");
?>