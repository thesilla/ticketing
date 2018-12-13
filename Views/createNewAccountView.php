<?php ?>


<!-- Master container -->
<div class="jumbotron">


    <div id="createUserContainer" class="jumbotron">

        <form class="form-horizontal" action="adminController.php" method="post">
            <h1 style ="text-align: center" class="panel-title"> Create New Account </h1>
            <div class="panel-body">
        

                
                   <label  for="firstname">Enter First Name</label>

                   <input name = "firstname" class="form-control" id="inputFirstName" type="text" placeholder="First Name">
                                    
                   <label  for="lastname">Enter Last Name</label>

                    <input name = "lastname" class="form-control" id="EnterLastName" type="text" placeholder="Last Name">
                    
                
                    <label  for="email">Enter Email</label>

                    <input name = "email" class="form-control" id="inputEmail" type="email" placeholder="Email">

                    <label  for="username">Enter Desired Username</label>

                    <input name = "username" class="form-control" id="inputUsername" type="text" placeholder="Username">
                    
                    
                    <label  for="position">Enter Position</label>

                    <input name = "position" class="form-control" id="inputPosition" type="text" placeholder="Position">
                    
                    
                    <label  for="password1">Enter Password</label>

                    <input name = "password1" class="form-control" id="inputPassword" type="password" placeholder="Password">

                    <label  for="password2">Re-enter Password</label>

                    <input name = "password2" class="form-control" id="inputPassword" type="password" placeholder="Password">

                    <br/>
                    <input class="btn btn-success btn-lg btn-block" type="submit" name="register" value ="Register New User">
     
                </div>
        </form>
    </div>
</div>








