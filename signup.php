<?php
  include_once("header.php");
?>
  <html>
  <body>
    <h1>New User</h1>
    <?php
      //Tell user all issues with last attempt to create user.
      //Issue are bad email format and/or password is too short. (3 char min)
      foreach ($_SESSION['fail'] as $message) {
        echo "<div class='bad'>{$message}</div>";
      }
    ?>
    <form method="post" action="create_user_handler.php">
      <div>Email: <input type="text" name="email"/></div>
      <div>Password: <input type="password" name="password"/></div>
      <div><input type="submit" value="Create User"></div>
    </form>
  </body>
</html>

<?php
  include_once("footer.php");