

<?php


require_once('database.php');
class Employee {

    private $id;
    private $firstName;
    private $lastName;
    private $email;
        
    // database connection
    private $dbc;
 
// Constructor: create new Disposition object (template)
    function __construct($conn) {
        $this->dbc = $conn->getdbc();
    }

// ************PHP does not allow for multiple constructors - Static Function Constructors below************
    // Constructor with arguments for every attribute - create object from scratch
    public static function create($conn, $id, $firstName, $lastName, $email) {

        $instance = new self($conn);
        $instance->setId($id);
        $instance->setFirstName($firstName);
        $instance->setLastName($lastName);
        $instance->setEmail($email);
        return $instance;
    }

    // Constructor which will instantiate a new object pulled from database given a User ID #
    // - Takes User ID # and a database Connection object
    public static function createFromID($conn, $id) {

        // set static database connection
        $dbc = $conn->getdbc();
        
        
        $sql_getEmployeeFromdb = "SELECT * FROM employees where id = '$id'";

        if ($result = $dbc->query($sql_getEmployeeFromdb)) {

            $row = $result->fetch();
            $instance = new self($conn);
            $instance->setId($row['id']);
            $instance->setFirstName($row['fname']);
            $instance->setLastName($row['lname']);
            $instance->setEmail($row['email']);

            return $instance;
        } else {

            echo "<p> Could not run query </p>";
        }
    }
    

    // static method pulling all tickets - db/SQL object argument
    // return an array of USER objects from the database, to keep all db logic in model side
    public static function getEmployees($conn) {

        
        // set static database connection
        $dbc = $conn->getdbc();

        // for now (or permanently) directly include SQL here
        $sql_showEmployees = "SELECT * FROM employees";


        if ($result = $dbc->query($sql_showEmployees)) {

            $employees = [];

            while ($row = $result->fetch()) {

                $employees[] = Employee::create($conn, $row['id'], $row['fname'], $row['lname'], $row['email']);
            }
            // return users array
            return $employees;
        } else {

            echo "<p> Could not run query </p>";
        }
    }

    public function add() {

        
        // get database connection

        
        
        $sql_addEmployee = "INSERT INTO `employees` (`id`, `fname`, `lname`, `email`) VALUES ('$this->id','$this->firstName', '$this->lastName','$this->email')";

        if ($this->dbc->query($sql_addEmployee)) {

            //TODO - DO SOMETHING MORE ELABORATE THAT INDICATES SUCESSFUL SUBMISSION FOR NOW JUST PRINT SUCCESS
            echo "<p> Employee Successfully Added </p>";
            return true;
        } else {

            echo "<p> Could not run query </p>";
            return false;
        }
    }

    //  method takes a db object and DELETES the user from the database
    public function delete() {

        // get database connection

        
        $sql_delete = "delete from employees where id = '$this->id'";
        if ($this->dbc->query($sql_delete)) {

            //TODO - DO SOMETHING MORE ELABORATE THAT INDICATES SUCESSFUL SUBMISSION FOR NOW JUST PRINT SUCCESS
            echo "<p> Employee Successfully Deleted </p>";
            return true;
        } else {

            echo "<p> Could not run query </p>";
            return false;
        }
    }

//  method takes a db object and edits the user and updates the database (IF OBJECT -> USER ID ACTUALLY EXISTS)
    public function update() {

        // get database connection

        
        
        $sql_update = "update employees SET fname = '$this->firstName', lname = '$this->lastName', email = '$this->email' where id = '$this->id'";
        if ($this->dbc->query($sql_update)) {

            echo "<p> User Successfully Updated </p>";
            return true;
        } else {

            echo "<p> Could not run query </p>";
            return false;
        }
    }

    
    
    function getId() {
        return $this->id;
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

    function setId($id) {
        $this->id = $id;
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
    
    
    
    
    
}

?>
