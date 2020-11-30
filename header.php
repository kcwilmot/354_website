<?php
  require_once 'Dao.php';
  require_once 'KLogger.php';
  session_start();

?>

<html>
<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet"> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="scripts.js"></script>
    <link rel="stylesheet" href="style.css">

	<link href="img/favicon.png" type="image/png" rel="shortcut icon"/>
    <title>Bitey Cat Customs</title>

    <div id="header-nav">
        <div>
            Bitey Cat Customs<br>
            <a href="index.php"><img id="logo" src="img/logo.png" alt="Bitey Cat Customs"></a>
                 
        </div>
        <div>
            <li class="header-links">
                <?php
                  //If the user is logged in, display link to logout page.
                  if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
                      echo "<a href=\"logout_handler.php\">Log Out</a>";
                  //If the user is not logged in, display link to login page.
                  } else {
                  echo "<a href=\"login.php\"> Login </a>";
                  }
                ?>
            <li class="header-links">
                <a href="checkout.php"> Checkout </a>
            <!--<li class="header-links">
                <a href="meme\faq.php"> FAQ </a>
            </li>-->
        </div>
        <form>
            <label>Search</label>
            <input type="text" id="search-form">
        </form>
        <a href="earrings.php" class="header-shop-list">Earrings</a>
        <a href="customitem.php" class="header-shop-list">Custom Items</a>
        <a href="about.php" class="header-links">About</a>
    </div>
    <hr>
</head>
</html>
