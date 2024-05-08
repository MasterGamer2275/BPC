<?php echo "Site is under construction!" ?>
<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  //---add the DB API file
  require $root."/DB/call-db.php";
  //---open SQL lite 3 .db file
  dbsetup($db, $text);
  $tablename = $_SESSION["DocIdTabName"];
  dbcreatedocidtable($db, $tablename, $text);
  dbgetdocid($db, $tablename, "Dispatch", $DOCID, $text);
  dbeditdocidrecord($db, $tablename, "Dispatch", $DOCID, "alloted", $text);
  echo $DOCID;
  dbclose($db, $text);
  echo $text;
  ?>

