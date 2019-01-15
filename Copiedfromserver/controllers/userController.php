<?php

require_once '../models/UserManager.php';
require_once '../models/User.php';
require_once '../models/database.php';

$loginErrors = array(
    "username" => array("<p class='text-danger'> *Please enter username </p>", 0),
    "password" => array("<p class='text-danger'> *Please enter password </p>", 0),
    "dne" => array("<p class='text-danger'>*The submitted username/password combination does not exist</p>", 0)
);




$userID;
$password;
$conn;
$issue = false; // associative array for errors, to appear in correct spots --> might use Error class for this?
// if form submitted at all

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // generate instance of Tickets database;
    $conn = new database();

    // ensure username submitted
    if (!empty($_POST['username'])) {


        //$userID = htmlspecialchars(mysqli_real_escape_string($_POST['username']));
        $userID = htmlentities($_POST['username']);
    } else {



        $loginErrors['username'][1] = 1;
       
    }


    // ensure password submitted
    if (!empty($_POST['password'])) {

        //$password = htmlspecialchars(mysqli_real_escape_string($_POST['password']));
        $password = htmlentities($_POST['password']);
    } else {


        $loginErrors['password'][1] = 1;
        
    }


    // check to see if any errors
    foreach ($loginErrors as $errors) {

        if ($errors[1] == 1) {

            $issue = true;
            break;
        }
    }




// if no issues, log user in
    if (!$issue) {

        // Generate a static object from userID
        // $username and $password already provided by client above
        $firstName = "";
        $lastName = "";
        $email = "";
        $title = "";

        $user = User::create($conn, $userID, $firstName, $lastName, $email, $title, $password);

        //
        //$user->setPassword($password);
        $userManager = new UserManager($user);

        if ($userManager->login()) {


            header('Location: homeController.php');
            exit();
        
            
        // if there are errors, show login form with errors specified    
        } else {
            
            $loginErrors['dne'][1] = 1;
            require_once('../views/loginView.php');
        }

        
    
    } else {


        require_once('../views/loginView.php');
    }

// if login form NOT submitted, show the form.
} else {

    require_once('../views/loginView.php');
}
?>