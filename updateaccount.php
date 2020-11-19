<?php
  include_once("header.php");

  $dao = new Dao();
  $logger = new KLogger("log.txt" , KLogger::DEBUG);
  $logger->LogDebug("On Update Account page for user [{$_SESSION['user']}].");

  //Check if authenticated
  if ((isset($_SESSION['authenticated']) && !$_SESSION['authenticated']) || !isset($_SESSION['authenticated'])) {
    header("Location: login.php");
    exit();
  }

  
  $userInfo = $dao->get_userInfo($_SESSION['user']);
  $logger->LogDebug("User info return: " . print_r($userInfo,1));
  
  ?>

  <h1 id="update-account-header">Update Account Information</h1>
  <form method="post" action="update_user_handler.php">
      <!--<div>Email: <input value="<?php $userInfo[0]['email']?>" type="text" name="email"/></div>
      <div>Password: <input value="<?php $userInfo[0]['password']?>" type="password" name="password"/></div> -->
      <div>First Name: <input value="<?php $userInfo[0]['fname']?>" type="text" name="firstname"/></div>
      <div>Last Name: <input value="<?php $userInfo[0]['lname']?>" type="text" name="lastname"/></div>
      <div>Phone Number: <input value="<?php $userInfo[0]['phone']?>" type="text" name="phone"/></div>
      <div>Address: <input value="<?php $userInfo[0]['address']?>" type="text" name="address"/></div>
      <div><input type="submit" value="Update User Information"></div>
    </form>


<?php


  include_once("footer.php");

