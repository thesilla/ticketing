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
        // -->NOTE: Properties will be brought in from User object even if they do not match equivallant User attributes in database
        // ---->userExists() method below updates UserManager properies if the user exists in db
        $this->userID = $user->getUserID();
        $this->password = $user->getPassword();
        $this->fname = $user->getFirstName();
        $this->lname = $user->getLastName();
        $this->email = $user->getEmail();


        // set db connection for running checks - inject with User.
        $this->dbc = $user->getDbc();
    }

    // checks if user/password combination exists in database
    // if it does, TRUE is returned, and UserManager properties will update with existing attributes corresponding to user data in db
    // if not, FALSE is returned, and UserManager properties will remain as they were before
    public function userExists() {

        //$md5password = md5($this->password);
        //echo $md5password;
        
        
        
        $stmt = $this->dbc->prepare("SELECT COUNT(*) FROM users where userID = :userID1 AND password = :password1");

        $stmt->bindParam(':userID1', $this->userID);
        $stmt->bindParam(':password1', $this->password);
        
        $stmt->execute();
        
        //$stmt->fetch();
        
        //$stmt->store_result();
        
        
        
     
        // FIXME - num_rows not a function in PDO?
        $number_of_rows = $stmt->num_rows;

            // if 1 result, theres a match
            if ($number_of_rows == 1) {

                // create new database instance
                $db = new Database();

                // create new User object for verified existing User from database

                $dbUser = User::createFromID($db, $this->userID);

                // pass this User's properties into UserManager object's attributes
                // -- (This is for User PHP objects created with correct ID and Password but other attributes i.e first, last name do not match database)
                $this->fname = $dbUser->getFirstName();
                $this->lname = $dbUser->getLastName();
                $this->email = $dbUser->getEmail();

                return true;
            } else {

                return false;
            }
       
        
        
        
        
        
        
        
        
        
        
        
        // FIXME - THE BELOW WORKS - TRY TO GET THE ABOVE TO WORK
        
        /*
        
        
        $sql_userExists = "SELECT COUNT(*) FROM users where userID = '$this->userID' AND password = '$this->password'";


        if ($result = $this->dbc->query($sql_userExists)) {

            $number_of_rows = $result->fetchColumn();

            // if 1 result, theres a match
            if ($number_of_rows == 1) {

                // create new database instance
                $db = new Database();

                // create new User object for verified existing User from database

                $dbUser = User::createFromID($db, $this->userID);

                // pass this User's properties into UserManager object's attributes
                // -- (This is for User PHP objects created with correct ID and Password but other attributes i.e first, last name do not match database)
                $this->fname = $dbUser->getFirstName();
                $this->lname = $dbUser->getLastName();
                $this->email = $dbUser->getEmail();

                return true;
            } else {

                return false;
            }
        } else {

            return false;
        }*/
    }

    // checks if email already exists in database
    public function emailExists() {



        $sql_userExists = "SELECT COUNT(*) FROM users where email = '$this->email'";


        if ($result = $this->dbc->query($sql_userExists)) {

            $number_of_rows = $result->fetchColumn();
            if ($number_of_rows == 1) {

                return true;
            } else {

                return false;
            }
        }
        
         
    }

    // log in the input user
    // return true if successful, false if not
    public function login() {

        if ($this->userExists()) {


            // set relevant session variables
            session_start();


            if (empty($_SESSION['username']) && !isset($_SESSION['username'])) {

                $_SESSION['username'] = $this->userID;
            }


            if (empty($_SESSION['loggedin']) && !isset($_SESSION['loggedin'])) {

                $_SESSION['loggedin'] = 1;
            }

            if (empty($_SESSION['fname']) && !isset($_SESSION['fname'])) {

                $_SESSION['fname'] = $this->fname;
            }


            if (empty($_SESSION['lname']) && !isset($_SESSION['lname'])) {

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
    public static function isLoggedIn() {



        if (!empty($_SESSION['username']) && !empty($_SESSION['loggedin']) && isset($_SESSION['loggedin']) && isset($_SESSION['username'])) {




            if ($_SESSION['loggedin'] == 1) {


                return true;
            } else {


                return false;
            }
        } else {


            return false;
        }
    }

    public static function logout() {

        if (UserManager::isLoggedIn()) {

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
