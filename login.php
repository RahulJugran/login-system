<?php
session_start();

if (isset($_SESSION['username'])) {
  header('Location: dashboard.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGIN</title>
</head>
<body>
  <?php
  if (isset($_SESSION['registeredUser'])) {
    echo '<h2>' . 'Registered User:' . $_SESSION['registeredUser']['username'] . '</h2>';
  }
  ?>
  <form action="authenticate.php" method="post">
    <label for="username">User Name:</label>
    <input type="text" id="username" name="username" placeholder="Enter username">
    <br>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" placeholder="Enter password">
    <br>
    <br>
    <button type="submit">Login</button>
    <p>Don't have an account? <a href="register.php">Sign up</a></p>
  </form>
  <?php
  // session_start();
  if (isset($_SESSION['success'])) {
    echo '<p>' . $_SESSION['success'] . '</p>';
    unset($_SESSION['success']);
  }

  if (isset($_SESSION['error'])) {
    echo '<p>' . $_SESSION['error'] . '</p>';
    unset($_SESSION['error']);
  }
  ?>
</body>
</html>