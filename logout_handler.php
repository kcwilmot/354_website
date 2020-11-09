<?php
  session_start();
  include_once 'KLogger.php';
  $logger = new KLogger ("log.txt" , KLogger::DEBUG);
  $logger->LogDebug("User [" . $_SESSION['user'] . "] logged out.");
  session_destroy();
  header("Location: https://polar-plains-93513.herokuapp.com/index.php");
  exit();