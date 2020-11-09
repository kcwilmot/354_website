<?php
try{
  session_start();

  require_once 'Dao.php';
  require_once 'KLogger.php';
  require_once 'User.php';
  
  $dao = new Dao();
  $logger = new KLogger ("log.txt" , KLogger::DEBUG);
  $user = new User($_POST['email'], $_POST['password']);

  $_SESSION['username'] = $user->email;
  $_SESSION['success'] = array();
  $_SESSION['fail'] = array();

  $logger->LogDebug("Entered login_handler");
  $ret_val = $dao->get_User($user);
  $logger->LogDebug("Returned from get_user, count: [{$ret_val}]");
  $logger->LogDebug("Ret val is: " . gettype($ret_val));


  if ($ret_val > 0) {
    $logger->LogDebug("User authenticated");
    $_SESSION['authenticated'] = true;
    //print_r($_SESSION['authenticated']); 
    header("Location: https://polar-plains-93513.herokuapp.com/index.php");
    exit();
  } else {
    $logger->LogDebug("Failed to get user");
    $_SESSION['authenticated'] = false;
    header("Location: https://polar-plains-93513.herokuapp.com/login.php");
    exit();
  }
  
    $logger->LogDebug("After if-else");

} catch (Exception $e) {
      //echo print_r($e,1);
      $this->logger->LogFatal("If-Else ERROR: " . print_r($e, 1));

}
  
