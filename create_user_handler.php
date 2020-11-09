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

  $email = $user->email;
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $logger->LogDebug("Invalid email format.");
    $_SESSION['fail'][] = "Not a valid email.";
    header("Location: https://polar-plains-93513.herokuapp.com/signup.php");
    exit();
  }
  
  $dao = new Dao();
  $result = $dao->create_user($user);

  if(!$result){
    $logger->LogError("Failed to create a new user.");
    $_SESSION['fail'][] = "Failed to create a new user.";
    header("Location: https://polar-plains-93513.herokuapp.com/");
    exit();
  }

} catch (Exception $e){

}