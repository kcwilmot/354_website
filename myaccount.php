<!--header, shows name and email, change password link, address info, footer-->
<?php
  include_once("header.php");

  $dao = new Dao();
  $logger = new KLogger("log.txt" , KLogger::DEBUG);
  $logger->LogDebug("On MyAccount page for user [{$_SESSION['user']}].");

  //Check if authenticated
  if ((isset($_SESSION['authenticated']) && !$_SESSION['authenticated']) || !isset($_SESSION['authenticated'])) {
    header("Location: login.php");
    exit();
  }

  //Get all user info to display.
  $userInfo = $dao->get_userInfo($_SESSION['user']);
  $logger->LogDebug("User info return: " . print_r($userInfo,1));


  //Display saved user info. Escape characters to prevent HTML exploits.
  echo "<h1 id=\"my-account-header\">My Account</h1>";
  echo "Email: " . htmlspecialchars($userInfo[0]['email']) . "<br>";
  echo "First name: " . htmlspecialchars($userInfo[0]['fname']) . "<br>";
  echo "Last name: " . htmlspecialchars($userInfo[0]['lname']) . "<br>";
  echo "Phone: " . htmlspecialchars($userInfo[0]['phone']) . "<br>";
  echo "Address: " . htmlspecialchars($userInfo[0]['address']) . "<br>";
  echo "<br><a href=\"updateaccount.php\">Click here to update user information.</a>";
  /*
  // TODO: set up a loop to print user info.
  for($i = 3; $i <= 12; $i++) {
    if($i != 5) {

    }
  }
*/

//<a href="myaccount.php">Change Password?</a><br>


include_once("footer.php");
