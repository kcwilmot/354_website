<!--header, shows name and email, change password link, address info, footer-->
<?php
  session_start();
  include_once("header.php");

  //Check if authenticated
  if ((isset($_SESSION['authenticated']) && !$_SESSION['authenticated']) || !isset($_SESSION['authenticated'])) {
    header("Location: login.php");
    exit();
  }

  $dao = new Dao();
  $logger = new KLogger ("log.txt" , KLogger::DEBUG);
  $logger->LogDebug("On MyAccount page for user [{$_SESSION['user']}].");
  $userInfo = $dao->get_userInfo($_SESSION['user']);
  $logger->LogDebug("User info return: " . print_r($userInfo,1));
  //$logger->LogDebug("Session: " . print_r($_SESSION,1));

  echo print_r($userInfo,1);
?>

<h1 id="my-account-header">My Account</h1>
Name:  username<br>
Email: email@emailservice.com

<a href="myaccount.php">Change Password?</a><br>
<div>
  Shipping Address:
  <div id="account-shipping-address">
    555 A Street Adress
    Apt 666
    City, ST 12345
  </div>
</div>

<?php
  include_once("footer.php");