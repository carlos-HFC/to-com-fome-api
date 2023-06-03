<?php
$locale = $_GET['locale'];
session_start();

unset(
  $_SESSION['userName'],
  $_SESSION['userEmail'],
  $_SESSION['userRole'],
);

session_destroy();

return header("Location: " . $locale);
