<?php
require '../content/header2.php';
?>




<div id="loginContainer" class="jumbotron">
    <div id="loginTitle">
        <img id="loginLogo"  src="../images/tmod.jpg">
        <h1>Admin Portal Login</h1>
        <?php if ($loginErrors['dne'][1] == 1) {
            echo $loginErrors['dne'][0];
        } ?>
    </div>
    <form action="../controllers/userController.php" method ="post">
        <fieldset>

            <div class="form-group">
                <label class="col-form-label" for="inputDefault">Username</label>
                <input name = "username" type="text" class="form-control" placeholder="Please enter username" id="inputDefault">
<?php if ($loginErrors['username'][1] == 1) {
    echo $loginErrors['username'][0];
} ?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" type="password"  class="form-control" id="exampleInputPassword1" placeholder="Password">
<?php if ($loginErrors['password'][1] == 1) {
    echo $loginErrors['password'][0];
} ?>
            </div>
            <div class="form-group">
                <input class="btn btn-primary btn-lg btn-block" type ="submit" name="login" value ="Log In">
            </div>

        </fieldset>
    </form>
</div>

