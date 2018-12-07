<?php

/*
  Will use for user authentication, logins, etc.
 */
require_once('Database.php');
require_once('User.php');

class UserManager {

    private $userID;
    private $password;
    private $dbc;

    // Constructor: create new UserManager object 
    // takes user object, uses the User object's db connection
    public function __construct(User $user) {

        // set username and password properities for use in analysis
        $this->userID = $user->getUserID();
        $this->password = $user->getPassword();

        // set db connection for running checks - inject with User.
        $this->dbc = $user->getDbc();
    }

    public function userExists() {



        $sql_userExists = "SELECT COUNT(*) FROM users where userID = '$this->userID' AND password = '$this->password'";


        if ($result = $this->dbc->query($sql_userExists)) {

            $number_of_rows = $result->fetchColumn();
            if($number_of_rows == 1){
                
                return true;
                //
                
                
            }
            
        }
    }
    
    // log in the input user
    // return true if successful, false if not
    public function login(){
        
        if($this->userExists()){
            
            session_start();
            
            
            if(empty($_SESSION['username']) && !isset($_SESSION['username'])){
                
                $_SESSION['username'] = $this->userID;
                
            }
            
            
            if(empty($_SESSION['loggedin']) && !isset($_SESSION['loggedin'])){
                
                $_SESSION['loggedin'] = 1;
                
            }
            
            return true;
            
        } else {
            
            session_destroy();
            return false;
            
        }
        
        
    }
    
    // check if input user is logged in
    // returns true if so
    // returns false and redirects to login
    public static function isLoggedIn(){
        
        if(!empty($_SESSION['username']) && !empty($_SESSION['loggedin']) && isset($_SESSION['loggedin']) && isset($_SESSION['username'])){
            
            
            
            if($_SESSION['loggedin']==1 ){
                
                return true;
                
            } else {
                
                return false;
            }
            
        } else {
            
            
            return false;

            
        }
        
        
        
    }

}
