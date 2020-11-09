<?php
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
  //print_r($_POST);
  //echo "Get user result: \n" . print_r($dao->get_User($user));
  //print_r($user);
  //Get user's enter creds, validate, redirect to home if works
  //echo "Count: " . count($dao->get_User($user));
  $ret_val = $dao->get_User($user);
  $logger->LogDebug("Returned from get_user, count: [{$ret_val}]");


  if ($dao->get_User($user) > 0) {
    $logger->LogDebug("User authenticated: [{$user}]");
    $_SESSION['authenticated'] = true;
    //print_r($_SESSION['authenticated']); 
    header("Location: https://polar-plains-93513.herokuapp.com/index.php");
    exit();
  } else {
        $logger->LogDebug("Failed to get user: [{$user}]");
        header("Location: https://polar-plains-93513.herokuapp.com/login.php");
    exit();
  }
  
  /*
  else if (!$dao->user_Exists($user)) {
      //redirect back to login form with an error
      $logger->LogError("User does not exist: $user");
      $_SESSION['fail'][] = "Invalid Username or Password";
      header("Location: https://polar-plains-93513.herokuapp.com/login.php");
      exit();
  } else {
      $logger->LogError("Invalid Credentials: [{$user}]");
      header("Location: https://polar-plains-93513.herokuapp.com/login.php");
    exit();
  }
  */
  //header("Location: https://polar-plains-93513.herokuapp.com/login.php");
  //    exit();
  