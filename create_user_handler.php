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
  $_SESSION['fail'] = array();


  //Make sure password is at least 3 characters long.
  if(strlen($user->password) < 3) {
    $logger->LogDebug("Password too short for new user [{$email}].");
    $_SESSION['fail'][] = "Password must be at least 3 characters long.";
    header("Location: https://polar-plains-93513.herokuapp.com/signup.php");
    exit();
  }

  //Using PHP's regex for validating emails
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $logger->LogDebug("Invalid email format. [{$email}] is not a true email.");
    $_SESSION['fail'][] = "Please enter a valid email.";
    header("Location: https://polar-plains-93513.herokuapp.com/signup.php");
    exit();
  }

  $result = $dao->create_user($user);

  if(!$result){
    $logger->LogError("Failed to create a new user.");

    $_SESSION['fail'][] = "User already exists.";
    header("Location: https://polar-plains-93513.herokuapp.com/signup.php");
    $logger->LogDebug("Session: " . print_r($_SESSION,1));
    
    exit();

  } else {
    $logger->LogDebug("New User Created!.");

    $_SESSION['user'] = $user->email;
    $_SESSION['authenticated'] = true;
    $_SESSION['authLevel'] = $dao->get_authLevel($user);
    header("Location: https://polar-plains-93513.herokuapp.com/myaccount.php");
    $logger->LogDebug("Session: " . print_r($_SESSION,1));

    exit();

  }

} catch (Exception $e){

}