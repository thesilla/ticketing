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
    }

// ************PHP does not allow for multiple constructors - Static Function Constructors below************
    // Constructor with arguments for every attribute - create object from scratch
    public static function create($conn, $userID, $firstName, $lastName, $email, $title, $password) {

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
    // - Takes User ID # and a Database Connection object
    public static function createFromID($conn, $userID) {

        // set static database connection
        $dbc = $conn->getDbc();
        
        
        $sql_getUserFromDB = "SELECT * FROM users where userID = '$userID'";

        if ($result = $dbc->query($sql_getUserFromDB)) {

            $row = $result->fetch();
            $instance = new self($conn);
            $instance->setUserID($row['userID']);
            $instance->setFirstName($row['firstname']);
            $instance->setLastName($row['lastname']);
            $instance->setEmail($row['email']);
            $instance->setTitle($row['title']);
            $instance->setPassword($row['password']);
            return $instance;
        } else {

            echo "<p> Could not run query </p>";
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
    
        
        
        $sql_addUser = "INSERT INTO `users` (`userID`, `firstname`, `lastname`, `email`,`title`, `password`) VALUES ('$this->userID','$this->firstName', '$this->lastName','$this->email','$this->title','$this->password')";

        if ($this->dbc->query($sql_addUser)) {

            //TODO - DO SOMETHING MORE ELABORATE THAT INDICATES SUCESSFUL SUBMISSION FOR NOW JUST PRINT SUCCESS
            echo "<div class='alert alert-dismissible alert-success'> User Successfully Added </div>";
            return true;
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

            //TODO - DO SOMETHING MORE ELABORATE THAT INDICATES SUCESSFUL SUBMISSION FOR NOW JUST PRINT SUCCESS
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

            echo "<p> User Successfully Updated </p>";
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