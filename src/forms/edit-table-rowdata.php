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
require $root."/DB/call-db.php";
require "/home/app/src/Reset.php";
dbsetup($db, $text);
$tablename = $_POST['tablename'];
$edit = $_POST['edit'];
$tabdata = $_POST['tabdata'];
$tableData = json_decode($tabdata, true);
echo $tableData;
$id = $_POST['id'];
if ($edit === "false") {
dbdelrecord($db, $tablename, $id, $text);
echo "record deleted successfully";
}
if ($edit === "true") {
dbeditproductrecord1($db, $tablename, $id, $tabdata, $text);
echo "record edited successfully";
?>
          <script>
            //var phpVariable = <?php echo json_encode($text); ?>;
            //console.log(phpVariable);
        </script>
        <?php
}
dbclose($db, $text);
?>
