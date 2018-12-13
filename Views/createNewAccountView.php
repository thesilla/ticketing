<?php ?>


<!-- Master container -->
<div class="jumbotron">


    <div class="panel panel-primary">

        <form class="form-horizontal" action="adminController.php" method="post">
            <h1 style ="text-align: center" class="panel-title"> Create New Account </h1>
            <div class="panel-body">
        

                
                   <label  for="inputFirstName">Enter First Name</label>

                   <input name = "firstname" class="form-control" id="inputFirstName" type="text" placeholder="First Name">
                                    
                   <label  for="inputFirstName">Enter Last Name</label>

                    <input name = "lastname" class="form-control" id="EnterLastName" type="text" placeholder="Last Name">
                    
                
                    <label  for="inputEmail">Enter Email</label>

                    <input name = "email" class="form-control" id="inputEmail" type="text" placeholder="Email">

                    <label  for="inputPassword">Enter Password</label>

                    <input name = "password1" class="form-control" id="inputPassword" type="password" placeholder="Password">

                    <label  for="inputPassword">Re-enter Password</label>

                    <input name = "password2" class="form-control" id="inputPassword" type="password" placeholder="Password">

                    <br/>
                    <input class="btn btn-success btn-lg btn-block" type="submit" name="register" value ="Register New User">
     
                </div>
        </form>
    </div>
</div>








