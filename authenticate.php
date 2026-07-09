<?php
session_start();
// $validUsername = 'Rahul';
// $validPassword = '12345';

if (
  !isset($_POST['username']) || !isset($_POST['password'])
) {
  header('Location: login.php');
  exit();
}

$username = htmlspecialchars(trim($_POST['username']));
$password = trim($_POST['password']);

if (empty($username)) {
  $_SESSION['error'] = 'Username is required';
  header('Location: login.php');
  exit();
}

if (empty($password)) {
  $_SESSION['error'] = 'Password is required';
  header('Location: login.php');
  exit();
}

if (isset($_SESSION['registeredUser'])) {
  if ($username === $_SESSION['registeredUser']['username'] && $password === $_SESSION['registeredUser']['password']) {
    $_SESSION['username'] = $username;
    header('Location: dashboard.php');
    exit();
  } else {
    $_SESSION['error'] = 'Invalid username or password';
    header('Location: login.php');
    exit();
  }
} else {
  $_SESSION['error'] = 'Invalid username or password';
  header('Location: login.php');
  exit();
}
?>