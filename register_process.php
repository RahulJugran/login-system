<?php
require_once 'config.php';
session_start();

if (
  !isset($_POST['username']) ||
  !isset($_POST['password']) ||
  !isset($_POST['conPassword'])
) {
  header('Location: register.php');
  exit();
}

$registerName = htmlspecialchars(trim($_POST['username']));
$registerPassword = trim($_POST['password']);
$registerConPassword = trim($_POST['conPassword']);
if (strlen($registerName) < 3 || empty($registerName)) {
  $_SESSION['error'] = 'Username must have 3 or more characters and cannot be empty';
  header('Location: register.php');
  exit();
}
if (strlen($registerPassword) < 6 || empty($registerPassword)) {
  $_SESSION['error'] = 'Password must have 6 or more characters and cannot be empty';
  header('Location: register.php');
  exit();
}
if (empty($registerConPassword)) {
  $_SESSION['error'] = 'Confirm Password is required';
  header('Location: register.php');
  exit();
}
if ($registerPassword !== $registerConPassword) {
  $_SESSION['error'] = 'Confirm password does not match password';
  header('Location: register.php');
  exit();
}

$stmt = $pdo->prepare('SELECT * FROM users
WHERE username = ?');

$stmt->execute([$registerName]);

if ($stmt->fetch()) {
  $_SESSION['error'] = $registerName . ' already exists';
  header('Location: register.php');
  exit();
} else {
  $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');

  $stmt->execute([$registerName, $registerPassword]);

  $_SESSION['success'] = 'Registration successful. Please log in.';
  header('Location: login.php');
  exit();
}
