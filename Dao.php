<?php
require_once 'KLogger.php';

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
      $conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
      $this->logger->LogFatal("Established DB connection");
      return $conn;
    } catch (Exception $e) {
      //echo print_r($e,1);
      $this->logger->LogFatal("FAILED TO ESTABLISH DB CONNECTION: " . print_r($e, 1));
      exit;
    }
  }


  public function create_user($user)
  {
    $this->logger->LogInfo("Creating a new user [{$user->email}]");
    $conn = $this->getConnection();
    $saveQuery = "insert into users (email, password) values (:email, :password)";
    $q = $conn->prepare($saveQuery);
    $q->bindParam(":comment", $comment);
    $q->bindParam(":password", $password);
    return $q->execute();

  } 
  
  public function get_user($user)
  {
      $this->logger->LogDebug("Getting matching user count from db: [{$user->email}]");
    $conn = $this->getConnection();
    $saveQuery = "select * from users where email = $user->email and password = $user->password";
    $q = $conn->prepare($saveQuery);
    //$q->bindParam(":email", $user->email);
    //$q->bindParam(":password", $user->password);
    $this->logger->LogDebug("Query String " . $q);    
    $q->execute();
    $ret = $q->fetchAll(PDO::FETCH_ASSOC);
    $this->logger->LogDebug("Number of rows returned from get_user: " . count($ret));
    //echo print_r($result) . "\n";
    return count($ret);

  }

  public function user_Exists($user)
  {
    $this->logger->LogDebug("Checking if user exists: [{$user->email}]");
    $conn = $this->getConnection();
    $getUserQuery = "select count(*) from users where email = ':email'";
    $q = $conn->prepare($getUserQuery);
    $q->bindParam(":email", $user->email);
    $ret = $q->execute();
    if($ret->count() > 0) {
        return true;
    } else {
        return false;
    }
  }


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
