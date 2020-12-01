<?php
try{
  session_start();

  require_once 'Dao.php';
  require_once 'KLogger.php';
  require_once 'User.php';
  
  $dao = new Dao();
  $logger = new KLogger ("log.txt" , KLogger::DEBUG);
  $user = new User($_POST['email'], $_POST['password']);
  $email = $user->email;

  $_SESSION['success'] = array();
  $_SESSION['create_user_fail'] = array();

  //Using PHP's regex for validating emails
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $logger->LogDebug("Invalid email format. [{$email}] is not a true email.");
    $_SESSION['create_user_fail'][] = "Please enter a valid email.";
  }

  //Make sure password is at least 3 characters long.
  if(strlen($user->password) < 3) {
    $logger->LogDebug("Password too short for new user [{$email}].");
    $_SESSION['create_user_fail'][] = "Password must be at least 3 characters long.";
  }
  
  //If errors were generated above, redirect back to create user page.
  if(count($_SESSION['create_user_fail']) > 0) {
    header("Location: signup.php");
    exit();
  }

  //New use info appears valid, attempt to send user info to db.
  $result = $dao->create_user($user);

  //Database query failed, user exists.
  if(!$result){
    $logger->LogError("Failed to create a new user.");

    $_SESSION['create_user_fail'][] = "User already exists.";
    header("Location: signup.php");
    //$logger->LogDebug("Session: " . print_r($_SESSION,1));
    
    exit();

    //New user was created, set session variables so new user is logged in.
  } else {
    $logger->LogDebug("New User Created!.");

    $_SESSION['user'] = $user->email;
    $_SESSION['authenticated'] = true;
    $_SESSION['authLevel'] = $dao->get_authLevel($user);
    header("Location: myaccount.php");
    $logger->LogDebug("Session: " . print_r($_SESSION,1));

    exit();

  }

  //Ruh roh Raggy. 
} catch (Exception $e){
  $logger->LogFatal("Fatal exception was caught. Session: " . print_r($_SESSION,1));

}