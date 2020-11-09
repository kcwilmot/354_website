<?php
  include_once("header.php");
?>
  <html>
  <body>
    <h1>New User</h1>
    <?php
      if (isset($_SESSION['authenticated']) && !$_SESSION['authenticated']) {
        echo "<div class='bad'>Invalid Username or password</div>";
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