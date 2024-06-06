 <?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root."/DB/call-db.php";
require "/home/app/src/Reset.php";
dbsetup($db, $text);
$tabname = $_POST['tablename'];
If ($tabname == "commodity") {
$tablename = $_SESSION["ComListTabName"];
} else If ($tabname == "product") {
$tablename = $_SESSION["PListTabName"];
} else {
$tablename = "Default";
}
$id = $_POST['id'];
dbdelrecord($db, $tablename, $id, $text);
echo "record deleted";
dbclose($db, $text);
?>