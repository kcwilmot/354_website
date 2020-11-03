<?php
  session_start();
  
  require_once 'Dao.php';
  $dao = new Dao();

  require_once 'KLogger.php';
  $logger = new KLogger ("log.txt" , KLogger::DEBUG);
  
  $_SESSION['success'] = array();
  $_SESSION['fail'] = array();

  $logger->LogDebug("Entered login_handler");
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
    exit();
  }