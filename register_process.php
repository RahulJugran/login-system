<?php
require_once 'config.php';
require_once 'functions.php';
session_start();

if (
  !isset($_POST['username']) ||
  !isset($_POST['password']) ||
  !isset($_POST['conPassword'])
) {
  redirect('register.php');
}

$username = htmlspecialchars(trim($_POST['username']));
$password = trim($_POST['password']);
$cPassword = trim($_POST['conPassword']);
if (strlen($username) < 3) {
  $_SESSION['error'] = 'Username must have 3 or more characters and cannot be empty';
  redirect('register.php');
}
if (strlen($password) < 6) {
  $_SESSION['error'] = 'Password must have 6 or more characters and cannot be empty';
  redirect('register.php');
}
if (empty($cPassword)) {
  $_SESSION['error'] = 'Confirm Password is required';
  redirect('register.php');
}
if ($password !== $cPassword) {
  $_SESSION['error'] = 'Confirm password does not match password';
  redirect('register.php');
}

$stmt = $pdo->prepare('SELECT * FROM users
WHERE username = ?');

$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
  $_SESSION['error'] = $username . ' already exists';
  redirect('register.php');
} else {
  $passwordHash = password_hash($password, PASSWORD_DEFAULT);
  
  $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');

  $stmt->execute([$username, $passwordHash]);

  $_SESSION['success'] = 'Registration successful. Please log in.';
  redirect('login.php');
}
