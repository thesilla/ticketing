<?php ?>


<!-- Master container -->
<div class="jumbotron">


    <div id="createUserContainer" class="jumbotron">

        <form class="form-horizontal" action="adminController.php" method="post" id="createNewUserForm">
            <h1 style ="text-align: center" class="panel-title"> Add New Administrator </h1>
            <div class="panel-body">



                <label  for="firstname">Enter First Name</label>

                <input name = "firstname" class="form-control" id="inputFirstName" type="text" placeholder="First Name">
                <?php if ($createUserErrors['firstname'][1] == 1) {
                    echo $createUserErrors['firstname'][0];
                } ?>

                <label  for="lastname">Enter Last Name</label>

                <input name = "lastname" class="form-control" id="EnterLastName" type="text" placeholder="Last Name">
<?php if ($createUserErrors['lastname'][1] == 1) {
    echo $createUserErrors['lastname'][0];
} ?>

                <label  for="email">Enter Email</label>

                <input name = "email" class="form-control" id="inputEmail" type="email" placeholder="Email">
                <?php if ($createUserErrors['email'][1] == 1) {
                    echo $createUserErrors['email'][0];
                } ?>

                <label  for="username">Enter Desired Username</label>

                <input name = "username" class="form-control" id="inputUsername" type="text" placeholder="Username">
                <?php if ($createUserErrors['username'][1] == 1) {
                    echo $createUserErrors['username'][0];
                } ?>


                <label  for="position">Enter Position</label>

                <input name = "position" class="form-control" id="inputPosition" type="text" placeholder="Position">
<?php if ($createUserErrors['position'][1] == 1) {
    echo $createUserErrors['position'][0];
} ?>


                <label  for="password1">Enter Password</label>

                <input name = "password1" class="form-control" id="inputPassword1" type="password" placeholder="Password">
<?php if ($createUserErrors['password'][1] == 1) {
    echo $createUserErrors['password'][0];
} ?>


                <label  for="password2">Re-enter Password</label>

                <input name = "password2" class="form-control" id="inputPassword2" type="password" placeholder="Password">

                <br/>
                <input class="btn btn-success btn-lg btn-block" type="button" name="register" value ="Register New User" id="registerButton">

            </div>
        </form>
    </div>
</div>

<div id="pwerror">

    <p>ALERT!</p>
    <div>Passwords do not match. Please try again.</div>
    <button class="btn btn-primary" id="closePwAlert">OK</button>


</div>











