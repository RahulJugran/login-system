<?php
function redirect($page)
{
  header("Location: $page");
  exit();
}

function errorRedirect($message, $page)
{
  $_SESSION['error'] = $message;
  redirect($page);
}
