<?php
require_once("../models/UserManager.php");
require_once("../content/header2.php");


if (UserManager::logout()) {
    ?>

    <div class="card" id="logout-successful">
        <div class="card-body">
            <h4 class="card-title">Logout Successful!</h4>
            <a href="homeController.php" class="card-link">Return to Login</a>

        </div>
    </div>



    <?php
}
?>