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

  //Using PHP's regex for validating emails
  if(strlen($user->password) < 3) {
    $logger->LogDebug("Password too short.");
    $_SESSION['fail'][] = "Password must be at least 3 characters long.";
    header("Location: https://polar-plains-93513.herokuapp.com/signup.php");
    exit();
  }


  $email = $user->email;
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $logger->LogDebug("Invalid email format.");
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