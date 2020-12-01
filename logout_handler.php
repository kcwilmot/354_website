<?php
  session_start();

  //Log statement
  include_once 'KLogger.php';
  $logger = new KLogger ("log.txt" , KLogger::DEBUG);
  $logger->LogDebug("User [{$_SESSION['user']}] logged out.");
  
  //Destry the session and redirect to home page.
  session_destroy();
  header("Location: index.php");
  exit();