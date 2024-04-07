<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root."/DB/call-db.php";
dbsetup($db, $text);
$tablename = $_SESSION["SListTabName"];
$suppliername = $_POST['suppliername'];
$paramname = "NAME";
$paramvalue = $suppliername;
$dbrowvalues= array();
dbreadrecord($db, $tablename, $paramname, $paramvalue, $dbrowvalues, $text);
$jsonArray = json_encode($dbrowvalues);
echo $jsonArray;
dbclose($db, $text);
?>

