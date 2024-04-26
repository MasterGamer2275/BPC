<?php
// If the request is made from our space preview functionality then turn on PHP error reporting
if (isset($_SERVER['HTTP_X_FORWARDED_URL']) && strpos($_SERVER['HTTP_X_FORWARDED_URL'], '.w3spaces-preview.com/') !== false) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  }
?>
<?php
// Assuming you have a database connection established
// Connect to database
$root = $_SERVER['DOCUMENT_ROOT'];
//---add the DB API file
require $root."/DB/call-db.php";

$sum = array(array());
dbsetup($db, $text);
$tablename = $_SESSION["PListTabName"];
dbcreateproducttable($db, $tablename, $text);
    $sql =<<<EOF
   ALTER TABLE PRODUCT_TABLE_1
   RENAME COLUMN OPENINGSTOCK1 TO TOTALVAL;
  EOF;
   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Done!";
   }
// Close connection
dbclose($db, $text);
?>