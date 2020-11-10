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

  //Using PHP's regex for validating emails
  
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
    exit();
  } else {
    $logger->LogDebug("New User Created!.");
    $_SESSION['authenticated'] = true;
    $_SESSION['authlevel'] = 0;
    $_SESSION['user'] = $user->email;
    header("Location: https://polar-plains-93513.herokuapp.com/myaccount.php");
    exit();

  }

} catch (Exception $e){

}