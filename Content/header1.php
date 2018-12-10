
<?php
ob_start();
session_start();


// If not logged in, redirect to login
require_once '../Models/UserManager.php';
if (!UserManager::isLoggedIn()) {

    //$path = "Location: ..\Views\loginView.php";
    //$path = "Location: Views/loginView.php";
    //$path = $web_root = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/";

    $path = "Location: userController.php";

    header($path);
    exit();
}
?>

<!DOCTYPE html>

<html lang = "en">





    <head>

        <!-- TODO: make page name dynamic -->
        <title> Customize </title>
        <meta charset = "utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" >
        <link rel="stylesheet"  href="../Content/superhero.css">


        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body>

        <div id ="main-container">


<?php
include('navbar.php');

if (UserManager::isLoggedIn()) {

    echo "<div> Welcome, " . $_SESSION['fname'] . "!</div>";
}


?>