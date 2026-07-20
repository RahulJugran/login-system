<?php
require_once __DIR__ . '/../includes/functions.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  redirect('../dashboard.php');
}

$_SESSION = [];
session_destroy();

redirect('../login.php');
