<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
</head>
<body>
  <?php
  session_start();
  if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
  } else {
    echo 'Welcome ' . $_SESSION['username'];
    echo "<form action='logout.php' method='post'>
    <button>Logout</button>
    </form>";
  }
  ?>
</body>
</html>