<?php
require_once 'config.php';

if (!isset($_POST['username'])) {
  header('Location: form.php');
  exit();
}
$username = trim($_POST['username']);

$stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');

$stmt->execute([$username]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
  echo 'ID: ' . $user['id'] . '<br>';
  echo 'Username: ' . $user['username'] . '<br>';
  echo 'Password: ' . $user['password'];
} else {
  echo 'User not found';
}
