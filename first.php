<?php


class First
{



  private $host = "localhost";
  protected $username = "root";
  protected $password = "";
  public $database = "january_php";
  protected $conn;


  public function __construct()
  {
    $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
    if ($this->conn) {
      echo "Connected";
    } else {
      echo "Not connected";
    }
  }


  public $name = "Samuel";
  public $age = 20;
  public $school = "SQI";
  private $course = "Software Engineering";

  // public function getName()
  // {
  //   echo "Welcome to PHP";
  // }
}

$newClass = new First();
echo $newClass->name;

//$newClass->getName();

// class Second extends First
// {
//   public $username = "Samuel";

//   public function getAge()
//   {
//     echo $this->age;
//   }
// }

//$newSecond = new Second();
//$newSecond->getAge();


//new DbConnect();