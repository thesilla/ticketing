<?php
require '../Content/header2.php';
?>




<div id="loginContainer" class="jumbotron">
    <div id="loginTitle">
        <img id="loginLogo"  src="../Images/tmod.jpg">
        <h1>Admin Portal Login</h1>
    </div>
    <form action="../Controllers/userController.php" method ="post">
        <fieldset>

            <div class="form-group">
                <label class="col-form-label" for="inputDefault">Username</label>
                <input name = "username" type="text" class="form-control" placeholder="Please enter username" id="inputDefault">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" type="password"  class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
                <input class="btn btn-primary btn-lg btn-block" type ="submit" name="login" value ="Log In">
            </div>

        </fieldset>
    </form>
</div>