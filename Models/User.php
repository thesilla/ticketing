<?php

require_once('Database.php');

class User {

    private $userID;
    private $firstName;
    private $lastName;
    private $email;
    private $title;
    private $password;
    // database connection
    private $dbc;

// Constructor: create new Disposition object (template)
    function __construct($conn) {
        $this->dbc = $conn->getDbc();

        // all properties of object will be blank by default
        $this->userID = "";
        $this->firstName = "";
        $this->lastName = "";
        $this->email = "";
        $this->title = "";
        $this->password = "";
    }

// ************PHP does not allow for multiple constructors - Static Function Constructors below************
    // Constructor with arguments for every attribute - create object from scratch
    public static function create($conn, $userID, $firstName, $lastName, $email, $title, $password) {
        
        // set attributes that are blank by default to values
        $instance = new self($conn); // dbc is set in this step (see base constructor above)
        $instance->setUserID($userID);
        $instance->setFirstName($firstName);
        $instance->setLastName($lastName);
        $instance->setEmail($email);
        $instance->setTitle($title);
        $instance->setPassword($password);
        return $instance;
    }

    // Constructor which will instantiate a new object pulled from database given a User ID #
    // If user does not exist in database, creates returns a template User object with UserID as given id# and rest of attributes the default blank values
    // - Takes User ID # and a Database Connection object
  
    public static function createFromID($conn, $userID) {

        // set static database connection
        $dbc = $conn->getDbc();

        // sql to pull data if it exists
        $sql_getUserFromDB = "SELECT * FROM users where userID = '$userID'";
        

        // if query is able to be run
        if ($result = $dbc->query($sql_getUserFromDB)) {

            // sql to count number of results
            $sql_count = "SELECT COUNT(*) FROM users where userID = '$userID'";
            
            $resultCount = $dbc->query($sql_count);
            $number_of_rows = $resultCount->fetchColumn();
            
            //return $number_of_rows;
            if ($number_of_rows == 1) {


                $row = $result->fetch();
                $instance = new self($conn);
                $instance->setUserID($row['userID']);
                $instance->setFirstName($row['firstname']);
                $instance->setLastName($row['lastname']);
                $instance->setEmail($row['email']);
                $instance->setTitle($row['title']);
                $instance->setPassword($row['password']);
                return $instance;
            
                
            // if no results AKA no user in database with that UserID, create new blank user object with input userID and default blank attributes
            } else {

                $instance = new self($conn);
                $instance->setUserID($userID);
                return $instance;
            }
        } 
    }

    /*
      public function getConnection() {

      try {


      $this->dbc = new PDO("mysql:host=localhost;dbname=ticketing", "root", "");

      $this->dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      //echo "<div> Sucessfully connected to Database </div>";
      } catch (PDOException $e) {
      $output = 'Unable to connect to the database server.';

      echo "<div style='color:red;'>" . $e->getMessage() . "</div>";


      exit();
      }
      }



      public static function getStaticConnection(){

      // set database connection
      try {


      $dbc = new PDO("mysql:host=localhost;dbname=ticketing", "root", "");

      $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      return $dbc;

      //echo "<div> Sucessfully connected to Database </div>";
      } catch (PDOException $e) {
      $output = 'Unable to connect to the database server.';

      echo "<div style='color:red;'>" . $e->getMessage() . "</div>";


      exit();
      }

      }
     * 
     */

    // static method pulling all tickets - DB/SQL object argument
    // return an array of USER objects from the database, to keep all db logic in model side
    public static function getUsers($conn) {


        // set static database connection
        $dbc = $conn->getDbc();

        // for now (or permanently) directly include SQL here
        $sql_showUsers = "SELECT * FROM users";


        if ($result = $dbc->query($sql_showUsers)) {

            $users = [];

            while ($row = $result->fetch()) {

                $users[] = User::create($conn, $row['userID'], $row['firstname'], $row['lastname'], $row['email'], $row['title'], $row['password']);
            }
            // return users array
            return $users;
        } else {

            echo "<p> Could not run query </p>";
        }
    }

    // creates a new user
    public function add() {


        // get database connection
        //$md5password = md5($this->password);

        $sql_addUser = "INSERT INTO `users` (`userID`, `firstname`, `lastname`, `email`,`title`, `password`) VALUES ('$this->userID','$this->firstName', '$this->lastName','$this->email','$this->title','$this->password')";

        if ($this->dbc->query($sql_addUser)) {

            // generate alert banner
            echo "<div class='alert alert-dismissible alert-success'> User Successfully Added </div>";

            return true;


            // send an email to this user confirming the creation of account;
            
            $to = $this->email;
            $subject = 'the subject';
            $message = 'Hello' . $this->firstName . " " . $this->lastName . ",\r\nYou have been successfully registered for the Tile Market of Delaware Administrative Tools Portal! \r\n Visit your Account Management panel for information and to adjust account settings. \r\n Warm regards;\r\nThe Tile Market Management Team";
            $headers = 'From: admin@tilede.com' . "\r\n" .
                    'Reply-To: admin@tilede.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $message, $headers);
        } else {

            echo "<p> Could not run query </p>";
            return false;
        }
    }

    //  method takes a DB object and DELETES the user from the database
    public function delete() {

        // get database connection


        $sql_delete = "delete from users where userID = '$this->userID'";
        if ($this->dbc->query($sql_delete)) {

       
            echo "<p> User Successfully Deleted </p>";
            return true;
        } else {

            echo "<p> Could not run query </p>";
            return false;
        }
    }

//  method takes a DB object and edits the user and updates the database (IF OBJECT -> USER ID ACTUALLY EXISTS)
    public function update() {

        // get database connection



        $sql_update = "update users SET firstname = '$this->firstName', lastname = '$this->lastName', email = '$this->email', title = '$this->title', password = '$this->password' where userID = '$this->userID'";
        if ($this->dbc->query($sql_update)) {

            echo "<div class='alert alert-dismissible alert-success'> User Successfully Updated </div>";
            return true;
        } else {

            echo "<p> Could not run query </p>";
            return false;
        }
    }

    function getUserID() {
        return $this->userID;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getEmail() {
        return $this->email;
    }

    function getTitle() {
        return $this->title;
    }

    function getPassword() {
        return $this->password;
    }

    function setUserID($userID) {
        $this->userID = $userID;
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function getDbc() {
        return $this->dbc;
    }

    function setDbc($dbc) {
        $this->dbc = $dbc;
    }

}

?>