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


  //See if user exists in the database.
  $ret_val = $dao->get_User($user);

  
  //If the database returned a successful query.
  if ($ret_val) {
    $logger->LogDebug("User authenticated");

    //Set session variables so the user is logged in.
    $_SESSION['success'] = "Successfully logged in!";
    $_SESSION['authenticated'] = true;
    $_SESSION['user'] = $user->email;
    $_SESSION['authLevel'] = $dao->get_authLevel($user); 

    //$logger->LogDebug("Session: " . print_r($_SESSION,1));

    //Redirect to home page.
    header("Location: https://polar-plains-93513.herokuapp.com/index.php");
    exit();

    //User does not exist in the database.
  } else {
    $logger->LogDebug("Failed to get user");

    $_SESSION['authenticated'] = false;
    $_SESSION['fail'][] = "Username or password is incorrect.";

    //$logger->LogDebug("Session: " . print_r($_SESSION,1));

    header("Location: https://polar-plains-93513.herokuapp.com/login.php");
    exit();
  }
  
  //PHP crapped itself somewhere.
} catch (Exception $e) {

    $this->logger->LogFatal("ERROR IN LOGIN HANDLER: " . print_r($e, 1));

    $_SESSION['fail'][] = "Unkown error, unable to log in. Please try again.";

    header("Location: https://polar-plains-93513.herokuapp.com/login.php");
    exit();

}
  
