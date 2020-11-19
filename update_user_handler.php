<?php
try{
  session_start();

  require_once 'Dao.php';
  require_once 'KLogger.php';
  require_once 'User.php';
  
  $dao = new Dao();
  $logger = new KLogger ("log.txt" , KLogger::DEBUG);
  //$user = new User($_POST['email'], $_POST['password']);

  $_SESSION['success'] = array();
  $_SESSION['fail'] = array();
  $_SESSION['update_form'] = array();

  //Using PHP's regex for validating emails
  $logger->LogDebug("In update_user_handler.");
  $logger->LogDebug("Update user info post: " . print_r($_POST,1));


  //Check that the new email is a valid email
  $email = $_SESSION['email'];
//   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     $logger->LogDebug("Invalid email format.");
//     $_SESSION['fail'][] = "Please enter a valid email.";
//     header("Location: https://polar-plains-93513.herokuapp.com/updateaccount.php");
//     exit();
//   } 

$tmp = clone $_POST;
  //Check that all inputs are less than 50 characters (sql table constraint).
  foreach($_POST as $var){
    if (strlen($var) > 50){
        $_SESSION['fail'][] = "{$var} is too long, 50 character limit.";
        $logger->LogDebug("{$var} is too long, 50 character limit.");

    }
  }

  //If any fields too long, return to update page.
  if(count($_SESSION['fail']) > 0) {
      $_SESSION['update_form'] = $_POST;
    header("Location: https://polar-plains-93513.herokuapp.com/updateaccount.php");
    exit();
  }

  //Try to update user in the database.
//   $_POST['email'] = $_SESSION['email'];
  $result = $dao->update_user($tmp,$_SESSION['email']);

  //If udate failed, oops. Back to update page.
  if(!$result){
    $logger->LogError("Failed to update user info.");

    $_SESSION['fail'][] = "Fatal error, could not update user information.";
    header("Location: https://polar-plains-93513.herokuapp.com/updateaccount.php");
    $logger->LogDebug("Error in update user. Session: " . print_r($_SESSION,1));
    
    exit();


  } else {
    $logger->LogDebug("User information updated!.");

    $_SESSION['user'] = $email;
    $_SESSION['authenticated'] = true;
    //$_SESSION['authLevel'] = $dao->get_authLevel($user);
    header("Location: https://polar-plains-93513.herokuapp.com/myaccount.php");
    $logger->LogDebug("End up update user. Session: " . print_r($_SESSION,1));

    exit();

  }

} catch (Exception $e){
    $logger->LogDebug("Fatal error in update user. Error: " . print_r($e,1));

}