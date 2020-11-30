<!--header, two rows - login words, two forms, checkbox, signin button, forgot password link, - new cust words, create acct link, footer-->
<?php
  include_once("header.php");
?>

<html>
  <body>
    <h1>Login</h1>

    <?php
      //Echo all errors generated from handler. Pretty much just the one error...
      foreach ($_SESSION['login_fail'] as $message) {
        echo "<div class='bad'>{$message}<span class='close_error'>X</span></div>";
      }
    ?>
    
    <form method="post" action="login_handler.php">
      <div>
        <label for="email">Enter your email:</label>
        <input type="text" name="email"/>
      </div>
      <div>
        <label for="password">Enter your Password:</label>
        <input type="password" name="password"/>
      </div>
      <div>
        <input type="submit" value="Login">
      </div>
    </form>

    New to the site?
    <a href="signup.php">Click here to create a new user</a>
  </body>
</html>
  
<?php
  include_once("footer.php");