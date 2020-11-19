<?php
require_once 'KLogger.php';
require_once 'User.php';

class Dao {

  private $host = "us-cdbr-east-02.cleardb.com";
  private $db = "heroku_2d1a17904437190";
  private $user = "b53457492fa1cc";
  private $pass = "47f5c214";
  private $logger;

  public function __construct () 
  {
    $this->logger = new KLogger ("log.txt" , KLogger::DEBUG);
  }


  public function getConnection () 
  {
    $this->logger->LogDebug("Getting a connection");
    try {
      $dsn = "mysql:dbname=$this->db;host=$this->host";
      $conn = new PDO($dsn, $this->user, $this->pass);
      $this->logger->LogDebug("Established DB connection");
      return $conn;
    } catch (Exception $e) {
      $this->logger->LogFatal("FAILED TO ESTABLISH DB CONNECTION: " . print_r($e, 1));
      exit;
    }
  }


  public function create_user($user)
  {
    $this->logger->LogInfo("Creating a new user [{$user->email}] as a standard user.");

    $conn = $this->getConnection();
    $saveQuery = "insert into users (email, password, authlevel) values (:email, :password, 0)";
    $q = $conn->prepare($saveQuery);
    $q->bindParam(":email", $user->email);
    $q->bindParam(":password", $user->password);
    $ret = $q->execute();

    $this->logger->LogDebug("Create User query execution result: " . print_r($ret));
    return $ret;

  } 
  
  public function get_user($user)
  {
    $this->logger->LogDebug("Checking if user [{$user->email}] exists.");
    
    $conn = $this->getConnection();
    $saveQuery = "select email,password from users where email = :email and password = :password";    
    $q = $conn->prepare($saveQuery);
    $q->bindParam(":email", $user->email);
    $q->bindParam(":password", $user->password);
    $this->logger->LogDebug("Checking for user, query string: " . print_r($q,1));
    $tmp = $q->execute();
    $this->logger->LogDebug("Query execute return:" . $tmp);
    $ret = $q->fetchAll();
    
    $this->logger->LogDebug("Return val from fetchAll(): " . print_r($ret,1));
    $this->logger->LogDebug("Email check value: " . ($ret[0]['email'] == $user->email));
    $this->logger->LogDebug("Password check value: " . ($ret[0]['password'] == $user->password));

    if($ret[0]['email'] == $user->email && $ret[0]['password'] == $user->password) {
      return true;
    } else {
      return false;
    }
  }

  public function get_authLevel($user)
  {
    $this->logger->LogDebug("Checking if [{$user->email}] is an admin.");
    
    $conn = $this->getConnection();
    $saveQuery = "select authlevel from users where email = :email and password = :password";    
    $q = $conn->prepare($saveQuery);
    $q->bindParam(":email", $user->email);
    $q->bindParam(":password", $user->password);
    $q->execute();
    $ret = $q->fetchAll();

    $this->logger->LogDebug("Return array from fetchAll(): " . print_r($ret,1));
    $this->logger->LogDebug("Return val of \$ret[0]['authlevel']: " . print_r($ret[0]['authlevel'],1));

    if($ret[0]['authlevel'] == 1) {
      $this->logger->LogDebug("User [{$user->email}] is an admin.");
      return 1;
    } else {
      $this->logger->LogDebug("User [{$user->email}] is a std user.");
      return 0;
    }
  }


  public function get_userInfo($email)
  {
    $this->logger->LogDebug("Getting user info for [{$email}].");
    
    $conn = $this->getConnection();
    $saveQuery = "select * from users where email = :email";    
    $q = $conn->prepare($saveQuery);
    $q->bindParam(":email", $email);
    $q->execute();
    $ret = $q->fetchAll();

    $this->logger->LogDebug("Return array from get_userInfo(): " . print_r($ret,1));
    return $ret;
  }


  public function update_user($info,$email)
  {
    $this->logger->LogDebug("In update user info DAO function, info array: " . print_r($info,1));
    $this->logger->LogDebug("Attempting to update user information for [{$email}].");
    
    $conn = $this->getConnection();
    $saveQuery = "update users set fname = :fname, lname = :lname, phone = :phone, address = :address where email = :email";    
    $q = $conn->prepare($saveQuery);
    $q->bindParam(":email", $email);
    $q->bindParam(":fname", $info['firstname']);
    $q->bindParam(":lname", $info['lastname']);
    $q->bindParam(":phone", $info['phone']);
    $q->bindParam(":address", $info['address']);
    $this->logger->LogDebug("Attempting to execute update stmt");

    $tmp = $q->execute();
    $this->logger->LogDebug("Result of execute(): " . print_r($tmp,1));

    $ret = $q->fetchAll();
    $this->logger->LogDebug("Return array from update: " . print_r($ret,1));

    return $tmp;
  }





///////////////////////////////////////////////////////////////////////////////////////////

  //Kennington's Example Functions
  public function getComments () {
    $conn = $this->getConnection();
    return $conn->query("select comment_id, comment, date_entered from comment order by date_entered desc", PDO::FETCH_ASSOC);
  }

  public function addComment ($comment) {
    $this->logger->LogInfo("adding a comment [{$comment}]");
    $conn = $this->getConnection();
    $saveQuery = "insert into comment (comment, user_id) values (:comment, 1)";
    $q = $conn->prepare($saveQuery);
    $q->bindParam(":comment", $comment);
    $q->execute();
  }

  public function deleteComment ($id) {
    $conn = $this->getConnection();
    $this->logger->LogInfo("deleting a comment [{$id}]");
    $deleteQuery = "delete from comment where comment_id = :comment_id";
    $q = $conn->prepare($deleteQuery);
    $q->bindParam(":comment_id", $id);
    $q->execute();
  }

}
