<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/functions.php';
session_start();

if (
  !isset($_POST['username']) || !isset($_POST['password'])
) {
  redirect('../login.php');
}

$username = htmlspecialchars(trim($_POST['username']));
$password = trim($_POST['password']);

if (empty($username)) {
  errorRedirect('Username is required', '../login.php');
}

if (empty($password)) {
  errorRedirect('Password is required', '../login.php');
}

$stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
  $_SESSION['username'] = $user['username'];
  redirect('../dashboard.php');
}

errorRedirect('Invalid username or password', '../login.php');
?>