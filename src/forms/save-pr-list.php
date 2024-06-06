<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root."/DB/call-db.php";
require "/home/app/src/Reset.php";
dbsetup($db, $text);
$tablename = $_SESSION["PRTabName"];
dbcreatePRtable($db, $tablename, $text);
$tablestr = $_POST['tabdata'];
$pONum = $_POST['ponum'];
$pODate = date("d-m-Y");
date_default_timezone_set('Asia/Kolkata');
$pOTime = date("h:i:s a");
$pOSname = $_POST['suppliername'];
$tableData = explode("],", $tablestr);
  $i = 0;
foreach ($tableData as $row) {
        $rowstr = json_encode($row);
        $word1 = str_replace("]","",$rowstr);
        $word2 = str_replace("[","", $word1);
        $word3 = str_replace('"', '',$word2);
        $word4 = str_replace('\\', '',$word3);
        $myArray = explode(",", $word4);
        dbaddpurchaserecord($db, $tablename, $pONum, $pODate, $pOTime, $pOSname, $myArray[0], $myArray[2], $myArray[3], $myArray[4], $myArray[5], $myArray[6], $myArray[7], $myArray[8], $myArray[9], $myArray[10], $text);
  }
echo "Records Added.";
$tablename = $_SESSION["PRNumTabName"];
$PRNum = $pONum;
dbdeleteprnumrecord($db, $tablename, $PRNum, $text);
dbclose($db, $text);

?>