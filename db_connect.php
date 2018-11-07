<?php

try {


    $dbc = new PDO("mysql:host=localhost;dbname=ticketing", "root", "");

    $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "<div> Sucessfully connected to Database </div>";
} catch (PDOException $e) {
    $output = 'Unable to connect to the database server.';

    echo "<div style='color:red;'>" . $e->getMessage() . "</div>";

    //include 'output.html.php';
    exit();
}

//print "<div> CONNECTED SUCESSFULLY </div>";
?>






