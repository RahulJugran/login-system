<?php
require_once __DIR__ . '/includes/functions.php';
session_start();
if (isset($_SESSION['username'])) {
  redirect('dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registeration Form</title>
</head>
<body>
  <form action="auth/register_process.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username">
    <br>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password">
    <br>
    <br>
    <label for="conPassword">Confirm Password:</label>
    <input type="password" id="conPassword" name="conPassword">
    <br>
    <br>
    <button type="submit">Register</button>
    <p>Already have an account? <a href="login.php">Log in</a></p>
  </form>
  <?php
  if (isset($_SESSION['error'])) {
    echo '<p>' . $_SESSION['error'] . '</p>';
    unset($_SESSION['error']);
  }
  ?>
</body>
</html>