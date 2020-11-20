<!--header, two rows - login words, two forms, checkbox, signin button, forgot password link, - new cust words, create acct link, footer-->
<?php
  include_once("header.php");
?>

<html>
  <body>
    <h1>Login</h1>

    <?php
      //Echo all errors generated from handler. Pretty much just the one error...
      foreach ($_SESSION['fail'] as $message) {
        echo "<div class='bad'>{$message}</div>";
      }
    ?>
    
    <form method="post" action="login_handler.php">
      <div>Email: <input type="text" name="email"/></div>
      <div>Password: <input type="password" name="password"/></div>
      <div><input type="submit" value="Login"></div>
    </form>

    New to the site? 
    <a href="signup.php">Click here to create a new user</a>
  </body>
</html>
  
<?php
  include_once("footer.php");