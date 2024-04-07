<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  //---add the DB API file
  require $root."/DB/call-db.php";
  //---open SQL lite 3 .db file
  $dbtabdata = array();
  dbsetup($db, $text);
  $tablename = $_SESSION["PRTabName"];
  dbcreatePRtable($db, $tablename, $text);
  dbaddprplrecord($db, $tablename, $text);
  dbreadPRID($db, $tablename, $PONum, $text);
  $newPONum = intval($PONum)+1;
  echo $newPONum;
  dbclose($db, $text);
  echo $text;
?>