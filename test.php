<?php
require_once 'config.php';

$stmt = $pdo->query('select * from users');
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>test</title>
</head>
<body>
  <?php foreach ($users as $user): ?>
  <p>
    ID: <?= $user['id'] ?><br>
    Username: <?= $user['username'] ?><br>
    Password: <?= $user['password'] ?>
  </p>
  <?php endforeach; ?>
</body>
</html>