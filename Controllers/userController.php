<?php

require_once '../Models/UserManager.php';
require_once '../Models/User.php';
require_once '../Models/Database.php';

$userID;
$password;
$conn;
$errors = false; // associative array for errors, to appear in correct spots --> might use Error class for this?
// if form submitted at all

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // generate instance of Tickets database;
    $conn = new Database();

    // ensure username submitted
    if (!empty($_POST['username'])) {

        // FIXME - sanitze this
        //$userID = htmlspecialchars(mysqli_real_escape_string($_POST['username']));
        $userID = $_POST['username'];
        

    } else {


        // TODO: Error please submit username
        //echo "<div> Please submit username </div>";
        $errors = true;
    }

    // FIXME - sanitze this
    // ensure password submitted
    if (!empty($_POST['password'])) {

        //$password = htmlspecialchars(mysqli_real_escape_string($_POST['password']));
        $password = $_POST['password'];
   
    } else {


        // TODO: Error please submit password
        echo "<div> Please submit password </div>";
        $errors = true;
    }


// if no issues, log user in
    if (!$errors) {
        
        // Generate a static object from userID
        // $username and $password already provided by client above
        $firstName="";
        $lastName="";
        $email="";
        $title="";
        
        $user = User::create($conn, $userID, $firstName, $lastName, $email, $title, $password);

        //
        //$user->setPassword($password);
        $userManager = new UserManager($user);

        if ($userManager->login()) {
            

            header('Location: homeController.php');
            exit();
        } else {
            
            //TODO - instead of bringing up blank screen with link back to login, register non-match error and show the form again
            echo "<div> The submitted username/password combination does not exist </div>";
            echo "<div> <a href = 'homeController.php'> Return to Login </a> </div>";
        }
        
    // if there are errors, show login form with errors specified
    // TODO - Make login form error dynamic
    } else {

       
        require_once('../Views/loginView.php');
    }
    
// if login form NOT submitted, show the form.
} else {

    require_once('../Views/loginView.php');
}
?>