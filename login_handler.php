<?php
  session_start();
  
  require_once 'Dao.php';
<<<<<<< HEAD
  require_once 'KLogger.php';

  $dao = new Dao();
  $logger = new KLogger ("log.txt" , KLogger::DEBUG);

  $user = new User($_POST['email'], $_POST['password']);
  $_SESSION['username'] = $user->email;
=======
  $dao = new Dao();

  require_once 'KLogger.php';
  $logger = new KLogger ("log.txt" , KLogger::DEBUG);
>>>>>>> 068bb9f1844039fff43f6c9d5f667ca439106f2a
  
  $_SESSION['success'] = array();
  $_SESSION['fail'] = array();

  $logger->LogDebug("Entered login_handler");
<<<<<<< HEAD
  echo "Entered Login Handler";

  //Get user's enter creds, validate, redirect to home if works
  if ($dao->get_User($user) > 0) {
    $logger->LogDebug("User authenticated: [{$user}]");
    $_SESSION['authenticated'] = true;
    header("Location: index.php");
    exit();
  } else if (!$dao->user_Exists($user)) {
      //redirect back to login form with an error
      $logger->LogError("User does not exist: $user");
      $_SESSION['fail'][] = "Invalid Username or Password";
      header("Location: https://polar-plains-93513.herokuapp.com/login.php");
      exit();
  } else {
      $logger->LogError("Invalid Credentials: [{$user}]");
      header("Location: https://polar-plains-93513.herokuapp.com/login.php");
=======
  //Get user's enter creds, validate, redirect to home if works
  if ($dao->userExists($_POST['email'], $_POST['password'])) {
    $_SESSION['authenticated'] = true;
    header("Location: https://polar-plains-93513.herokuapp.com/index.php");
    exit();
  } else {
    //redirect back to login form with an error
    $logger->LogError("User entered invalid username or password");
    $_SESSION['fail'][] = "Invalud Username or Password";
    header("Location: https://polar-plains-93513.herokuapp.com/login.php");
>>>>>>> 068bb9f1844039fff43f6c9d5f667ca439106f2a
    exit();
  }