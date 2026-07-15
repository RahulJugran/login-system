<?php
require_once 'config.php';
require_once 'functions.php';
session_start();

if (
  !isset($_POST['username']) || !isset($_POST['password'])
) {
  redirect('login.php');
}

$username = htmlspecialchars(trim($_POST['username']));
$password = trim($_POST['password']);

if (empty($username)) {
  $_SESSION['error'] = 'Username is required';
  redirect('login.php');
}

if (empty($password)) {
  $_SESSION['error'] = 'Password is required';
  redirect('login.php');
}

$stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
  $_SESSION['username'] = $user['username'];
  redirect('dashboard.php');
}

$_SESSION['error'] = 'Invalid username or password';
redirect('login.php');

?>