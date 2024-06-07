<?php
// If the request is made from our space preview functionality then turn on PHP error reporting
if (isset($_SERVER['HTTP_X_FORWARDED_URL']) && strpos($_SERVER['HTTP_X_FORWARDED_URL'], '.w3spaces-preview.com/') !== false) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  }
?>

<!DOCTYPE html>
<html>
<body>

 <?php

$root = $_SERVER['DOCUMENT_ROOT'];
//---add the DB API file
require "Reset.php";
require $root."/DB/call-db.php";
//include 'DB/createDBTables.php';
include 'main-page/main-page.php';
?> 
</body>
</html>
