<?php

  require_once 'Dao.php';
  require_once 'User.php';

  $user = new User($_POST['email'],$_POST['password']);
  $dao = new Dao();
  $result = $dao->create_user($user);

  if(!$result){
    $logger->LogError("Failed to create a new user.");
    $_SESSION['fail'][] = "Failed to create a new user.";
    header("Location: https://polar-plains-93513.herokuapp.com/");
    exit();
  }