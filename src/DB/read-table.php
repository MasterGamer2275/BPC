<?php
$root = $_SERVER['DOCUMENT_ROOT'];
//include ($root."/DB/db-setup.php");
$res = $db->query("SELECT * FROM $tablename");
$data = array(array());
while (($row = $res->fetchArray(SQLITE3_ASSOC))) {
  array_push($data,$row);
}
$sql =<<<EOF
EOF;
   $ret = $db->exec($sql);
   if(!$ret) {
      echo $db->lastErrorMsg();
   } else {
      echo "Tabe Read Successfully\n";
   }

//include ($root."/DB/db-close.php");

?>