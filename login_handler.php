<?php
try{
  session_start();

  require_once 'Dao.php';
  require_once 'KLogger.php';
  require_once 'User.php';
  
  $dao = new Dao();
  $logger = new KLogger ("log.txt" , KLogger::DEBUG);
  $user = new User($_POST['email'], $_POST['password']);

  $_SESSION['success'] = array();
  $_SESSION['fail'] = array();

  $logger->LogDebug("Entered login_handler");
  $ret_val = $dao->get_User($user);

  if ($ret_val > 0) {
    $logger->LogDebug("User authenticated");

    $_SESSION['authenticated'] = true;
    $_SESSION['user'] = $user->email;
    $_SESSION['authLevel'] = $dao->get_authLevel($user); 

    header("Location: https://polar-plains-93513.herokuapp.com/index.php");
    $logger->LogDebug("Session: " . print_r($_SESSION,1));

    exit();

  } else {
    $logger->LogDebug("Failed to get user");

    $_SESSION['authenticated'] = false;
    $_SESSION['fail'][] = "Username or password is incorrect.";

    header("Location: https://polar-plains-93513.herokuapp.com/login.php");
    $logger->LogDebug("Session: " . print_r($_SESSION,1));

    exit();
  }
  
} catch (Exception $e) {

    $this->logger->LogFatal("ERROR IN LOGIN HANDLER: " . print_r($e, 1));

    $_SESSION['fail'][] = "Unkown error, unable to log in. Please try again.";

    header("Location: https://polar-plains-93513.herokuapp.com/login.php");

    exit();

}
  
