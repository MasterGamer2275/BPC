<?php
// If the request is made from our space preview functionality then turn on PHP error reporting
if (isset($_SERVER['HTTP_X_FORWARDED_URL']) && strpos($_SERVER['HTTP_X_FORWARDED_URL'], '.w3spaces-preview.com/') !== false) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  }
?>
<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  //---add the DB API file
  require $root."/DB/call-db.php";
  //---open SQL lite 3 .db file
  dbsetup($db, $text);
  $tablename = $_SESSION["ClListTabName"];

  // Explode the imploded string to get rows
  // Get the selected index from the request
  $cindex = $_GET['cindex'];
  // Explode the imploded result to get rows
  $rows = explode(';', $implodeResult);
  // Explode the specified row to get columns
  $columns = explode(',', $rows[$cindex]);
  // Send back the desired column (assuming JSON response)
  echo json_encode($columns);
  dbclose($db, $text);
?>