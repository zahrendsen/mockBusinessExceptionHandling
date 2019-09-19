<?php
/**********************************************
 * Date 9/12/2019   Name: Zach Ahrendsen       *
 * 9/12 created DB page for log in info        *
 * 9/13 added class and function for visitor   *
 *  contact delete                             *
 *********************************************/ 
class Database {
    private static $dsn = 'mysql:host=localhost;dbname=hopsdb';
    private static $username = 'root';
    private static $password = 'Pa$$w0rd';
    private static $db;

    private function __construct() {}

    public static function getDB () {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn,
                                     self::$username,
                                     self::$password);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                echo 'Database username/password or directory error!'.'<br>';
                echo $error_message;
                exit();
            }
        }
        return self::$db;
    }
}

class Employee {
    private $id;
    private $firstName;
    private $lastName;

    public function __construct($id, $firstName, $lastName) {
        $this->employeeID = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getID() {
        return $this->employeeID;
    }

    public function setID($value) {
        $this->id = $value;
    }

    public function getFirstName() {
        return $this->firstName;
    }
    public function getLastName() {
        return $this->lastName;
    }

    public function setFirstName($value) {
        $this->firstName = $value;
    }
    public function setLastName($value) {
        $this->lastName = $value;
    }
    
}


class EmployeeDB {
    function getEmployees() {
        $db = Database::getDB();
        $query = 'SELECT * FROM employee
                  ORDER BY employeeID';
        $statement = $db->prepare($query);
        $statement->execute();
        
        $employees = array();
        foreach ($statement as $row) {
            $employee = new Employee($row['employeeID'],
                                     $row['firstName'],
                                     $row['lastName']);
            $employees[] = $employee;
        }
        return $employees;
    }
}


class VisitorContact{
    function deleteVisitor()
    {
  
        $db = Database::getDB();
        $visitorID = filter_input(INPUT_POST, 'visitorID', FILTER_VALIDATE_INT);
        $query = 'DELETE FROM visitor
           WHERE visitorID = :visitorID';

        $statement = $db->prepare($query);
        $statement->bindValue(':visitorID', $visitorID);
        $statement->execute();
        $statement->closeCursor();
        header("Location: adminContact.php");

        
    }

function changeVisitorEmployee()
    {
        $db = Database::getDB();
        $visitorID = filter_input(INPUT_POST, 'visitorID', FILTER_VALIDATE_INT);
        $employeeID = filter_input(INPUT_POST, 'newEmployeeID', FILTER_VALIDATE_INT);
        $query = 'UPDATE visitor
        SET employeeID = :employeeID  WHERE visitorID = :visitorID';
    
        
        $statement = $db->prepare($query);
        $statement->bindValue(':visitorID', $visitorID);
        $statement->bindValue(':employeeID', $employeeID);
        $statement->execute();
        $statement->closeCursor();;
        header("Location: adminContact.php");
    }
}

 ?>