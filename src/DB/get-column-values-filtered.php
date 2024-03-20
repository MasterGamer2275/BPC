 <?php
//$root = $_SERVER['DOCUMENT_ROOT'];
//include ($root."/DB/db-setup.php");
echo $filterbyname;
$res = $db->query("SELECT FROM $tablename WHERE $columnname = '$filterbyname'");
$colvalues = array();
while (($value = $res->fetcharray(SQLITE3_ASSOC))) {
  array_push($colvalues,$value);
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