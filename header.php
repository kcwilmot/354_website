<?php
  require_once 'Dao.php';
  require_once 'KLogger.php';
  session_start();

?>

<html>
<head>
    <link rel="stylesheet" href="style.css">
	<link href="favicon.png" type="image/png" rel="shortcut icon"/>
    <title>Bitey Cat Customs</title>

    <div id="header-nav">
        <div>
            Bitey Cat Customs<br>
            <a href="index.php"><img id="logo" src="img/logo.png" alt="Bitey Cat Customs"></a>
                 
        </div>
        <div>
            <li class="header-links">
                <?php
                  if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
                      echo "<a href=\"logout_handler.php\">Log Out</a>";
                  } else {
                  echo "<a href=\"login.php\"> Login </a>";
                  }
                ?>
            <li class="header-links">
                <a href="checkout.php"> Checkout </a>
            <li class="header-links">
                <a href="faq.php"> FAQ </a>
            </li>
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
