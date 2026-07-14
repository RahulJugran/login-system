<?php
require_once 'config.php';
session_start();

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

$stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
  $_SESSION['username'] = $user['username'];
  header('Location: dashboard.php');
  exit();
}

$_SESSION['error'] = 'Invalid username or password';
header('Location: login.php');
exit();

?>