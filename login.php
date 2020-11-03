<!--header, two rows - login words, two forms, checkbox, signin button, forgot password link, - new cust words, create acct link, footer-->
<?php
  include_once("header.php");
  session_start();
?>

<html>
  <body>
    <h1>Login</h1>
    <form method="post" action="login_handler.php">
      <div>Email: <input type="text" name="email"/></div>
      <div>Password: <input type="password" name="password"/></div>
      <div><input type="submit" value="Login"></div>
    </form>
  </body>
</html>
  
<?php
  include_once("footer.php");