<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/functions.php';
session_start();

if (
  !isset($_POST['username']) ||
  !isset($_POST['password']) ||
  !isset($_POST['conPassword'])
) {
  redirect('../register.php');
}

$username = htmlspecialchars(trim($_POST['username']));
$password = trim($_POST['password']);
$cPassword = trim($_POST['conPassword']);
if (strlen($username) < 3) {
  errorRedirect('Username must have 3 or more characters and cannot be empty', '../register.php');
}
if (strlen($password) < 6) {
  errorRedirect('Password must have 6 or more characters and cannot be empty', '../register.php');
}
if (empty($cPassword)) {
  errorRedirect('Confirm Password is required', '../register.php');
}
if ($password !== $cPassword) {
  errorRedirect('Confirm password does not match password', '../register.php');
}

$stmt = $pdo->prepare('SELECT * FROM users
WHERE username = ?');

$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
  errorRedirect("$username already exists", '../register.php');
} else {
  $passwordHash = password_hash($password, PASSWORD_DEFAULT);
  
  $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');

  $stmt->execute([$username, $passwordHash]);

  $_SESSION['success'] = 'Registration successful. Please log in.';
  redirect('../login.php');
}
