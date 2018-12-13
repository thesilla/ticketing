<?php

/*
  Will use for user authentication, logins, etc.
 */
require_once('Database.php');
require_once('User.php');

class UserManager {

    private $userID;
    private $password;
    private $fname;
    private $lname;
    private $email;


    private $dbc;

    // Constructor: create new UserManager object 
    // takes user object, uses the User object's db connection
    public function __construct(User $user) {

        // set username and password properities for use in analysis
        $this->userID = $user->getUserID();
        $this->password = $user->getPassword();
        $this->fname = $user->getFirstName();
        $this->lname = $user->getLastName();
        $this->email = $user->getEmail();
        

        // set db connection for running checks - inject with User.
        $this->dbc = $user->getDbc();
    }
    // checks if user/password combination exists in database
    public function userExists() {



        $sql_userExists = "SELECT COUNT(*) FROM users where userID = '$this->userID' AND password = '$this->password'";


        if ($result = $this->dbc->query($sql_userExists)) {

            $number_of_rows = $result->fetchColumn();
            if($number_of_rows == 1){
                
                return true;
               
                
                
            } else {
                
                return false;
            }
            
        }
    }
    
    
    // checks if email already exists in database
        public function emailExists() {



        $sql_userExists = "SELECT COUNT(*) FROM users where email = '$this->email'";


        if ($result = $this->dbc->query($sql_userExists)) {

            $number_of_rows = $result->fetchColumn();
            if($number_of_rows == 1){
                
                return true;
               
                
                
            } else {
                
                return false;
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
            
            if(empty($_SESSION['fname']) && !isset($_SESSION['fname'])){
                
                $_SESSION['fname'] = $this->fname;
                
            }
            
            
            if(empty($_SESSION['lname']) && !isset($_SESSION['lname'])){
                
                $_SESSION['lname'] = $this->lname;
                
            }
            
            
            return true;
            
        } else {
            
            return false;
            
        }
        
        
    }
    
    // check if input user is logged in
    // returns true if so
    // returns false and redirects to login
    public static function isLoggedIn(){
        
        
        //echo "<div> Test of isLoggedIn() layer 0 </div>";
        if(!empty($_SESSION['username']) && !empty($_SESSION['loggedin']) && isset($_SESSION['loggedin']) && isset($_SESSION['username'])){
            
            //echo "<div> Test of isLoggedIn() layer 1 </div>";
            
            
            if($_SESSION['loggedin']==1 ){
                
                //echo "<div> Test of isLoggedIn() layer 2 - TRUE </div>";
                return true;
                
            } else {
                
                //echo "<div> Test of isLoggedIn() layer 2 - FALSE </div>";
                return false;
            }
            
        } else {
            
            
            return false;

            
        }
        
        
        
    }
    
    // this is static as lo
    public static function logout(){
        
        if(UserManager::isLoggedIn()){
            
            $_SESSION = array();
            session_destroy();
            return true;
            
        } else {
            
            
            return false;
        }
          
        
        
        
    }
    
    
  

    
    function getUserID() {
        return $this->userID;
    }

    function getPassword() {
        return $this->password;
    }

    function getFname() {
        return $this->fname;
    }

    function getLname() {
        return $this->lname;
    }

    function getEmail() {
        return $this->email;
    }

    function getDbc() {
        return $this->dbc;
    }

    function setUserID($userID) {
        $this->userID = $userID;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setFname($fname) {
        $this->fname = $fname;
    }

    function setLname($lname) {
        $this->lname = $lname;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setDbc($dbc) {
        $this->dbc = $dbc;
    }
    
    
}
